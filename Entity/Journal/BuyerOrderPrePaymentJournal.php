<?php

/*
 * This file is part of the Harvest Cloud package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HarvestCloud\DoubleEntryBundle\Entity\Journal;

use Doctrine\ORM\Mapping as ORM;

/**
 * BuyerOrderPrePaymentJournal
 *
 * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
 * @since  2013-02-09
 *
 * @ORM\Entity
 */
class BuyerOrderPrePaymentJournal extends OrderPrePaymentJournal
{
    /**
     * post()
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-09
     */
    public function post()
    {
        // AR PrePayment account
        $arPrePaymentPosting = new \HarvestCloud\DoubleEntryBundle\Entity\Posting();
        $arPrePaymentPosting->setAccount($this->getOrder()->getBuyer()->getARPrePaymentAccount());
        $arPrePaymentPosting->setAmount($this->getOrder()->getAmountForPaymentGateway());

        $this->addPosting($arPrePaymentPosting);

        // PayPal account
        $payPalPosting = new \HarvestCloud\DoubleEntryBundle\Entity\Posting();
        $payPalPosting->setAccount($this->getOrder()->getBuyer()->getPayPalAccount());
        $payPalPosting->setAmount(-1*$this->getOrder()->getAmountForPaymentGateway());

        $this->addPosting($payPalPosting);
    }
}
