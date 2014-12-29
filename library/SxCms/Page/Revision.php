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

class SxCms_Page_Revision
{
	protected $_id;
	protected $_pageId;
	protected $_language;
	protected $_title;
	protected $_titleFb = false;
	protected $_summary;
	protected $_summaryFb;
	protected $_content;
	protected $_contentFb;
	protected $_source;
	protected $_sourceFb;
	protected $_link;
	protected $_linkFb;
	protected $_invisible;
	protected $_seotitle;
	protected $_seotags;
	protected $_seodescription;
	protected $_notes;
	protected $_approved = false;
	protected $_authorId;
	protected $_dateCreated;
	protected $_reviewerId;
	protected $_dateRevised;

    public function setFromArray(Array $data)
    {
        $fields = array(
            'revision_id'  		=> null,
            'author_id'    		=> null,
            'reviewer_id'  		=> null,
            'page_id'      		=> null,
            'language'     		=> null,
            'title'        		=> null,
            'title_fb'    		=> null,
            'summary'      		=> null,
            'summary_fb'  		=> null,
            'content'      		=> null,
            'content_fb'   		=> null,
            'source'      		=> null,
            'source_fb'    		=> null,
            'link'         		=> null,
            'link_fb'      		=> null,
            'notes'        		=> null,
            'approved'     		=> null,
            'date_created' 		=> null,
            'date_revised' 		=> null,
			'invisible'	   		=> null,
			'seotitle'	  		=> null,
			'seotags'	   		=> null,
			'seodescription'	=> null
			
        );

        foreach ($data as $key => $value) {
            if (array_key_exists($key, $fields)) {
                $fields[$key] = $value;
            }
        }

		$this->setId($fields['revision_id'])
			->setAuthorId($fields['author_id'])
			->setReviewerId($fields['reviewer_id'])
			->setPageId($fields['page_id'])
			->setLanguage($fields['language'])
			->setTitle($fields['title'])
			->setTitleFallback($fields['title_fb'])
			->setSummary($fields['summary'])
			->setSummaryFallback($fields['summary_fb'])
			->setContent($fields['content'])
			->setContentFallback($fields['content_fb'])
			->setSource($fields['source'])
			->setSourceFallback($fields['source_fb'])
			->setLink($fields['link'])
			->setLinkFallback($fields['link_fb'])
			->setNotes($fields['notes'])
			->setApproved($fields['approved'])
			->setDateCreated($fields['date_created'])
			->setDateRevised($fields['date_revised'])
			->setInvisible($fields['invisible']);
		$this->setSeoTitle($fields['seotitle'])
			->setSeoTags($fields['seotags'])
			->setSeoDescription($fields['seodescription']);

        return $this;;
    }
    
	public function loadState()
	{
		if (!$this->getId()) {
			return false;
		}

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('p' => 'Page'), array('*'))
			->joinLeft(array('t' => 'PageRev'), 'p.page_id = t.page_id')
			->where('t.revision_id = ?', $this->getId());

		$stmt = $db->query($select);
		$result = $stmt->fetch();

        $this->setFromArray($result);
		return $this;
	}

	public function approve()
	{
		$identity = Zend_Auth::getInstance()->getIdentity();
		$db = Zend_Registry::get('db');
		$approved = array(
			'approved'     => 1,
			'reviewer_id'  => $identity->getId(),
			'date_revised' => new Zend_Db_Expr('NOW()')
		);

		$db->update('PageRev', $approved, 'revision_id = ' . $this->getId());

		$page = new SxCms_Page();
		$page->setId($this->getPageId())
			->loadState();

		$page->setLanguage($this->getLanguage())
			->setTitle($this->getTitle())
			->setTitleFallback($this->hasTitleFallback())
			->setSummary($this->getSummary())
			->setSummaryFallback($this->hasSummaryFallback())
			->setContent($this->getContent())
			->setContentFallback($this->hasContentFallback())
			->setSource($this->getSource())
			->setSourceFallback($this->hasSourceFallback())
			->setLink($this->getLink())
			->setInvisible($this->getInvisible())
			->setSeoTitle($this->getSeoTitle())
			->setSeoTags($this->getSeoTags())
			->setSeoDescription($this->getSeoDescription());

		$page->publish();
	}

	public function getDiffObject($original)
	{
		require_once 'Text/Diff.php';
		require_once 'Text/Diff/Renderer/inline.php';

		$diffObject = new SxCms_Page_Revision();
		$renderer   = new Text_Diff_Renderer_inline();

		$titleDiff = new Text_Diff('auto', array(
			array($original->getTitle()),
			array($this->getTitle())
		));

		$titleDiff = $renderer->render($titleDiff) ?
			$renderer->render($titleDiff) : array_pop($titleDiff->getOriginal());

		$summaryDiff = new Text_Diff('auto', array(
			array($original->getSummary()),
			array($this->getSummary())
		));

		$summaryDiff = $renderer->render($summaryDiff) ?
			$renderer->render($summaryDiff) : array_pop($summaryDiff->getOriginal());
		$summaryDiff = html_entity_decode($summaryDiff);

		$contentDiff = new Text_Diff('auto', array(
			array($original->getContent()),
			array($this->getContent())
		));

		$contentDiff = $renderer->render($contentDiff) ?
			$renderer->render($contentDiff) : array_pop($contentDiff->getOriginal());
		$contentDiff = html_entity_decode($contentDiff);

		$sourceDiff = new Text_Diff('auto', array(
			array($original->getSource()),
			array($this->getSource())
		));

		$sourceDiff = $renderer->render($sourceDiff) ?
			$renderer->render($sourceDiff) : array_pop($sourceDiff->getOriginal());

		$linkDiff = new Text_Diff('auto', array(
			array($original->getLink()),
			array($this->getLink())
		));

		$linkDiff = $renderer->render($linkDiff) ?
			$renderer->render($linkDiff) : array_pop($linkDiff->getOriginal());

		$diffObject->setLanguage($this->getLanguage())
			->setTitle($titleDiff)
			->setSummary($summaryDiff)
			->setContent($contentDiff)
			->setSource($sourceDiff)
			->setLink($linkDiff)
			->setApproved($this->isApproved());

		return $diffObject;
	}

	public function setId($id)
	{
		$this->_id = $id;
		return $this;
	}

	public function getId()
	{
		return $this->_id;
	}

	public function setAuthorId($id)
	{
		$this->_authorId = (int) $id;
		return $this;
	}

	public function getAuthorId()
	{
		return $this->_authorId;
	}

	public function setReviewerId($id)
	{
		$this->_reviewerId = (int) $id;
		return $this;
	}

	public function getReviewerId() {
		return $this->_reviewerId;
	}

	public function setPageId($id)
	{
		$this->_pageId = $id;
		return $this;
	}

	public function getPageId()
	{
		return $this->_pageId;
	}

	public function setLanguage($language)
	{
		$this->_language = $language;
		return $this;
	}

	public function getLanguage()
	{
		return $this->_language;
	}

	public function setTitle($title)
	{
		$this->_title = $title;
		return $this;
	}

	public function setTitleFallback($fb = true)
	{
		$this->_titleFb = (bool) $fb;
		

		return $this;
	}

	public function hasTitleFallback()
	{
		return $this->_titleFb;
	}

	public function getTitle()
	{
		return $this->_title;
	}

	public function setContent($content)
	{
		$this->_content = $content;
		return $this;
	}

	public function setContentFallback($fb = true)
	{
		$this->_contentFb = (bool) $fb;
		if ($fb) {
			$this->_content = null;
		}

		return $this;
	}

	public function hasContentFallback()
	{
		return $this->_contentFb;
	}

	public function getContent()
	{
		return $this->_content;
	}

	public function setSummary($summary)
	{
		$this->_summary = $summary;
		return $this;
	}

	public function setSummaryFallback($fb = true)
	{
		$this->_summaryFb = (bool) $fb;
		if ($fb) {
			$this->_summary = null;
		}

		return $this;
	}

	public function hasSummaryFallback()
	{
		return $this->_summaryFb;
	}

	public function getSummary()
	{
		return $this->_summary;
	}

	public function setSource($source)
	{
		$this->_source = $source;
		return $this;
	}

	public function setSourceFallback($fb = true)
	{
		$this->_sourceFb = $fb;
		if ($fb) {
			$this->_source = null;
		}

		return $this;
	}

	public function hasSourceFallback()
	{
		return $this->_sourceFb;
	}

	public function setLink($link)
	{
		$this->_link = $link;
		return $this;
	}

	public function getLink()
	{
		return $this->_link;
	}

	public function setLinkFallback($fb = true)
	{
		$this->_linkFb = $fb;
		if ($fb) {
			$this->_link = null;
		}

		return $this;
	}

	public function hasLinkFallback()
	{
		return $this->_linkFb;
	}
	
	
	public function setInvisible($invisible) {
		$this->_invisible = (int) $invisible;	
	}
	
	public function getInvisible() {
		return $this->_invisible;
	}
	
	public function setSeoTitle($seotitle)
	{
		$this->_seotitle = $seotitle;
		return $this;
	}

	public function getSeoTitle()
	{
		return $this->_seotitle;
	}
	
	public function setSeoTags($seotags)
	{
		$this->_seotags = $seotags;
		return $this;
	}

	public function getSeoTags()
	{
		return $this->_seotags;
	}
	
	public function setSeoDescription($seodescription)
	{
		$this->_seodescription = $seodescription;
		return $this;
	}

	public function getSeoDescription()
	{
		return $this->_seodescription;
	}

	public function getSource()
	{
		return $this->_source;
	}

	public function setNotes($notes)
	{
		$this->_notes = $notes;
		return $this;
	}

	public function getNotes()
	{
		return $this->_notes;
	}

	public function setApproved($approved = true)
	{
		$this->_approved = (bool) $approved;
		return $this;
	}

	public function isApproved()
	{
		return $this->_approved;
	}

	public function setDateCreated($date)
	{
		$this->_dateCreated = $date;
		return $this;
	}

	public function getDateCreated($format = null)
	{
		if ($format) {
			return strftime($format, strtotime($this->_dateCreated));
		}
		return $this->_dateCreated;
	}

	public function setDateRevised($date)
	{
		$this->_dateRevised = $date;
		return $this;
	}

	public function getDateRevised($format = null)
	{
		if(!$this->_dateRevised) {
			return;
		}
		if ($format) {
			return strftime($format, strtotime($this->_dateRevised));
		}
		return $this->_dateRevised;
	}

	public function save()
	{
		$identity = Zend_Auth::getInstance()->getIdentity();
		
		$pageData = array(
			'page_id'		 => $this->getPageId(),
			'language'		 => $this->getLanguage(),
			'author_id' 	 => $identity->getId(),
			'reviewer_id' 	 => null,
			'notes'	 	 	 => $this->getNotes(),
			'approved'	 	 => (int) $this->isApproved(),
			'title'	 	     => $this->getTitle(),
			'title_fb'		 => (int) $this->hasTitleFallback(),
			'summary'		 => $this->getSummary(),
			'summary_fb'	 => (int) $this->hasSummaryFallback(),
			'content'		 => $this->getContent(),
			'content_fb'	 => (int) $this->hasContentFallback(),
			'source'		 => $this->getSource(),
			'source_fb'		 => (int) $this->hasSourceFallback(),
			'link'			 => $this->getLink(),
			'link_fb'		 => (int) $this->hasLinkFallback(),
			'date_created'   => new Zend_Db_Expr('NOW()'),
			'date_revised'   => null,
			'invisible' 	 => (int) $this->getInvisible(),
			'seotitle'		 => $this->getSeoTitle(),
			'seotags'		 => $this->getSeoTags(),
			'seodescription' => $this->getSeoDescription()
		);
		
		$db = Zend_Registry::get('db');
		$result = $db->insert('PageRev', $pageData);

		$this->setId($db->lastInsertId());
		return $result;
	}

	public function warnLiveVersion()
	{
		$db = Zend_Registry::get('db');
		$latest = array('latest' => 0,);

		$db->update('Page', $latest, 'page_id = ' . $this->getPageId());
	}
}
