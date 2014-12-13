<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: Category.php 8179 2010-05-28 07:58:13Z andries $
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
 * @package    SxCms_Product_Category
 * @copyright  Copyright (c) 2009 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Product_Category
{
	protected $_id;
	protected $_parentId = 0;
	protected $_level = 0;
	protected $_language = 'nl';
	protected $_title;
	protected $_description;

	public function setId($id)
	{
		$this->_id = (int) $id;
		return $this;
	}

	public function getId()
	{
		return $this->_id;
	}

	public function setParentId($id)
	{
		$this->_parentId = (int) $id;
		return $this;
	}

	public function getParentId()
	{
		return $this->_parentId;
	}

	public function setLevel($level)
	{
		$this->_level = (int) $level;
		return $this;
	}

	public function getLevel()
	{
		return $this->_level;
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

	public function getTitle()
	{
		return $this->_title;
	}

	public function validateTitle()
	{
		$validator = new Zend_Validate_StringLength(2, 255);
		if ($validator->isValid($this->_title)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance('SxCms_Product_Category');
		$msg->addMessage('title', $validator->getMessages(), 'title');
		return false;
	}

	public function setDescription($description)
	{
		$this->_description = $description;
		return $this;
	}

	public function getDescription()
	{
		return $this->_description;
	}

	public function validateDescription()
	{
		$validator = new Zend_Validate_StringLength(2, 255);
		if ($validator->isValid($this->_description)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance('SxCms_Product_Category');
		$msg->addMessage('description', $validator->getMessages(), 'title');
		return false;
	}

	public function loadState()
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('c' => 'Category'), array('*'))
			->joinLeft(array('t' => 'CategoryTsl'), 'c.category_id = t.category_id')
			->where('c.category_id = ?', $this->_id)
			->where('t.language = ?', $this->getLanguage());

		$result = $db->fetchAll($select);

		foreach ($result as $product) {
			$this->setId($product['category_id'])
				->setParentId($product['parent_id'])
				->setTitle($product['title'])
				->setDescription($product['description']);
		}

		return $this;
	}

	public function getBreadcrumbs($full = false)
	{
		$xmlMapper = new SxCms_Product_Category_TreeMapper();
		$xmlMapper->loadSource(APPLICATION_PATH . '/var/ecommerce.xml');

		$nodeId = !$full ? $this->_parentId : $this->_id;
		if ($nodeId === null) {
			return '';
		}

		$path = $xmlMapper->getPath($nodeId);

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('Category', array())
			->joinLeft(array('t' => 'CategoryTsl'), 'Category.category_id = t.category_id', array())
			->columns('t.title')
			->where('Category.category_id IN (' . implode(',', $path) . ')')
			->where('t.language = \'nl\'')
			->order('Category.parent_id');

		$stmt = $db->query($select);
		$result = $stmt->fetchAll();

		$bcrumb = '';
		foreach ($result as $category) {
			$bcrumb .= $category['title'] . ' > ';
		}

		return trim(substr($bcrumb, 0, -2));
	}

	public function isValid()
	{
		$this->validateTitle();
		$this->validateDescription();

		if (!Sanmax_MessageStack::getInstance('SxCms_Product_Category')->getNamespaceMessages()) {
			return true;
		}

		return false;
	}

	public function delete()
	{
		$xmlMapper = new SxCms_Product_Category_TreeMapper();
		$xmlMapper->loadSource(APPLICATION_PATH . '/var/ecommerce.xml');

		$xmlMapper->delete($this->getId())
			->save();

		$db = Zend_Registry::get('db');
		$db->delete('Category', 'category_id = ' . $this->getId());
		$db->delete('Category', 'parent_id = ' .$this->getId());
		return;
	}

	public function save()
	{
		$db = Zend_Registry::get('db');
		$identity = Zend_Auth::getInstance()->getIdentity();

		$xmlMapper = new SxCms_Product_Category_TreeMapper();
		$xmlMapper->loadSource(APPLICATION_PATH . '/var/ecommerce.xml');

		$data = array(
			'parent_id'    => $this->_parentId,
			'author_id'	   => $identity->getId(),
			'active' 	   => 0
		);

		if ($this->_id) {
			$db->update('Category', $data, 'category_id = ' . $this->_id);

			$xmlMapper->delete($this->_id);
			$xmlMapper->add($this->getId(), $this->getParentId(), $this->getTitle());
			$xmlMapper->save();
		} else {
			$data['date_created'] = new Zend_Db_Expr('NOW()');
			$db->insert('Category', $data);
			$this->setId($db->lastInsertId());

			$xmlMapper->add($this->getId(), $this->_parentId, $this->getTitle());
			$xmlMapper->save();
		}

		$tslData = array(
			'category_id' => $this->_id,
			'title'		  => $this->getTitle(),
			'description' => $this->getDescription(),
		);

		$query = $db->select()
			->from('CategoryTsl', 'COUNT(*)')
			->where('category_id = ?', $this->_id)
			->where('language = ?', $this->getLanguage());

		if ($db->fetchOne($query)) {
			$db->update('CategoryTsl', $tslData,
				'category_id = ' . $this->_id .
				' AND language = \'' . $this->getLanguage() . '\'');
		} else {
			$config = Zend_Registry::get('config');
			foreach ($config->system->language as $lng => $slng) {
				$tslData['language'] = $lng;
				$db->insert('CategoryTsl', $tslData);
			}
		}

		return $this;
	}
}
