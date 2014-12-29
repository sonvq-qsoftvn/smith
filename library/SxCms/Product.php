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
class SxCms_Product
{
    /**
     * unique product id
     * @var integer
     */
	protected $id;

    /**
     * category of product
     * @var SxCms_Product_Category
     */
	protected $category;

    /**
     * language of current object
     * @var string
     */
	protected $language = 'nl';

    /**
     * product title
     * @var string
     */
	protected $title;

    /**
     * product summary
     * @var string
     */
	protected $summary;

    /**
     * product full description
     * @var string
     */
	protected $description;

    /**
     * product price
     * @var float
     */
	protected $price;

    /**
     * images assigned to product
     * @var array
     */
	protected $images = array();

    /**
     * Sets the unique product identifier
     *
     * @param  $id
     * @return SxCms_Product
     */
	public function setId($id)
	{
		$this->id = (int) $id;
		return $this;
	}

    /**
     * Returns the unique product identifier
     *
     * @return int
     */
	public function getId()
	{
		return $this->id;
	}

    /**
     * Sets category to which this product belongs
     *
     * @param SxCms_Product_Category $category
     * @return SxCms_Product
     */
	public function setCategory(SxCms_Product_Category $category)
	{
		$this->category = $category;
		return $this;
	}

    /**
     * Returns teh category to which this product belongs
     *
     * @return SxCms_Product_Category
     */
	public function getCategory()
	{
		if (!$this->category) {
			return new SxCms_Product_Category();
		}

		return $this->category;
	}

    /**
     * Validates product category
     *
     * @todo refactor into seperate validation object
     * @return bool
     */
	public function validateCategory()
	{
		if ($this->getCategory()->getId() === null) {
			$msg = Sanmax_MessageStack::getInstance('SxCms_Product');
			$msg->addMessage('category', array('set' => 'You must select a category'), 'price-category');

			return false;
		}

		return true;
	}

    /**
     * Sets language code of  product
     *
     * @param  $language
     * @return SxCms_Product
     */
	public function setLanguage($language)
	{
		$this->language = $language;
		return $this;
	}

    /**
     * Returns language code of product
     *
     * @return string
     */
	public function getLanguage()
	{
		return $this->language;
	}

    /**
     * Sets the product title
     *
     * @param  $title
     * @return SxCms_Product
     */
	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

    /**
     * Returns product title
     * 
     * @return string
     */
	public function getTitle()
	{
		return $this->title;
	}

    /**
     * Validates product title
     *
     * @todo refactor into seperate validation object
     * @return bool
     */
	public function validateTitle()
	{
		$validator = new Zend_Validate_StringLength(2, 255);
		if ($validator->isValid($this->title)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance('SxCms_Product');
		$msg->addMessage('title', $validator->getMessages(), 'title');
		return false;
	}

    /**
     * Sets product summary
     * 
     * @param  $summary
     * @return SxCms_Product
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Returns product summary
     * 
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Validates product summary
     * 
     * @return bool
     */
    public function validateSummary()
    {
        $validator = new Zend_Validate_StringLength(2, 255);
        if ($validator->isValid($this->summary)) {
            return true;
        }

        $msg = Sanmax_MessageStack::getInstance('SxCms_Product');
        $msg->addMessage('summary', $validator->getMessages(), 'title');
        return false;
    }

    /**
     * Sets product's full description
     * 
     * @param  $description
     * @return SxCms_Product
     */
	public function setDescription($description)
	{
		$this->description = $description;
		return $this;
	}

    /**
     * Returns product's full description
     * 
     * @return string
     */
	public function getDescription()
	{
		return $this->description;
	}

    /**
     * Validates product's full description
     * 
     * @return bool
     */
	public function validateDescription()
	{
		$validator = new Zend_Validate_StringLength(2);
		if ($validator->isValid($this->description)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance('SxCms_Product');
		$msg->addMessage('description', $validator->getMessages(), 'description');
		return false;
	}

    /**
     * Sets the product price
     *
     * @param  $price
     * @return SxCms_Product
     */
	public function setPrice($price)
	{
		$this->price = $price;
		return $this;
	}

    /**
     * Returns product price
     * 
     * @return string
     */
	public function getPrice()
	{
		return number_format($this->price, 2, '.', '');
	}

    /**
     * Adds a product image
     * 
     * @param  $filename
     * @return SxCms_Product
     */
	public function addImage($filename)
	{
		$this->images[] = $filename;
		return $this;
	}

    /**
     * Returns a list of product images
     * 
     * @return array
     */
	public function getImages()
	{
		return $this->images;
	}

    /**
     * Loads product state from datastorage
     * 
     * @return SxCms_Product
     */
	public function loadState()
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('p' => 'Product'), array('p.*'))
			->join(array('t' => 'ProductTsl'), 'p.product_id = t.product_id', array('t.*'))
			->where('p.product_id = ?', $this->id)
			->where('t.language = ?', $this->getLanguage());

		$result = $db->fetchAll($select);

		foreach ($result as $product) {
			$this->setId($product['product_id'])
				->setTitle($product['title'])
				->setDescription($product['description'])
				->setSummary($product['summary'])
				->setPrice($product['price']);

			$category = new SxCms_Product_Category();
			$category->setId($product['category_id'])
				->setLanguage($this->getLanguage());
			$category->loadState();

			$this->setCategory($category);
		}

		return $this;
	}

    /**
     * Validates product object
     * 
     * @return bool
     */
	public function isValid()
	{
		$this->validateTitle();
		$this->validateDescription();
		$this->validateCategory();

		if (!Sanmax_MessageStack::getInstance('SxCms_Product')->getNamespaceMessages()) {
			return true;
		}

		return false;
	}

    /**
     * Deletes product from datastorage
     * 
     * @return bool
     */
	public function delete()
	{
		$db = Zend_Registry::get('db');
		$db->delete('Product', 'product_id = ' . $this->getId());

		return true;
	}

    /**
     * Saves product onto datastorage
     * 
     * @return SxCms_Product
     */
	public function save()
	{
		$db = Zend_Registry::get('db');
		$identity = Zend_Auth::getInstance()->getIdentity();

		$data = array(
			'author_id'	   => $identity->getId(),
			'category_id'  => $this->getCategory()->getId(),
			'active' 	   => 0,
			'price'		   => $this->getPrice()
		);

		if ($this->id) {
			$db->update('Product', $data, 'product_id = ' . $this->id);
		} else {
			$data['date_created'] = new Zend_Db_Expr('NOW()');
			$db->insert('Product', $data);
			$this->setId($db->lastInsertId());
		}

		$tslData = array(
			'product_id'  => $this->id,
			'title'		  => $this->getTitle(),
		    'summary'     => $this->getSummary(),
			'description' => $this->getDescription(),
		);

		$query = $db->select()
			->from('ProductTsl', 'COUNT(*)')
			->where('product_id = ?', $this->id)
			->where('language = ?', $this->getLanguage());

		if ($db->fetchOne($query)) {
			$db->update('ProductTsl', $tslData,
				'product_id = ' . $this->id .
				' AND language = \'' . $this->getLanguage() . '\'');
		} else {
			$config = Zend_Registry::get('config');
			foreach ($config->system->language as $lng => $slng) {
				$tslData['language'] = $lng;
				$db->insert('ProductTsl', $tslData);
			}
		}

		return $this;
	}
}
