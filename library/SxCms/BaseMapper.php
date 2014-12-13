<?php

abstract class SxCms_BaseMapper
{
	public function fromInput(array $input, array $allowed) {
		$allowedInput = array();

		foreach($input as $key => $value) {
			if(in_array($key, $allowed)) {
				$allowedInput[$key] = $value;
			}
		}

		return $allowedInput;
	}

	public function mapAll($array, $id_method = 'getId') {
		if(method_exists($this, 'toObject')) {
	        $items = array();
	        foreach($array as $values) {
	            $item = $this->toObject($values);

				if(method_exists($this, $id_method)) {
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

	public function merge($input1, $input2, $output = 'object') {
		if(method_exists($this, 'toObject') && method_exists($this, 'toArray')) {
			if(is_object($input1) && is_object($input2)) {
				$ar1 = $this->toArray($input1);
				$ar2 = $this->toArray($input2);
				$result = array_merge($ar1, $ar2);
			}
			elseif(is_object($input1) && is_array($input2)) {
				$ar1 = $this->toArray($input1);
				$result = array_merge($ar1, $input2);
			}
			elseif(is_array($input1) && is_object($input2)) {
				$ar2 = $this->toArray($input2);
				$result = array_merge($input1, $ar2);
			}
			elseif(is_array($input1) && is_array($input2)) {
				$result = array_merge($input1, $input2);
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
}