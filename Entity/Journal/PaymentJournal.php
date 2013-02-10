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
 * PaymentJournal
 *
 * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
 * @since  2013-02-04
 *
 * @ORM\Entity
 */
class PaymentJournal extends Journal
{
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
        return 'Payment';
    }
}
