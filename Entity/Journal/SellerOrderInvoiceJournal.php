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
 * SellerOrderInvoiceJournal
 *
 * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
 * @since  2013-02-23
 *
 * @ORM\Entity
 */
class SellerOrderInvoiceJournal extends OrderInvoiceJournal
{
    /**
     * post()
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-23
     */
    public function post()
    {
        // AP PrePayment account
        $apPrePaymentPosting = new \HarvestCloud\DoubleEntryBundle\Entity\Posting();
        $apPrePaymentPosting->setAccount($this->getInvoice()->getOrder()->getSeller()->getAPPrePaymentAccount());
        $apPrePaymentPosting->setAmount($this->getInvoice()->getAmount());

        $this->addPosting($apPrePaymentPosting);

        // Sales account
        $salesPosting = new \HarvestCloud\DoubleEntryBundle\Entity\Posting();
        $salesPosting->setAccount($this->getInvoice()->getOrder()->getSeller()->getSalesAccount());
        $salesPosting->setAmount(-1*$this->getInvoice()->getAmount());

        $this->addPosting($salesPosting);
    }
}
