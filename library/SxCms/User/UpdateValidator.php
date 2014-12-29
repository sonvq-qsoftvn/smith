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
class SxCms_User_UpdateValidator extends SxCms_User_BaseValidator
{
	/**
	 * Password repeat
	 *
	 * @var string
	 */
	protected $_oldPassword = '';

	/**
	 * Validate user's data
	 *
	 * @return boolean
	 */
	public function validate(SxCms_User $user)
	{
		$this->_user = $user;

        $this->_validateEmail();
        if ($user->getPassword()) {
			$this->_validatePassword();
			$this->_validateOldPassword();
        }

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
	public function setOldPassword($password)
	{
		$this->_oldPassword = (string) $password;
		return $this;
	}

	/**
	 * Validates the password
	 *
	 * @return boolean
	 */
	protected function _validateOldPassword()
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('u' => 'User'), array('*'))
			->where('u.user_id = ' . (int) $this->_user->getId())
			->where('u.password = ?', sha1($this->_oldPassword));

		if (!$db->fetchRow($select)) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_User');
			$msg->addMessage('old_password', array('mismatch' => 'Waarde komt niet overeen'), 'password');
			return false;
		}

		return true;
	}
}
