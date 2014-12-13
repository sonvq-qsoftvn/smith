<?php

class SxModule_Securedocs_File_Proxy
{
	public function getFile(SxModule_Securedocs_File $file) {
		$encoded = base64_encode($file->getPath() . "/" . $file->getFilename());

		$db = Zend_Registry::get('db');
		$select = $db->select()
			->from('SecureFilemanager', array('*'))
			->where('filename LIKE "' . $encoded . '"');

		$rows = $db->query($select)->fetchAll();

		if($rows) {
			$file->setSummary($rows[0]['summary']);
			$file->setMail($rows[0]['mail']);
		}
		return $file;
	}
}