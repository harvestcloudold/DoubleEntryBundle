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
 * InvoiceJournal
 *
 * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
 * @since  2013-02-04
 *
 * @ORM\Entity
 */
class InvoiceJournal extends Journal
{
    /**
     * @ORM\ManyToOne(targetEntity="\HarvestCloud\InvoiceBundle\Entity\Invoice", inversedBy="journals")
     * @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
     */
    protected $invoice;

    /**
     * __construct()
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-23
     *
     * @param  HarvestCloud\InvoiceBundle\Entity\Invoice
     */
    public function __construct(\HarvestCloud\InvoiceBundle\Entity\Invoice $invoice)
    {
        parent::__construct();

        $this->setInvoice($invoice);
    }

    /**
     * Set invoice
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-23
     *
     * @param  \HarvestCloud\InvoiceBundle\Entity\Invoice $invoice
     *
     * @return InvoiceJournal
     */
    public function setInvoice(\HarvestCloud\InvoiceBundle\Entity\Invoice $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-23
     *
     * @return \HarvestCloud\InvoiceBundle\Entity\Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }
}
