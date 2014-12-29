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

class SxCms_Job_Profession
{
    /**
     * unique identifier on datasource
     * @var integer
     */
    protected $id;

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
            'name'        => $this->getName(),
            'description' => $this->getDescription(),
            'language'    => $this->getLanguage(),
        );

        if ($this->id) {
            return $db->update('VacancyProf', $data, 'vacancy_prof_id = ' . $this->id);
        }

        $db->insert('VacancyProf', $data);
        $this->setId($db->lastInsertId());

        return $this;
    }

    public function delete()
    {
        $db = Zend_Registry::get('db');
        return $db->delete('VacancyProf', 'vacancy_prof_id = ' . $this->getId());
    }
}
