<?php

/*
 * This file is part of the Harvest Cloud package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HarvestCloud\DoubleEntryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Journal Entity
 *
 * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
 * @since  2012-05-03
 *
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *    "payment"         = "PaymentJournal",
 *    "orderprepayment" = "OrderPrePaymentJournal",
 *    "invoice"         = "InvoiceJournal"
 * })
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="double_entry_journal")
 * @ORM\Entity(repositoryClass="HarvestCloud\DoubleEntryBundle\Repository\JournalRepository")
 */
class Journal
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Posting", mappedBy="journal", cascade={"persist"})
     */
    protected $postings;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * __construct()
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2012-05-03
     */
    public function __construct()
    {
        $this->postings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2012-05-03
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add posting
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2012-05-03
     *
     * @param  Posting $posting
     */
    public function addPosting(Posting $posting)
    {
        $this->postings[] = $posting;
        $posting->setJournal($this);
    }

    /**
     * Get postings
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2012-05-03
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPostings()
    {
        return $this->postings;
    }

    /**
     * Ensure zero sum - the amount of all Postings must add up to zero
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2012-05-05
     * @todo   Find a better Exception class
     *
     * @ORM\PrePersist
     */
    public function ensureZeroSumOfPostings()
    {
        $sum = 0;

        foreach ($this->postings as $posting)
        {
            $sum += $posting->getAmount();
        }

        if (0 != $sum)
        {
            throw new \Exception('The sum of the amounts of all of the Postings must be zero ('.$sum.' given)');
        }
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
        return 'Not implemented';
    }

    /**
     * Remove postings
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-09
     *
     * @param \HarvestCloud\DoubleEntryBundle\Entity\Posting $posting
     */
    public function removePosting(\HarvestCloud\DoubleEntryBundle\Entity\Posting $posting)
    {
        $this->postings->removeElement($posting);
    }

    /**
     * Set created
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-09
     *
     * @param  \DateTime $created
     *
     * @return Journal
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-09
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-09
     *
     * @param \DateTime $updated
     *
     * @return Journal
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2013-02-09
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
