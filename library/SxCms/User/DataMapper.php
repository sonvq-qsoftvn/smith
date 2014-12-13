<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: DataMapper.php 8235 2010-05-31 14:23:48Z andries $
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
 * @package    SxCms_User_DataMapper
 * @copyright  Copyright (c) 2009 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_User_DataMapper
{
	public function loadDefaults(SxCms_User $user, $values)
	{
	   $user->setId($values['id'])
	       ->setName($values['name']);
	}

    /**
     * Convert an array (usually a database row) to a user object
     * 
     * @param  $import
     * @return SxCms_User
     */
    public function toObject(Array $import)
    {
        $fields = array(
            'user_id'    => null,
            'active'     => null,
            'email'      => null,
            'first_name' => null,
            'last_name'  => null,
        );

        foreach ($import as $key => $value) {
            if (array_key_exists($key, $fields)) {
                $fields[$key] = $value;
            }
        }

		$user = new SxCms_User();
		$user->setId($fields['user_id'])
		    ->setActive($fields['active'])
			->setEmail($fields['email'])
			->setFirstName($fields['first_name'])
			->setLastName($fields['last_name']);

        return $user;
    }

    /**
     * Delete a user on the datasource
     * 
     * @param SxCms_User $user
     * @return int
     */
	public function delete(SxCms_User $user)
	{
		$db = Zend_Registry::get('db');
		return $db->delete('User', 'user_id = ' . $user->getId());
	}

    /**
     * Fetch a user by his identifier
     * 
     * @param  $id
     * @return SxCms_User
     */
	public function getById($id)
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from(array('u' => 'User'), array('*'))
			->where('u.user_id = ' . (int) $id);

		$result = $db->fetchRow($select);
		$user = $this->toObject($result);

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('UserGroup', array('group_id', 'Group.name'))
			->join('Group', 'UserGroup.group_id = Group.group_id')
			->where('user_id = ' . (int) $id);

		$result = $db->fetchAll($select);
		foreach ($result as $row) {    
			$group = new SxCms_Group();
			$group->setId($row['group_id'])
				->setName($row['name']);

			$user->addGroup($group);
		}

		return $user;
	}

    /**
     * Fetch all users from datasource
     * 
     * @return array
     */
	public function getAllUsers()
	{
		$db = Zend_Registry::get('db');
        $select = $db->select()
            ->from(array('u' => 'User'), array('*'))
            ->order('u.first_name')
            ->order('u.last_name');

        $results = $db->fetchAll($select);

        $users = array();
        foreach($results as $result) {
            $user = $this->toObject($result);
			$users[$user->getId()] = $user;
        }

        return $users;
	}
}
