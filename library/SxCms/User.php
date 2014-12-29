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
class SxCms_User
{
	/**
	 * Unique identifier
	 * @var integer
	 */
	protected $id = null;

	/**
	 * Flag if user is active
	 * @var boolean
	 */
	protected $active = false;

	/**
	 * Email address
	 * @var string
	 */
	protected $email = '';

	/**
	 * Password
	 * @var string
	 */
	protected $password = '';

	/**
	 * First name
	 * @var string
	 */
	protected $firstName = '';

	/**
	 * Last name
	 * @var string
	 */
	protected $lastName = '';

	/**
	 * User groups
	 * @var array
	 */
	protected $groups = array();

	/**
	 * Sets the unique identifier
	 *
	 * @param integer $id
	 * @return SxCms_User
	 */
	public function setId($id)
	{
		$this->id = $id;
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
	 * Sets the email address
	 *
	 * @param string $email
	 */
	public function setEmail($email)
	{
		$this->email = strtolower(trim($email));
		return $this;
	}

	/**
	 * Gets the email address
	 *
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Sets the password
	 *
	 * @param string $password
	 * @return SxCms_User
	 */
	public function setPassword($password)
	{
		$this->password = (string) $password;
		return $this;
	}

	/**
	 * Get the user's password
	 *
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Sets the first name
	 *
	 * @param string $fname
	 * @return SxCms_User
	 */
	public function setFirstName($fname)
	{
		$this->firstName = (string) $fname;
		return $this;
	}

	/**
	 * Gets the first name
	 *
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * Sets the last name
	 *
	 * @param string $name
	 * @return SxCms_User
	 */
	public function setLastName($name)
	{
		$this->lastName = (string) $name;
		return $this;
	}

	/**
	 * Gets the last name
	 *
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * Gets the full name
	 *
	 * @return string
	 */
	public function getFullName()
	{
		return $this->getFirstName() . ' ' . $this->getLastName();
	}

	/**
	 * Sets a flag to indicate if the user is active
	 *
	 * @param boolean $active
	 * @return SxCms_User
	 */
	public function setActive($active = true)
	{
		$this->active = (bool) $active;
		return $this;
	}

	/**
	 * Gets if the user is active
	 *
	 * @return boolean
	 */
	public function isActive()
	{
		return $this->active === true;
	}

    /**
     * Add a group that the user belongs to. A user can be assigned to multiple groups
     * 
     * @param SxCms_Group $group
     * @return SxCms_User
     */
	public function addGroup(SxCms_Group $group)
	{
		$this->groups[$group->getId()] = $group;
		return $this;
	}

    /**
     * Get the groups this user belongs to
     * 
     * @return array
     */
	public function getGroups()
	{
		return $this->groups;
	}

    /**
     * Is this user allowed to access the given resource
     * 
     * @param  $resource
     * @param  $privilege
     * @return bool
     */
	public function isAllowed($resource, $privilege)
	{
		if (!is_array($privilege)) {
			$privilege = array($privilege);
		}

		foreach ($privilege as $priv) {
			foreach ($this->groups as $group) {
				if ($group->isAllowed($resource, $priv)) {
					return true;
				}
			}
		}

		return false;
	}

    /**
     * Is this user allowed to access at least one of the resources
     * 
     * @param  $resource
     * @return bool
     */
	public function isAllowedAtLeastOne($resource)
	{
		foreach ($this->groups as $group) {
			if ($group->isAllowed($resource)) {
				return true;
			}
		}

		return false;
	}

    /**
     * Login the user and create an identity
     * 
     * @return bool
     */
	public function login()
	{
		$dbAdapter = Zend_Registry::get('db');
		$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
		$authAdapter
		    ->setTableName('User')
		    ->setIdentityColumn('email')
		    ->setCredentialColumn('password')
		    ->setCredentialTreatment('SHA1(?)');

		$authAdapter
		    ->setIdentity($this->getEmail())
		    ->setCredential($this->password);

		$auth = Zend_Auth::getInstance();
		$result = $auth->authenticate($authAdapter);
		if (!$result->isValid()) {
			return false;
		}

	    $user = $authAdapter->getResultRowObject(null, 'password');
        if ($user && !$user->active) {
            $msg = Sanmax_MessageStack::getInstance('SxCms_User');
            $msg->addMessage('email', array("email" => "Gebruiker is niet actief"));
            $auth->clearIdentity();

            return false;
        }

		$mapper = new SxCms_User_DataMapper();
		$user = $mapper->getById($user->user_id);

	    $storage = $auth->getStorage();
	    $storage->write($user);

	    return true;
	}

    /**
     * Save user onto the datastorage
     * 
     * @return bool
     */
	public function save()
	{
		$db = Zend_Registry::get('db');
		$user = array(
			'email' 	 => $this->email,
			'active'     => $this->active,
			'first_name' => $this->firstName,
			'last_name'  => $this->lastName
		);

		if ($this->password) {
			$user['password'] = sha1($this->password);
		}

		if ($this->id !== null) {
			$user['date_updated'] = new Zend_Db_Expr('CURDATE()');
			$db->update('User', $user, 'user_id = ' . $this->id);
		} else {
			$user['date_created'] = new Zend_Db_Expr('CURDATE()');
			$db->insert('User', $user);
			$this->setId($db->lastInsertId());
		}

		if ($this->groups) {
			if ($this->id) {
                $db->delete('UserGroup', 'user_id = ' . $this->id);
            }

			foreach ($this->groups as $group) {
				$gdata = array(
					'user_id'  => $this->id,
					'group_id' => $group->getId(),
				);
				$db->insert('UserGroup', $gdata);
			}
		}
        
		return true;
	}

    /**
     * Activate the user. Only activated users are able to login
     * 
     * @return bool
     */
	public function activate()
	{
		$db = Zend_Registry::get('db');
		$user = array('active'    => ((- $this->active)  + 1) );

		$db->update('User', $user, 'user_id = ' . $this->id);

		return true;
	}
}
