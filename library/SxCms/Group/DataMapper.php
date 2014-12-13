<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: DataMapper.php 8223 2010-05-31 11:45:18Z andries $
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
 * @package    SxCms_Group_DataMapper
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Group_DataMapper
{
    public function toObject(Array $import)
    {
        $fields = array(
            'group_id'   => null,
            'name'       => null,
            'identifier' => null,
        );

        foreach ($import as $key => $value) {
            if (array_key_exists($key, $fields)) {
                $fields[$key] = $value;
            }
        }

		$group = new SxCms_Group();
		$group->setId($fields['group_id'])
			  ->setName($fields['name'])
			  ->setIdentifier($fields['identifier']);

        return $group;
    }
    
	public function save(SxCms_Group $group)
	{
		$db = Zend_Registry::get('db');
		$data = array(
			'identifier' => $group->getIdentifier(),
			'name' => $group->getName(),
		);

		file_put_contents(APPLICATION_PATH . '/var/acl.php', serialize($group->getAcl()));

		if ($group->getId()) {
			$data['date_updated'] = new Zend_Db_Expr('CURDATE()');
			$db->update('Group', $data, 'group_id = ' . $group->getId());

			return true;
		}

		$data['date_created'] = new Zend_Db_Expr('CURDATE()');
		$db->insert('Group', $data);
		$group->setId($db->lastInsertId());

		return true;
	}

	public function getById($id)
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('Group', array('*'))
			->where('group_id = ?', (int) $id);

		$stmt = $db->query($select);
		$result = $stmt->fetch();

		$group = $this->toObject($result);
		return $group;
	}

    public function getBySamlId($id)
    {
        $db = Zend_Registry::get('db');
        $select = $db->select()
            ->from('Group', array('*'))
            ->where('identifier  = ?', (string) $id);

        $stmt = $db->query($select);
        $result = $stmt->fetch();

        if (!$result) {
        	return false;
        }

        $group = $this->toObject($result);
        return $group;
    }

	public function getAll()
	{
		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('Group', array('*'))
			->order('name');

		$stmt = $db->query($select);
		$rows = $stmt->fetchAll();

		$groups = array();
		foreach ($rows as $result) {
			$group = $this->toObject($result);
			$groups[$group->getId()] = $group;
		}

		return $groups;
	}

	public function delete(SxCms_Group $group)
	{
		$db = Zend_Registry::get('db');
		return $db->delete('Group', 'group_id = ' . $group->getId());
	}
}
