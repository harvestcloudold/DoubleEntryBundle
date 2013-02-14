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
 * OrderPrePaymentJournal
 *
 * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
 * @since  2013-02-09
 *
 * @ORM\Entity
 */
class OrderPrePaymentJournal extends PaymentJournal
{
    /**
     * @ORM\ManyToOne(targetEntity="HarvestCloud\CoreBundle\Entity\Order", inversedBy="prePaymentJournals")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    protected $order;

    /**
     * __construct()
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-09
     *
     * @param  HarvestCloud\CoreBundle\Entity\Order
     */
    public function __construct(\HarvestCloud\CoreBundle\Entity\Order $order)
    {
        parent::__construct();

        $this->setOrder($order);
    }

    /**
     * Set order
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-09
     *
     * @param  \HarvestCloud\CoreBundle\Entity\Order $order
     *
     * @return OrderPrePaymentJournal
     */
    public function setOrder(\HarvestCloud\CoreBundle\Entity\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-09
     *
     * @return \HarvestCloud\CoreBundle\Entity\Order
     */
    public function getOrder()
    {
        return $this->order;
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
        return 'Pre-payment for Order #'.$this->getOrder()->getId();
    }
}
