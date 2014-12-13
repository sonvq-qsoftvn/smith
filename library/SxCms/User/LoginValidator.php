<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: LoginValidator.php 8219 2010-05-31 07:34:43Z andries $
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
 * @package    SxCms_User_LoginValidator
 * @copyright  Copyright (c) 2009 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_User_LoginValidator extends SxCms_User_BaseValidator
{
	/**
	 * Validate user's data
	 *
	 * @return boolean
	 */
	public function validate(SxCms_User $user)
	{
		$this->_user = $user;

		$this->_validateEmail();
		$this->_validatePassword();

		$msgr = Sanmax_MessageStack::getInstance('SxCms_User');
		if (!$msgr->getNamespaceMessages()) {
			return true;
		}

		return false;
	}

    /**
     * Validates email address
     * 
     * @return bool
     */
	protected function _validateEmail()
	{
		$validator = new Zend_Validate_EmailAddress();
		$msg = Sanmax_MessageStack::getInstance('SxCms_User');
		if (!$validator->isValid($this->_user->getEmail())) {
			$msg->addMessage('email', array($this->_user->getEmail()));
		}

		return false == $msg->getMessages('email');
	}

	/**
	 * Validates the password
	 *
	 * @return boolean
	 */
	protected function _validatePassword()
	{
		$validator = new Sanmax_Validate_PasswordStrength();
		$validator->setRequireDigit(false)
			->setRequireLowercase(false)
			->setRequireUppercase(false);

		$msg = Sanmax_MessageStack::getInstance('SxCms_User');
		if (!$validator->isValid($this->_user->getPassword())) {
			$msg->addMessage('password', $validator->getMessages());
			return false;
		}

		return false == $msg->getMessages('password');
	}
}
