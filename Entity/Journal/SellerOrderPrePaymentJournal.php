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
 * SellerOrderPrePaymentJournal
 *
 * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
 * @since  2013-02-09
 *
 * @ORM\Entity
 */
class SellerOrderPrePaymentJournal extends OrderPrePaymentJournal
{
    /**
     * post()
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-09
     */
    public function post()
    {
        // AP PrePayment account
        $apPrePaymentPosting = new \HarvestCloud\DoubleEntryBundle\Entity\Posting();
        $apPrePaymentPosting->setAccount($this->getOrder()->getSeller()->getAPPrePaymentAccount());
        $apPrePaymentPosting->setAmount(-1*$this->getOrder()->getAmountForPaymentGateway());

        $this->addPosting($apPrePaymentPosting);

        // PayPal account
        $payPalPosting = new \HarvestCloud\DoubleEntryBundle\Entity\Posting();
        $payPalPosting->setAccount($this->getOrder()->getSeller()->getPayPalAccount());
        $payPalPosting->setAmount($this->getOrder()->getAmountForPaymentGateway());

        $this->addPosting($payPalPosting);
    }
}
