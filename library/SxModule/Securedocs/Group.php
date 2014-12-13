<?php

class SxModule_Securedocs_Group
{
	protected $_tmx;
	protected $_groupId;
	protected $_group;
	protected $_maps = array();

	public function setTmx($tmx) {
		$this->_tmx = $tmx;
		return $this;
	}

	public function setGroupId($id) {
		$this->_groupId = (int)$id;
		return $this;
	}
	public function getGroupId() {
		return $this->_groupId;
	}

	public function setGroup($group) {
		$this->_group = $group;
		return $this;
	}
	public function getGroup() {
		return $this->_group;
	}

	public function setMaps($maps) {
		if(is_array($maps)) {
			$this->_maps = $maps;
		}
		else {
			$this->_maps[] = $maps;
		}
		return $this;
	}
	public function getMaps() {
		return $this->_maps;
	}

	public function resetGroups() {
		$this->_maps = array();
	}




	public function validateGroup() {
		$validator = new Zend_Validate_StringLength(2, 255);
		$validator->setMessage($this->_tmx->_('error.verplicht.min'), Zend_Validate_StringLength::TOO_SHORT);
		$validator->setMessage($this->_tmx->_('error.verplicht.max'), Zend_Validate_StringLength::TOO_LONG);

		if($validator->isValid($this->_group)) {
			return true;
		}

		$msg = Sanmax_MessageStack::getInstance('SxModule_Securedocs_Group');
		$msg->addMessage('group', $validator->getMessages(), 'settings');
		return false;
	}

	public function isValid() {
		$this->validateGroup();

		return count(Sanmax_MessageStack::getInstance('SxModule_Securedocs_Group')->getNamespaceMessages()) == 0;
	}

	public function save() {
		$db = Zend_Registry::get('db');

		$data = array('group' => $this->getGroup());

		if(!$this->getGroupId()) {
			$db->insert('SecureDocsGroup', $data);
			$lastId = $db->lastInsertId();
			$db->delete('SecureDocsGroupMaps', 'group_id = ' . (int)$lastId);

			if($this->_maps['0'] != '') {
				foreach($this->_maps as $map) {
					$db->insert('SecureDocsGroupMaps', array(
						'group_id' => $lastId,
						'mapname' => $map
					));
				}
			}
		}
		else {
			$db->update('SecureDocsGroup', $data, 'group_id = ' . $this->getGroupId());
			$lastId = $this->getGroupId();
			$db->delete('SecureDocsGroupMaps', 'group_id = ' . $lastId);
			if($this->_maps['0'] != '') {
				foreach($this->_maps as $map) {
					$db->insert('SecureDocsGroupMaps', array( 'group_id' => (int)$lastId, 'mapname' => $map ));
				}
			}
		}
		return true;
	}

	public function delete() {
		$db = Zend_Registry::get('db');
		$db->delete('SecureDocsGroup', 'group_id = ' . $this->getGroupId());
		$db->delete('SecureDocsGroupMaps', 'group_id = ' . $this->getGroupId());
	}

	public function sendMails($file) {
		$config = Zend_Registry::get('config');

		foreach($this->getMembers() as $member) {
			$mail = new Zend_Mail();
			$mail->setSubject("New message from {$config->company->name}")
				->setFrom($config->company->email, $config->company->name)
				->addTo($member->getEmail());

			$body = "<h2 style='font-size: 14px;'>Dear " . $member->getFullName() . "</h2>\n\nA new file was posted in the group " . $this->getGroup() . " on " . $config->company->website . " <br />\n";
			$body .= "<a href='" . $config->company->website . "/file/download/filename/" . $file . "'>click here</a> to download it.<br /><br />\n\n";
			$body .= "Greetings {$config->company->name}.";
			$mail->setBodyText(strip_tags($body));
			$mail->setBodyHtml($body);

			$mail->send();
		}
	}
}