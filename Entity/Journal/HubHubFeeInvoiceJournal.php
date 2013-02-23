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
 * HubHubFeeInvoiceJournal
 *
 * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
 * @since  2013-02-23
 *
 * @ORM\Entity
 */
class HubHubFeeInvoiceJournal extends HubFeeInvoiceJournal
{
    /**
     * post()
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-23
     */
    public function post()
    {
        // Sales Posting
        $salesPosting = new \HarvestCloud\DoubleEntryBundle\Entity\Posting();
        $salesPosting->setAccount($this->getInvoice()->getHub()->getSalesAccount());
        $salesPosting->setAmount($this->getInvoice()->getAmount());

        $this->addPosting($salesPosting);

        // A/R Posting
        $arPosting = new \HarvestCloud\DoubleEntryBundle\Entity\Posting();
        $arPosting->setAccount($this->getInvoice()->getHub()->getArPrePaymentAccount());
        $arPosting->setAmount(-1*$this->getInvoice()->getAmount());

        $this->addPosting($arPosting);
    }
}
