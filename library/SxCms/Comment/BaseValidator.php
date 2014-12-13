<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: BaseValidator.php 8237 2010-05-31 14:41:11Z andries $
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
 * @package    SxCms_Comment_BaseValidator
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Comment_BaseValidator
{
	/**
	 * Comment object
	 * @var SxCms_Comment
	 */
	protected $comment;

	/**
	 * Captcha element
	 * @var Zend_Captcha_Image
	 */
	protected $captcha;

	/**
	 * Captcha entered by the user
	 * @var string
	 */
	protected $userCaptcha;

	/**
	 * Errors which occured
	 * @var array
	 */
	protected $errors = array();

	/**
	 * Sets the captcha
	 *
	 * @param string $captcha
	 * @return SxCms_Comment_BaseValidator
	 */
	public function setCaptcha(Zend_Captcha_Base $captcha)
	{
		$this->captcha = $captcha;
		return $this;
	}

	/**
	 * Sets the user captcha
	 *
	 * @param string $captcha
	 * @return SxCms_Comment_BaseValidator
	 */
	public function setUserCaptcha($captcha)
	{
		$this->userCaptcha = (string) $captcha;
		return $this;
	}

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
		$this->_validateCaptcha();

		return count($this->errors) === 0;
	}

	/**
	 * Get error that occured while validating
	 *
	 * @return array
	 */
	public function getErrors()
	{
		return $this->errors;
	}

	/**
	 * Validate the name
	 *
	 * @return boolean
	 */
	protected function _validateName()
	{
		$author = $this->comment->getCommenter();

		$validator = new Zend_Validate_StringLength(2, 255);
		if (!$validator->isValid($author->getName())) {
		    $this->errors['name'] = $validator->getMessages();
		    return false;
		}

		return true;
	}

	/**
	 * Validate the email
	 *
	 * @return boolean
	 */
	protected function _validateEmail()
	{
		$author = $this->comment->getCommenter();

		$validator = new Zend_Validate_EmailAddress();
		if (!$validator->isValid($author->getEmail())) {
		    $this->errors['email'] = $validator->getMessages();
		    return false;
		}

		return true;
	}

	/**
	 * Validate the website
	 *
	 * @return boolean
	 */
	protected function _validateWebsite()
	{
		$author = $this->comment->getCommenter();
		if ($author->getWebsite() && !Zend_Uri::check($author->getWebsite())) {
			$this->errors['website']['invalid'] = 'Website is niet geldig';
			return false;
		}

		return true;
	}

	/**
	 * Validate the message
	 *
	 * @return boolean
	 */
	protected function _validateMessage()
	{
		$validator = new Zend_Validate_StringLength(2);
		if (!$validator->isValid($this->comment->getMessage())) {
		    $this->errors['message'] = $validator->getMessages();
		    return false;
		}

		return true;
	}

	/**
	 * Validate captcha
	 *
	 * @return boolean
	 */
	protected function _validateCaptcha()
	{
		$captcha =  array(
			'id' => $this->captcha->getId(),
			'input' => $this->userCaptcha
		);

		if (!$this->captcha->isValid($captcha)) {
			$this->errors['captcha'] = $this->captcha->getMessages();
			return false;
		}

		return true;
	}
}