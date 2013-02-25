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
 * OrderInvoiceJournal
 *
 * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
 * @since  2013-02-23
 *
 * @ORM\Entity
 */
class OrderInvoiceJournal extends InvoiceJournal
{
    /**
     * @ORM\ManyToOne(targetEntity="HarvestCloud\CoreBundle\Entity\Order", inversedBy="invoiceJournals")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    protected $order;

    /**
     * __construct()
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-23
     *
     * @param  HarvestCloud\InvoiceBundle\Entity\OrderInvoice  $invoice
     */
    public function __construct(\HarvestCloud\InvoiceBundle\Entity\OrderInvoice $invoice)
    {
        parent::__construct($invoice);
    }

    /**
     * Get description
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-09
     *
     * @return string
     */
    public function getDescription()
    {
        return 'Invoice for Order #'.$this->getInvoice()->getOrder()->getId();
    }
}
