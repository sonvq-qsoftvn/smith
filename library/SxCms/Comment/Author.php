<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: Author.php 8299 2010-06-07 09:34:20Z andries $
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
 * @package    SxCms_Comment_Author
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
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
