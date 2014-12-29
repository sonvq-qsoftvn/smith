<?php

/**
 * Development by thieusmith
 * @version $Id: Acl.php 8179 2010-05-28 07:58:13Z andries $
 *
 * LICENSE
 *
 * Warranty on source code, and templates, expires upon modifications, made by
 * either customer, or third party providers. thieusmith can not be
 * held responsible for such modifications.
 *
 * Client assumes all responsibility for additional time and cost requirements
 * resulting from such modifications.
 */


/**
 * @category   SxCms
 * @package    SxCms_Acl
 * @copyright  Copyright (c) 2015 thieusmith. (thieusmith@gmail.com)
 */

class SxCms_Job
{
    const TERM_NONE = -1;
	const TERM_FULLTIME = 0;
	const TERM_PARTTIME = 1;
	const TERM_REPLACEMENT = 2;
	const TERM_FULLTIME_OR_PARTTIME = 3;
	const TERM_TRAINING = 4;

	/**
	 * Unique identifier
	 * @var integer
	 */
	protected $id;

	/**
	 * The job title
	 * @var string
	 */
	protected $jobTitle = '';

	/**
	 * Description of the job
	 * @var string
	 */
	protected $description = '';

	/**
	 * Expiration date of the job
	 * @var string
	 */
	protected $expireDate = '';

	/**
	 * Publication date of the job
	 * @var string
	 */
	protected $publicationDate = '';

	/**
	 * Address of the job
	 * @var SxCms_Address
	 */
	protected $address;

	/**
	 * Hours per week
	 * @var integer
	 */
	protected $hours;

	/**
	 * Additional notes
	 * @var string
	 */
	protected $notes = '';
	protected $phone = '';
	protected $mobile = '';
	protected $email = '';
	protected $term = self::TERM_NONE;
	protected $category;

	/**
	 * Last name of the job seeker
	 * @var string
	 */
	protected $seekerName = '';

	/**
	 * First name of the job seekr
	 * @var string
	 */
	protected $seekerFirstName = '';

	/**
	 * sets the unique identifier
	 *
	 * @param integer $id
	 */
	public function setId($id)
	{
		$this->id = (int) $id;
		return $this;
	}

	/**
	 * Gets the unique identifier
	 *
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Sets the job titel
	 *
	 * @param string $title
	 * @return SxCms_Job
	 */
	public function setJobTitle($title)
	{
		$this->jobTitle = (string) $title;
		return $this;
	}

	/**
	 * Gets the job title
	 *
	 * @return string
	 */
	public function getJobTitle()
	{
		return $this->jobTitle;
	}

	/**
	 * Sets the description of the job
	 *
	 * @param string $description
	 * @return SxCms_Job
	 */
	public function setDescription($description)
	{
		$this->description = (string) $description;
		return $this;
	}

	/**
	 * Gets the description of the job
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Sets the job expiration date
	 *
	 * @param string $date
	 * @return SxCms_Job
	 */
	public function setExpireDate($date)
	{
		$this->expireDate = (string) $date;
		return $this;
	}

	/**
	 * Gets the job expiration date
	 *
	 * @param string $format
	 * @return string
	 */
	public function getExpireDate($format = null)
	{
		if ($format && $this->expireDate) {
			return strftime($format, strtotime($this->expireDate));
		}

		return $this->expireDate;
	}

    /**
     * Sets the job expiration date
     *
     * @param string $date
     * @return SxCms_Job
     */
    public function setPublicationDate($date)
    {
        $this->publicationDate = (string) $date;
        return $this;
    }

    /**
     * Gets the job expiration date
     *
     * @param string $format
     * @return string
     */
    public function getPublicationDate($format = null)
    {
        if ($format && $this->publicationDate) {
            return strftime($format, strtotime($this->publicationDate));
        }

        return $this->publicationDate;
    }

	/**
	 * Sets the addrss
	 *
	 * @param SxCms_Address $address
	 * @return SxCms_Job
	 */
	public function setAddress(SxCms_Address $address)
	{
		$this->address = $address;
		return $this;
	}

	/**
	 * Gets the address of the job location
	 *
	 * @return SxCms_Address
	 */
	public function getAddress()
	{
		if (!$this->address) {
			$this->address = new SxCms_Address();
		}

		return $this->address;
	}

	/**
	 * Sets the amount of hours per week
	 *
	 * @param iteger $hours
	 * @return SxCms_Job
	 */
	public function setHours($hours)
	{
		$this->hours = $hours;
		return $this;
	}

	/**
	 * Gets teh amount of hours per week
	 *
	 * @retun integer
	 */
	public function getHours()
	{
		return $this->hours;
	}

	/**
	 * Sets some additional notes about the job (benefits, etc)
	 *
	 * @param string $notes
	 * @return SxCms_Job
	 */
	public function setNotes($notes)
	{
		$this->notes = $notes;
		return $this;
	}

	/**
	 * Gets additional notes about the job
	 *
	 * @return string
	 */
	public function getNotes()
	{
		return $this->notes;
	}

	public function setPhone($phone)
	{
		$this->phone = (string) $phone;
		return $this;
	}

	public function getPhone()
	{
		return $this->phone;
	}

    public function setMobile($phone)
    {
        $this->mobile = (string) $phone;
        return $this;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function setEmail($email)
    {
        $this->email = (string) $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setTerm($term)
    {
    	$this->term = $term;
    	return $this;
    }

    public function getTerm()
    {
    	return (int) $this->term;
    }

    public function setCategory(SxCms_Job_Category $category)
    {
        $this->category = $category;
        return $this;
    }

    public function getCategory()
    {
        if (!$this->category) {
            $this->category = new SxCms_Job_Category();
        }

        return $this->category;
    }

    public function setSeekerName($name)
    {
    	$this->seekerName = (string) $name;
    	return $this;
    }

    public function getSeekerName()
    {
    	return $this->seekerName;
    }

    public function setSeekerFirstName($fname)
    {
    	$this->seekerFirstName = (string) $fname;
    	return $this;
    }

    public function getSeekerFirstName()
    {
    	return $this->seekerFirstName;
    }

    public function getSeekerFullName()
    {
    	$name = $this->getSeekerName();
    	if ($name && $this->getSeekerFirstName()) {
    		$name .= ' ';
    	}

    	$name .= $this->getSeekerFirstName();
    	return $name;
    }

	public function loadState()
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('Vacancy', array('*'))
			->where('vacancy_id = ?', $this->id);

		$stmt = $db->query($select);
		$result = $stmt->fetchAll();

		foreach ($result as $job) {
			$this->setId($job['vacancy_id'])
				->setJobTitle($job['title'])
				->setPhone($job['phone'])
				->setMobile($job['mobile'])
				->setEmail($job['email'])
				->setTerm($job['term'])
				->setDescription($job['description'])
				->setExpireDate($job['date_expired'])
				->setPublicationDate($job['date_published'])
                ->setSeekerFirstName($job['seeker_name'])
                ->setSeekerName($job['seeker_fname']);

	        $category = new SxCms_Job_Category();
	        $category->setId($job['category_id']);

	        $this->setCategory($category);

			$address = new SxCms_Address();
			$address->setRegion($job['region']);

			$this->setAddress($address)
				->setHours($job['hours'])
				->setNotes($job['notes']);
		}

		return $this;
	}

	public function save()
	{
		$db = Zend_Registry::get('db');
		$identity = Zend_Auth::getInstance()->getIdentity();

		$address = $this->getAddress();
		$data = array(
			'author_id'	     => $identity->getId(),
		    'category_id'    => $this->getCategory()->getId(),
			'title' 	     => $this->getJobTitle(),
			'description'    => $this->getDescription(),
		    'phone'          => $this->getPhone(),
		    'mobile'         => $this->getMobile(),
		    'email'          => $this->getEmail(),
			'region'	     => $address->getRegion(),
			'hours'	 	     => $this->getHours(),
			'notes'	 	     => $this->getNotes(),
		    'term'           => $this->getTerm(),
            'seeker_name'    => $this->getSeekerName(),
            'seeker_fname'   => $this->getSeekerFirstName(),
			'date_expired'   => $this->getExpireDate('%Y-%m-%d'),
		    'date_published' => $this->getPublicationDate('%Y-%m-%d')
		);

		if ($this->id) {
			return $db->update('Vacancy', $data, 'vacancy_id = ' . $this->id);
		}

		$data['date_created'] = new Zend_Db_Expr('NOW()');
		$db->insert('Vacancy', $data);
		$this->setId($db->lastInsertId());

		return $this;
	}

	public function delete()
	{
		$db = Zend_Registry::get('db');
		return $db->delete('Vacancy', 'vacancy_id = ' . $this->getId());
	}
}
