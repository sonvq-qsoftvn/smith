<?php

class SxModule_Faq_Mapper extends Base_Mapper
{

	public function toObject(Array $import, $instance = false) {
		$fields = array(
			'id' => array( 'type' => 'int', 'set' => 'setId' ),
			'tsl_id' => array( 'type' => 'int', 'set' => 'setTslId' ),
			'type' => array( 'type' => 'string', 'set' => 'setType' ),
			'active' => array( 'type' => 'int', 'set' => 'setActive' ),
			'name' => array( 'type' => 'string', 'set' => 'settypeName' ),
			'language' => array( 'type' => 'string', 'set' => 'setLanguage' ),
			'question' => array( 'type' => 'string', 'set' => 'setQuestion' ),
			'answer' => array( 'type' => 'string', 'set' => 'setAnswer' )
		);

		$flag = ($instance == false) ? 'new' : 'existing';

		if($instance == false) $instance = new SxModule_Faq();

		$instance = $this->automapFieldsToObject($import, $fields, $instance, $flag);

		return $instance;
	}

	public function toArray(SxModule_Faq $item, $type = '*') {
		$data = array(
			'id' => $item->getId(),
			'type' => $item->getType(),
			'active' => $item->getActive()
		);

		$tsl = array(
			'language' => $item->getLanguage(),
			'question' => $item->getQuestion(),
			'answer' => $item->getAnswer()
		);

		if($type == 'item') return $data;
		elseif($type == 'tsl') return $tsl;

		return array_merge($data, $tsl);
	}

}
