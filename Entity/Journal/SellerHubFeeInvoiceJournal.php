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
 * SellerHubFeeInvoiceJournal
 *
 * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
 * @since  2013-02-23
 *
 * @ORM\Entity
 */
class SellerHubFeeInvoiceJournal extends HubFeeInvoiceJournal
{
    /**
     * post()
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-23
     */
    public function post()
    {
        // COGS Posting
        $cogsPosting = new \HarvestCloud\DoubleEntryBundle\Entity\Posting();
        $cogsPosting->setAccount($this->getInvoice()->getSeller()->getCostOfGoodsSoldAccount());
        $cogsPosting->setAmount($this->getInvoice()->getAmount());

        $this->addPosting($cogsPosting);

        // A/P Posting
        $apPosting = new \HarvestCloud\DoubleEntryBundle\Entity\Posting();
        $apPosting->setAccount($this->getInvoice()->getSeller()->getAccountsPayableAccount());
        $apPosting->setAmount(-1*$this->getInvoice()->getAmount());

        $this->addPosting($apPosting);
    }
}
