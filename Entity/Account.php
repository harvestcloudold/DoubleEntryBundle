<?php

/*
 * This file is part of the Harvest Cloud package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HarvestCloud\DoubleEntryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use HarvestCloud\CoreBundle\Entity\Profile;

/**
 * Account Entity
 *
 * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
 * @since  2012-05-03
 *
 * @ORM\Entity
 * @ORM\Table(name="double_entry_account",indexes={@ORM\index(name="profile_type_ids", columns={"profile_id", "type_code"})})
 * @ORM\Entity(repositoryClass="HarvestCloud\DoubleEntryBundle\Repository\AccountRepository")
 */
class Account
{
    /**
     * Account types
     *
     * @var string
     */
    const
      TYPE_ACCOUNTS_RECEIVABLE = 'AR',
      TYPE_ACCOUNTS_PAYABLE    = 'AP',
      TYPE_SALES               = 'SA',
      TYPE_BANK                = 'BA'
    ;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="HarvestCloud\CoreBundle\Entity\Profile", inversedBy="accounts")
     * @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     */
    protected $profile;

    /**
     * @ORM\OneToMany(targetEntity="Posting", mappedBy="account")
     */
    protected $postings;

    /**
     * @ORM\Column(type="string", length=2)
     */
    protected $type_code;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(type="decimal", scale="2", nullable=true)
     */
    protected $balance = 0;

    /**
     * __construct()
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2012-05-03
     */
    public function __construct()
    {
        $this->postings = new ArrayCollection();
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
     * Set profile
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2012-05-03
     *
     * @param  Profile $profile
     */
    public function setProfile(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * Get profile
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2012-05-03
     *
     * @return HarvestCloud\CoreBundle\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set name
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2012-05-03
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2012-05-03
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Set type_code
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2012-05-04
     *
     * @param string $typeCode
     */
    public function setTypeCode($typeCode)
    {
        $this->type_code = $typeCode;
    }

    /**
     * Get type_code
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2012-05-04
     *
     * @return string
     */
    public function getTypeCode()
    {
        return $this->type_code;
    }

    /**
     * Set balance
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2012-05-04
     *
     * @param  decimal $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * Get balance
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2012-05-04
     *
     * @return decimal
     */
    public function getBalance()
    {
        return $this->balance;
    }


    /**
     * Get account name suffix
     *
     * @author Tom Haskins-Vaughan <tom@harvestcloud.com>
     * @since  2012-05-21
     *
     * @return string
     */
    public static function getAccountNameSuffix($type_code)
    {
        switch ($type_code)
        {
            case Account::TYPE_ACCOUNTS_RECEIVABLE: return ' A/R';
            case Account::TYPE_ACCOUNTS_PAYABLE:    return ' A/P';
            case Account::TYPE_SALES:               return ' Sales';
            case Account::TYPE_BANK:                return ' Bank';

            default:

                throw new \Exception('Incorrect type_code: '.$type_code);
        }
    }
}
