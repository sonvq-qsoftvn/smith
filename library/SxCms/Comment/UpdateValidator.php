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

class SxCms_Comment_UpdateValidator extends SxCms_Comment_BaseValidator
{
	/**
	 * Validate comment's data
	 *
	 * @return boolean
	 */
	public function validate(SxCms_Comment $comment)
	{
		$this->comment = $comment;

		$this->_validateName();
		$this->_validateEmail();
		$this->_validateWebsite();
		$this->_validateMessage();

		$msgr = Sanmax_MessageStack::getInstance('SxCms_Comments');
		foreach ($this->errors as $key => $messages) {
			$msgr->addMessage($key, $messages, 'edit');
		}

		return count($this->errors) === 0;
	}
}