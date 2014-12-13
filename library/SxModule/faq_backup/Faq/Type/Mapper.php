<?php

class SxModule_Faq_Type_Mapper extends Base_Mapper
{

	public function toObject(Array $import, $instance = false) {
		$fields = array(
			'type_id' => array( 'type' => 'int', 'set' => 'setId' ),
			'tsl_id' => array( 'type' => 'int', 'set' => 'setTslId' ),
			'name' => array( 'type' => 'string', 'set' => 'setName' ),
			'url' => array( 'type' => 'string', 'set' => 'setUrl' ),
			'language' => array( 'type' => 'string', 'set' => 'setLanguage' ),
			'active' => array( 'type' => 'int', 'set' => 'setActive' )
		);

		$flag = ($instance == false) ? 'new' : 'existing';

		if($instance == false) $instance = new SxModule_Faq_Type();

		$instance = $this->automapFieldsToObject($import, $fields, $instance, $flag);

		return $instance;
	}

	public function toArray(SxModule_Faq_Type $item, $type = '*') {
		$data = array(
			'type_id' => $item->getId(),
			'active' => $item->getActive()
		);

		$tsl = array(
			'language' => $item->getLanguage(),
			'url' => $item->getUrl(),
			'name' => $item->getName()
		);

		if($type == 'item') return $data;
		elseif($type == 'tsl') return $tsl;

		return array_merge($data, $tsl);
	}

}
