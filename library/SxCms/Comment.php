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

class SxCms_Comment
{
	/**
	 * Unique identifier
	 * @var integer
	 */
	protected $id;

	/**
	 * Page on which the comment was posted
	 * @var SxCms_Page
	 */
	protected $page;

	/**
	 * Date the comment has been posted
	 * @var string
	 */
	protected $postDate;

	/**
	 * Date the comment has been approved
	 * @var string
	 */
	protected $approveDate;

	/**
	 * Flag that indicates if comment has been approved
	 * @var boolean
	 */
	protected $approved = false;

	/**
	 * Person which entered the comment
	 * @var SxCms_Comment
	 */
	protected $commenter;

	/**
	 * The posted message
	 * @var string
	 */
	protected $message;

	/**
	 * Sets the unique identifier
	 *
	 * @param integer $id
	 * @return SxCms_Comment
	 */
	public function setId($id)
	{
		$this->id = (int) $id;
		return $this;
	}

	/**
	 * Gets the unique identifier
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Sets the page on which the comment was posted
	 *
	 * @param SxCms_Page $page
	 * @return SxCms_Comment
	 */
	public function setPage(SxCms_Page $page)
	{
		$this->page = $page;
		return $this;
	}

	/**
	 * Gets the page on which the comment was posted
	 *
	 * @return SxCms_Page
	 */
	public function getPage()
	{
		if (!$this->page) {
			$this->page = new SxCms_Page();
		}

		return $this->page;
	}

	/**
	 * Sets the comments status
	 *
	 * @param boolean $approved
	 * @return SxCms_Comment
	 */
	public function setApproved($approved = true)
	{
		$this->approved = (bool) $approved;
		return $this;
	}

	/**
	 * Returns if the comment has been approved
	 *
	 * @return boolean
	 */
	public function isApproved()
	{
		return $this->approved;
	}

	/**
	 * Sets the date on which comment has been posted
	 *
	 * @param string $date
	 * @return SxCms_Comment
	 */
	public function setDatePosted($date)
	{
		$this->postDate = (string) $date;
		return $this;
	}

	/**
	 * Gets the date on which the comment has been posted
	 *
	 * @return string
	 */
	public function getDatePosted()
	{
		return $this->postDate;
	}

	/**
	 * Sets the date on which the comment has been approved
	 *
	 * @param string $date
	 * @return SxCms_Comment
	 */
	public function setDateApproved($date)
	{
		$this->approveDate = (string) $date;
		return $this;
	}

	/**
	 * Gets the date on which the commen has been approved
	 *
	 * @return string
	 */
	public function getDateApproved()
	{
		return $this->approveDate;
	}

	/**
	 * Sets the commenter
	 *
	 * @param SxCms_PostCommenter $commenter
	 * @return SxCms_Comment
	 */
	public function setCommenter(SxCms_Comment_Author $commenter)
	{
		$this->commenter = $commenter;
		return $this;
	}

	/**
	 * Gets the commenter
	 *
	 * @return SxCms_Comment_Author
	 */
	public function getCommenter()
	{
		if (!$this->commenter) {
			$this->commenter = new SxCms_Comment_Author();
		}

		return $this->commenter;
	}

	/**
	 * Sets the message
	 *
	 * @param string $message
	 * @return SxCms_Comment
	 */
	public function setMessage($message)
	{
		$this->message = strip_tags($message);
		return $this;
	}

	/**
	 * Gets the message
	 *
	 * @return string
	 */
	public function getMessage()
	{
		return $this->message;
	}
}
