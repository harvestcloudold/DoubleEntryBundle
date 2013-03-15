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
 * ProductPostingFeeInvoiceJournal
 *
 * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
 * @since  2013-03-11
 *
 * @ORM\Entity
 */
class ProductPostingFeeInvoiceJournal extends InvoiceJournal
{
    /**
     * Get description
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-03-11
     *
     * @return string
     */
    public function getDescription()
    {
        return 'Posting Fee Invoice #'.$this->getInvoice()->getId();
    }
}
