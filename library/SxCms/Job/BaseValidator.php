<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: BaseValidator.php 8748 2010-07-16 09:20:03Z andries $
 *
 * LICENSE
 *
 * Warranty on source code, and templates, expires upon modifications, made by
 * either customer, or third party providers. Sanmax Consultancy can not be
 * held responsible for such modifications.
 *
 * Client assumes all responsibility for additional time and cost requirements
 * resulting from such modifications.
 */


/**
 * @category   SxCms
 * @package    SxCms_Job_BaseValidator
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Job_BaseValidator
{
	/**
	 * Job object
	 *
	 * @var SxCms_Job
	 */
	protected $_job;

	/**
	 * Validate job's data
	 *
	 * @return boolean
	 */
	public function validate(SxCms_Job $job)
	{
		$this->_job = $job;

		$this->_validateJobTitle();
		$this->_validateDescription();
		$this->_validatePhone();
		$this->_validateMobile();
		$this->_validateEmail();
		$this->_validatePublicationDate();
		$this->_validateExpireDate();

		if (!Sanmax_MessageStack::getInstance('SxCms_Job')->getNamespaceMessages()) {
			return true;
		}

		return false;
	}

	/**
	 * Validates job title
	 *
	 * @return boolean
	 */
	protected function _validateJobTitle()
	{
		$validator = new Zend_Validate_StringLength(2, 255);
		if ($validator->isValid($this->_job->getJobTitle())) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance('SxCms_Job');
		$msg->addMessage('title', $validator->getMessages(), 'function');
		return false;
	}

    /**
     * Validates phone number
     *
     * @return bool
     */
    protected function _validatePhone()
    {
    	if (!strlen($this->_job->getPhone()) && strlen($this->_job->getMobile())) {
    		return true;
    	}

        $validator = new Zend_Validate_StringLength(8, 25);
        if ($validator->isValid($this->_job->getPhone())) {
            return true;
        }

        $msg = Sanmax_MessageStack::getInstance('SxCms_Job');
        $msg->addMessage('phone', $validator->getMessages(), 'location');
        return false;
    }

    /**
     * Validates mobile phone number
     *
     * @return bool
     */
    protected function _validateMobile()
    {
        if (!strlen($this->_job->getMobile()) && strlen($this->_job->getPhone())) {
            return true;
        }

        $validator = new Zend_Validate_StringLength(8, 25);
        if ($validator->isValid($this->_job->getMobile())) {
            return true;
        }

        $msg = Sanmax_MessageStack::getInstance('SxCms_Job');
        $msg->addMessage('mobile', $validator->getMessages(), 'location');
        return false;
    }

    /**
     * Validates email address
     *
     * @return bool
     */
    protected function _validateEmail()
    {
    	if (!strlen($this->_job->getEmail())) {
    		return true;
    	}

        $validator = new Zend_Validate_EmailAddress();
        $validator->setOptions(array(
                'domain'  => false,
                'mx'      => false,
            )
        );

        if ($validator->isValid($this->_job->getEmail())) {
        	return true;
        }

        $msg = Sanmax_MessageStack::getInstance('SxCms_Job');
        $msg->addMessage('email', $validator->getMessages(), 'location');
        return false;
    }

	/**
	 * Validates job description
	 *
	 * @return boolean
	 */
	protected function _validateDescription()
	{
		$validator = new Zend_Validate_StringLength(2);
		if ($validator->isValid($this->_job->getDescription())) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance('SxCms_Job');
		$msg->addMessage('description', $validator->getMessages(), 'function');
		return false;
	}

	/**
	 * Validates expiration date
	 *
	 * @return boolean
	 */
	protected function _validateExpireDate()
	{
		$validator = new Zend_Validate_Date();
		$validator->setFormat('dd-MM-YYYY');
		if (!$validator->isValid($this->_job->getExpireDate())) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Job');
			$msg->addMessage('expire_date', $validator->getMessages(), 'save');

			return false;
		}

		return true;
	}

    /**
     * Validates expiration date
     *
     * @return boolean
     */
    protected function _validatePublicationDate()
    {
        $validator = new Zend_Validate_Date();
        $validator->setFormat('dd-MM-YYYY');
        if (!$validator->isValid($this->_job->getPublicationDate())) {
            $msg = Sanmax_MessageStack::getInstance('SxCms_Job');
            $msg->addMessage('publication_date', $validator->getMessages(), 'save');

            return false;
        }

        return true;
    }
}
