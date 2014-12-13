<?php

/**
 * @Author: Kurt Aerts <kurt@sanmax.be>
 * @Copyright: 2012 © Sanmax
 * @Link: http://www.sanmax.be/
 */
abstract class Base_Mapper
{
	protected $_secundairy_mappers = array();
	
	public function fromInput(array $input, array $allowed) {
		$allowedInput = array();

		foreach($input as $key => $value) {
			if(in_array($key, $allowed)) {
				$allowedInput[$key] = $value;
			}
		}

		return $allowedInput;
	}




	public function addSecundairyMapper($instance, $set_method, $mapper_method_name = 'toObject') {
		$this->_secundairy_mappers[] = array(
			'instance' => $instance,
			'set_method' => $set_method,
			'mapper_method' => $mapper_method_name
		);

		return $this;
	}

	public function mapAll($array, $id_method = 'getId') {
		if(method_exists($this, 'toObject')) {
	        $items = array();
	        foreach($array as $values) {
	            $item = $this->toObject($values);

				foreach($this->_secundairy_mappers as $secundairy) {
					$item->{$secundairy['set_method']}( $secundairy['instance']->{$secundairy['mapper_method']}($values) );
				}

				if(method_exists($item, $id_method)) {
					$items[$item->{$id_method}()] = $item;
				}
				else {
					$items[] = $item;
				}
	        }

			return $items;
		}
		else {
			throw new Exception(get_parent_class($this).' - SxCms_BaseMapper: method toObject is required for mapAll!');
			return null;
		}
	}




	public function merge($input1, $input2, $output = 'object', $overwrite_null_fields = false, $keep_fields = false) {
		if(method_exists($this, 'toObject') && method_exists($this, 'toArray')) {
			if(is_object($input1) && is_object($input2)) {
				$ar1 = $this->toArray($input1);
				$ar2 = $this->toArray($input2);
				$result = array_merge($ar1, $ar2);

				if($overwrite_null_fields == true) {
					foreach($ar1 as $key => $value) {
						if(isset($ar2[$key]) && $ar2[$key] === null) {
							$result[$key] = $value;
						}
					}
				}

				if(is_array($keep_fields)) {
					foreach($keep_fields as $key) {
						if(isset($ar1[$key])) {
							$result[$key] = $ar1[$key];
						}
					}
				}
			}
			elseif(is_object($input1) && is_array($input2)) {
				$ar1 = $this->toArray($input1);
				$result = array_merge($ar1, $input2);

				if($overwrite_null_fields == true) {
					foreach($ar1 as $key => $value) {
						if(isset($input2[$key]) && $input2[$key] === null) {
							$result[$key] = $value;
						}
					}
				}

				if(is_array($keep_fields)) {
					foreach($keep_fields as $key) {
						if(isset($ar1[$key])) {
							$result[$key] = $ar1[$key];
						}
					}
				}
			}
			elseif(is_array($input1) && is_object($input2)) {
				$ar2 = $this->toArray($input2);
				$result = array_merge($input1, $ar2);

				if($overwrite_null_fields == true) {
					foreach($input1 as $key => $value) {
						if(isset($ar2[$key]) && $ar2[$key] === null) {
							$result[$key] = $value;
						}
					}
				}

				if(is_array($keep_fields)) {
					foreach($keep_fields as $key) {
						if(isset($input1[$key])) {
							$result[$key] = $input1[$key];
						}
					}
				}
			}
			elseif(is_array($input1) && is_array($input2)) {
				$result = array_merge($input1, $input2);

				if($overwrite_null_fields == true) {
					foreach($input1 as $key => $value) {
						if(isset($input2[$key]) && $input2[$key] === null) {
							$result[$key] = $value;
						}
					}
				}

				if(is_array($keep_fields)) {
					foreach($keep_fields as $key) {
						if(isset($input1[$key])) {
							$result[$key] = $input1[$key];
						}
					}
				}
			}

			if(isset($result)) {
				return ($output == 'object') ? $this->toObject($result) : $result;
			}
			else {
				throw new Exception(get_parent_class($this).' - SxCms_BaseMapper: merge failed! Incorrect $input1 and/or $input2');
				return null;
			}
		}
		else {
			throw new Exception(get_parent_class($this).' - SxCms_BaseMapper: methods toObject and toArray are required for merge!');
			return null;
		}
	}

	public function getNotDefinedFields($defined, $object) {
		if(is_array($defined)) {
			$keys = array_keys($this->toArray( $object() ));
			$notDefined = array();

			foreach($keys as $key) {
				if(!in_array($key, $defined)) {
					$notDefined[] = $define;
				}
			}

			return $notDefined;
		}

		return array();
	}




	public function automapFieldsToObject($import, $fields, $instance, $flag) {
		if($flag == 'new') {
			foreach($fields as $field) {
				if($field['type'] == 'int') {
					$instance->$field['set']( 0 );
				}
				else {
					$instance->$field['set']( '' );
				}
			}
		}

		foreach($import as $key => $value) {
			if(array_key_exists($key, $fields)) {
				if($fields[$key]['type'] == 'int') {
					$instance->$fields[$key]['set']( (int) $value );
				}
				else {
					$instance->$fields[$key]['set']( $value );
				}
			}
		}

		return $instance;
	}
}