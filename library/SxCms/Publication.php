<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: Publication.php 8227 2010-05-31 12:19:36Z andries $
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
 * @package    SxCms_Publication
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Publication
{
	/**
	 * unique identifier on datasource
	 * @var integer
	 */
    protected $id;

    /**
     * publication category
     * @var SxCms_Publication_Category
     */
    protected $category;

    /**
     * publication name
     * @var string
     */
    protected $name = '';

    /**
     * short description of publication
     * @var string
     */
    protected $description;

    /**
     * full content of publication
     * @var string
     */
    protected $content;

    /**
     * filename which links to the publication
     * @var string
     */
    protected $filename;

    /**
     * publication date
     * @var string
     */
    protected $date;

    /**
     * language identifier
     * @var string
     */
    protected $language = 'nl';

	/**
	 * @return integer
	 */
	public function getId()
	{
		return (int) $this->id;
	}

	/**
     * Sets the unique identifier
     * 
	 * @param integer $id
     * @return SxCms_Publication
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
     * Returns the category to which this publication is assigned
     * 
	 * @return SxCms_Publication_Category
	 */
	public function getCategory()
	{
		if (!$this->category) {
			$this->category = new SxCms_Publication_Category();
		}

		return $this->category;
	}

    /**
     * Sets the category to which this publication is assigned
     * 
     * @param SxCms_Publication_Category $cat
     * @return SxCms_Publication
     */
	public function setCategory(SxCms_Publication_Category $cat)
	{
		$this->category = $cat;
		return $this;
	}

	/**
     * Returns the language of this publication
     * 
	 * @return string
	 */
	public function getLanguage()
	{
		return (string) $this->language;
	}

    /**
     * Sets the language of the publication
     * 
     * @param  $language
     * @return SxCms_Publication
     */
	public function setLanguage($language)
	{
		$this->language = $language;
        return $this;
	}

	/**
     * Returns the name of the publication
     * 
	 * @return string
	 */
	public function getName()
	{
		return (string) $this->name;
	}

	/**
     * Sets the name of the publication
     * 
     * @param  $name
     * @return SxCms_Publication
     */
	public function setName($name)
	{
		$this->name = $name;
        return $this;
	}

    /**
     * Returns a short summary of the publication
     * 
     * @return string
     */
	public function getDescription()
	{
		return (string) $this->description;
	}

    /**
     * Sets a short summary about the publication
     * 
     * @param  $description
     * @return SxCms_Publication
     */
	public function setDescription($description)
	{
		$this->description = $description;
		return $this;
	}

    /**
     * Returns full content of the publication
     * 
     * @return string
     */
    public function getContent()
    {
        return (string) $this->content;
    }

    /**
     * Sets full content of the publication
     * 
     * @param  $content
     * @return SxCms_Publication
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

	/**
     * Returns the date on which the publication was published
     * 
	 * @return string
	 */
	public function getPublicationDate()
	{
		return (string) $this->date;
	}

	/**
     * Sets the date on which the publication was published
     * 
     * @param  $date
     * @return SxCms_Publication
	 */
	public function setPublicationDate($date)
	{
		$this->date = $date;
		return $this;
	}

    /**
     * Saves publication onto the datastorage
     * 
     * @return SxCms_Publication
     */
    public function save()
    {
        $db = Zend_Registry::get('db');
        $data = array(
            'publication_cat_id' => $this->getCategory()->getId(),
            'name'        => $this->getName(),
            'description' => $this->getDescription(),
            'content'     => $this->getContent(),
            'publication_date' => $this->getPublicationDate(),
            'language'    => $this->getLanguage(),
        );

        if ($this->id) {
            return $db->update('Publication', $data, 'publication_id = ' . $this->id);
        }

        $db->insert('Publication', $data);
        $this->setId($db->lastInsertId());

        return $this;
    }

    /**
     * Delete publication on datastorage
     * 
     * @return integer
     */
    public function delete()
    {
        $db = Zend_Registry::get('db');
        return $db->delete('Publication', 'publication_id = ' . $this->getId());
    }
}
