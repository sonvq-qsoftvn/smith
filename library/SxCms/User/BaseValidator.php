<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: BaseValidator.php 8187 2010-05-28 08:43:23Z andries $
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
 * @package    SxCms_User_BaseValidator
 * @copyright  Copyright (c) 2009 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_User_BaseValidator
{
	/**
	 * User object
	 * @var SxCms_User
	 */
	protected $_user;

	/**
	 * Password repeat
	 * @var string
	 */
	protected $_passwordRepeat = '';

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
		$this->_validateFirstName();
		$this->_validateLastName();

		$msgr = Sanmax_MessageStack::getInstance('SxCms_User');
		if (!$msgr->getNamespaceMessages()) {
			return true;
		}

		return false;
	}

	/**
	 * Sets the password to compare the user's password against
	 *
	 * @param string $password
	 * @return SxCms_User_BaseValidator
	 */
	public function setPasswordRepeat($password)
	{
		$this->_passwordRepeat = (string) $password;
		return $this;
	}

	/**
	 * Validates email address
	 *
	 * @return boolean
	 */
	protected function _validateEmail()
	{
		$validator = new Zend_Validate_EmailAddress();
		$msg = Sanmax_MessageStack::getInstance('SxCms_User');

		if (!$validator->isValid($this->_user->getEmail())) {
			$msg->addMessage('email', $validator->getMessages());
		}

	    $exclude = array(
            'field' => 'user_id',
            'value' => (int) $this->_user->getId()
	    );

		$validator = new Zend_Validate_Db_NoRecordExists('User', 'email', $exclude);
		if (!$validator->isValid($this->_user->getEmail())) {
			$msg->addMessage('email', $validator->getMessages(), 'common');
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

		$validator = new Zend_Validate_Identical($this->_user->getPassword());
		if (!$validator->isValid($this->_passwordRepeat)) {
			$msg->addMessage('password_repeat', $validator->getMessages(), 'password');
		}

		return false == ($msg->getMessages('password') &&
			$msg->getMessages('password_repeat'));
	}

	/**
	 * Validates the first name
	 *
	 * @return boolean
	 */
	protected function _validateFirstName()
	{
		$validator = new Zend_Validate_StringLength(2, 255);
		if ($validator->isValid($this->_user->getFirstName())) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance('SxCms_User');
		$msg->addMessage('first_name', $validator->getMessages(), 'common');
		return false;
	}

	/**
	 * Validates the last name
	 *
	 * @return boolean
	 */
	protected function _validateLastName()
	{
		$validator = new Zend_Validate_StringLength(2, 255);
		if ($validator->isValid($this->_user->getLastName())) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance('SxCms_User');
		$msg->addMessage('last_name', $validator->getMessages(), 'common');
		return false;
	}
}
