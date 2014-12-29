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

class SxCms_Group
{
    /**
     * Group identifier
     * @var integer
     */
	protected $id;

    /**
     * Group SAML identifier
     * @var string
     */
	protected $identifier;

    /**
     * Group name
     * @var string
     */
	protected $name;

    /**
     * Group ACL
     * @var Zend_Acl
     */
	protected $acl;

    /**
     * Sets group identifier
     * 
     * @param  $id
     * @return SxCms_Group
     */
	public function setId($id)
	{
		$this->id = (int) $id;
		return $this;
	}

    /**
     * Returns the group identifier
     *
     * @return int
     */
	public function getId()
	{
		return $this->id;
	}

    /**
     * Sets the SAML identifier
     * 
     * @param  $identifier
     * @return SxCms_Group
     */
	public function setIdentifier($identifier)
	{
		$this->identifier = (string) $identifier;
		return $this;
	}

    /**
     * Returns the SAML identifier
     * 
     * @return string
     */
	public function getIdentifier()
	{
		return $this->identifier;
	}

    /**
     * Sets the group name
     * 
     * @param  $name
     * @return SxCms_Group
     */
	public function setName($name)
	{
		$this->name = trim($name);
		return $this;
	}

    /**
     * Returns the group name
     * 
     * @return string
     */
	public function getName()
	{
		return $this->name;
	}

    /**
     * Sets the ACL for this group
     * 
     * @param Zend_Acl $acl
     * @return SxCms_Group
     */
	public function setAcl(Zend_Acl $acl)
	{
		$this->acl = $acl;
		return $this;
	}

    /**
     * Returns the ACL for this group
     * 
     * @return Zend_Acl
     */
	public function getAcl()
	{
		if (!$this->acl) {
			$acl = file_get_contents(APPLICATION_PATH . '/var/acl.php');
			$acl = @unserialize($acl);
            
			$this->acl = $acl ? $acl : new Zend_Acl();
		}

		return $this->acl;
	}

    /**
     * Is group allowed to access given resource
     *
     * @param  $resource
     * @param  $privilege
     * @return bool
     */
	public function isAllowed($resource, $privilege = null)
	{
		$acl = $this->getAcl();
		if ($acl->hasRole($this->name) && $acl->has($resource) && $acl->isAllowed($this->name, $resource, $privilege)) {
			return true;
		}

		return false;
	}
}
