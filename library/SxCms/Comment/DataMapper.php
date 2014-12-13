<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: DataMapper.php 8227 2010-05-31 12:19:36Z andries $
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
 * @package    SxCms_Comment_DataMapper
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Comment_DataMapper
{
    public function toObject(Array $import)
    {
        $fields = array(
            'comment_id'   => null,
            'page_id'      => null,
            'comment'      => null,
            'author_name'  => null,
            'author_email' => null,
            'author_link'  => null,
            'datePosted'   => null,
        );

        foreach ($import as $key => $value) {
            if (array_key_exists($key, $fields)) {
                $fields[$key] = $value;
            }
        }

        $comment = new SxCms_Comment();
        $author  = new SxCms_Comment_Author();

        $author->setName($fields['author_name'])
            ->setEmail($fields['author_email'])
            ->setWebsite($fields['author_link']);

        $page = new SxCms_Page();
        $page->setId($fields['page_id']);

        $comment->setId($fields['comment_id'])
            ->setPage($page)
            ->setMessage($fields['comment'])
            ->setCommenter($author)
            ->setDatePosted($fields['datePosted']);

        return $comment;
    }
    
    /**
     * Returns list of comments that require approval
     * 
     * @return array
     */
	public function getCommentsToApprove()
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('PageComment', array('*'))
			->where('approved = 0')
			->order('datePosted DESC');

		$stmt = $db->query($select);
		$result = $stmt->fetchAll();

		$comments = array();
		foreach ($result as $row) {
			$comment = $this->toObject($row);
			$comments[$comment->getId()] = $comment;
		}

		return $comments;
	}

    /**
     * Returns a list of all comments
     * 
     * @return array
     */
	public function getComments()
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('PageComment', array('*'))
			->order('datePosted DESC');

		$stmt = $db->query($select);
		$result = $stmt->fetchAll();

		$comments = array();
		foreach ($result as $row) {
            $comment = $this->toObject($row);
			$comments[$comment->getId()] = $comment;
		}

		return $comments;
	}

    /**
     * Returns a list of comments for a specific page
     * 
     * @param SxCms_Page $page
     * @return array
     */
	public function getCommentsByPage(SxCms_Page $page)
	{
		$id = (int) $page->getId();
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('PageComment', array('*'))
			->where('page_id = ?', $id)
			->where('approved = 1')
			->order('datePosted DESC');

		$stmt = $db->query($select);
		$result = $stmt->fetchAll();

		$comments = array();
		foreach ($result as $row) {
            $comment = $this->toObject($row);
			$comments[$comment->getId()] = $comment;
		}

		return $comments;
	}

    /**
     * Returns a comment by id
     * 
     * @param  $id
     * @return SxCms_Comment
     */
	public function getById($id)
	{
		$id = (int) $id;

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('PageComment', array('*'))
			->where('comment_id = ?', $id);

		$stmt = $db->query($select);
		$result = $stmt->fetch();

        $comment = $this->toObject($result);
		return $comment;
	}

	/**
	 * Save a comment object to the database
	 *
	 * @param SxCms_Comment $comment
	 * @return mixed
	 */
	public function save(SxCms_Comment $comment)
	{
		$db = Zend_Registry::get('db');
		$author = $comment->getCommenter();
		$data = array(
			'page_id'	   => $comment->getPage()->getId(),
			'comment'      => $comment->getMessage(),
			'datePosted'   => date('Y-m-d H:i:s'),
			'author_name'  => $author->getName(),
			'author_email' => $author->getEmail(),
			'author_link'  => $author->getWebsite(),
			'approved'	   => $comment->isApproved(),
			'dateApproved' => $comment->getDateApproved(),
		);

		if (!$comment->getId()) {
			$result = $db->insert('PageComment', $data);
			$comment->setId($db->lastInsertId());

			return $result;
		}

		return $db->update('PageComment', $data, 'comment_id = ' . $comment->getId());
	}

	/**
	 * Delete a comment object in the database
	 *
	 * @param SxCms_Comment $comment
	 * @return mixed
	 */
	public function delete(SxCms_Comment $comment)
	{
		$db = Zend_Registry::get('db');
		if ($comment->getId()) {
			return $db->delete('PageComment', 'comment_id = ' . $comment->getId());
		}

		return false;
	}
}
