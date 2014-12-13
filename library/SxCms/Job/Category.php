<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: Category.php 8234 2010-05-31 14:13:40Z andries $
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
 * @package    SxCms_Job_Category
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Job_Category
{
    /**
     * unique identifier on datasource
     * @var integer
     */
    protected $id;
    protected $parent;
    protected $subCats = array();
    
    /**
     * publication name
     * @var string
     */
    protected $name = '';

    /**
     * language identifier
     * @var string
     */
    protected $language = 'nl';

    /**
     * short description of publication
     * @var string
     */
    protected $description;

    /**
     * @return integer
     */
    public function getId()
    {
        return (int) $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    public function getParentId()
    {
    	return (int) $this->parent;
    }

    public function setParentId($id)
    {
        $this->parent = $id;
        return $this;
    }
    
    public function addSubCategory(SxCms_Job_Category $category)
    {
    	$this->subCats[$category->getId()] = $category;
    	return $this;
    }
    
    public function getSubCategories()
    {
    	return $this->subCats;
    }
    
    /**
     * @return string
     */
    public function getLanguage()
    {
        return (string) $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return (string) $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return (string) $this->description;
    }

    /**
     * @param string $name
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function save()
    {
        $db = Zend_Registry::get('db');
        $data = array(
        	'parent_id'   => $this->getParentId(),
            'name'        => $this->getName(),
            'description' => $this->getDescription(),
            'language'    => $this->getLanguage(),
        );

        if ($this->id) {
            return $db->update('VacancyCat', $data, 'vacancy_cat_id = ' . $this->id);
        }

        $db->insert('VacancyCat', $data);
        $this->setId($db->lastInsertId());

        return $this;
    }

    public function delete()
    {
        $db = Zend_Registry::get('db');
        return $db->delete('VacancyCat', 'vacancy_cat_id = ' . $this->getId());
    }
}
