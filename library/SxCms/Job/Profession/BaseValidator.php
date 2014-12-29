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
class SxCms_Job_Profession_BaseValidator
{
    /**
     * Profession object
     * @var SxCms_Job_Profession
     */
    protected $category;

    /**
     * Validate category data
     *
     * @return boolean
     */
    public function validate(SxCms_Job_Profession $category)
    {
        $this->category = $category;

        $this->_validateName();
        $this->_validateDescription();

        if (!Sanmax_MessageStack::getInstance('SxCms_Job_Profession')->getNamespaceMessages()) {
            return true;
        }

        return false;
    }

    /**
     * Validates job title
     *
     * @return boolean
     */
    protected function _validateName()
    {
        $validator = new Zend_Validate_StringLength(2, 255);
        if ($validator->isValid($this->category->getName())) {
            return true;
        }

        $msg = Sanmax_MessageStack::getInstance('SxCms_Job_Profession');
        $msg->addMessage('name', $validator->getMessages());
        return false;
    }

    /**
     * Validates job description
     *
     * @return boolean
     */
    protected function _validateDescription()
    {
        $validator = new Zend_Validate_StringLength(2);
        if ($validator->isValid($this->category->getDescription())) {
            return true;
        }

        $msg = Sanmax_MessageStack::getInstance('SxCms_Job_Profession');
        $msg->addMessage('description', $validator->getMessages());
        return false;
    }
}
