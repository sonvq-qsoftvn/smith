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

class SxCms_Group_BaseValidator
{
	protected $_group;

	public function validate(SxCms_Group $group)
	{
		$this->_group = $group;

		$this->_validateName();
		$this->_validateIdentifier();

		if (!Sanmax_MessageStack::getInstance('SxCms_Group')->getNamespaceMessages()) {
			return true;
		}

		return false;
	}

	protected function _validateName()
	{
		$validator = new Zend_Validate_StringLength(2, 255);
		if ($validator->isValid($this->_group->getName())) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance('SxCms_Group');
		$msg->addMessage('name', $validator->getMessages());
		return false;
	}

	protected function _validateIdentifier()
	{
		$validator = new Zend_Validate_StringLength(2, 255);
		if ($validator->isValid($this->_group->getIdentifier())) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance('SxCms_Group');
		$msg->addMessage('identifier', $validator->getMessages());
		return false;
	}
}
