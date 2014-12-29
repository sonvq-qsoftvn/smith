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

class SxCms_Comment_Author
{
	/**
	 * Name
	 * @var string
	 */
	protected $name;

	/**
	 * Email address
	 * @var string
	 */
	protected $email;

	/**
	 * Website url
	 * @var string
	 */
	protected $website;

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return SxCms_Comment_Author
	 */
	public function setName($name)
	{
		$this->name = stripslashes($name);
		return $this;
	}

	/**
	 * Gets the name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Sets the email address
	 *
	 * @param string $email
	 * @return SxCms_Comment_Author
	 */
	public function setEmail($email)
	{
		$this->email = (string) $email;
		return $this;
	}

	/**
	 * Gets the email address
	 *
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Sets the website url
	 *
	 * @param string $website
	 * @return SxCms_Comment_Author
	 */
	public function setWebsite($website)
	{
		if (strlen($website) && 0 !== strpos($website, 'http://')) {
			$website = 'http://' . $website;
		}

		$this->website = (string) $website;
		return $this;
	}

	/**
	 * Gets the website
	 *
	 * @return string
	 */
	public function getWebsite()
	{
		return $this->website;
	}
}
