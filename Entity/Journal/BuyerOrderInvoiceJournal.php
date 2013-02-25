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
 * BuyerOrderInvoiceJournal
 *
 * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
 * @since  2013-02-23
 *
 * @ORM\Entity
 */
class BuyerOrderInvoiceJournal extends OrderInvoiceJournal
{
    /**
     * post()
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-23
     */
    public function post()
    {
        // AR PrePayment account
        $arPrePaymentPosting = new \HarvestCloud\DoubleEntryBundle\Entity\Posting();
        $arPrePaymentPosting->setAccount($this->getInvoice()->getOrder()->getBuyer()->getARPrePaymentAccount());
        $arPrePaymentPosting->setAmount(-1*$this->getInvoice()->getAmount());

        $this->addPosting($arPrePaymentPosting);

        // Purchases account
        $purchasePosting = new \HarvestCloud\DoubleEntryBundle\Entity\Posting();
        $purchasePosting->setAccount($this->getInvoice()->getOrder()->getBuyer()->getPurchasesAccount());
        $purchasePosting->setAmount($this->getInvoice()->getAmount());

        $this->addPosting($purchasePosting);
    }
}
