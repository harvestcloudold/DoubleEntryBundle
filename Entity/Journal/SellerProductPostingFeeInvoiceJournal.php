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
 * SellerProductPostingFeeInvoiceJournal
 *
 * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
 * @since  2013-03-11
 *
 * @ORM\Entity
 */
class SellerProductPostingFeeInvoiceJournal extends ProductPostingFeeInvoiceJournal
{
    /**
     * post()
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-03-11
     */
    public function post()
    {
        // COGS Posting
        $cogsPosting = new \HarvestCloud\DoubleEntryBundle\Entity\Posting();
        $cogsPosting->setAccount($this->getInvoice()->getOrder()->getSeller()->getCostOfGoodsSoldAccount());
        $cogsPosting->setAmount($this->getInvoice()->getAmount());

        $this->addPosting($cogsPosting);

        // A/P Posting
        $apPosting = new \HarvestCloud\DoubleEntryBundle\Entity\Posting();
        $apPosting->setAccount($this->getInvoice()->getOrder()->getSeller()->getAccountsPayableAccount());
        $apPosting->setAmount(-1*$this->getInvoice()->getAmount());

        $this->addPosting($apPosting);
    }
}
