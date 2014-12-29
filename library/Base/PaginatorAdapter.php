<?php

class Base_PaginatorAdapter extends Zend_Paginator_Adapter_DbSelect
{
	protected $_mapper;
	protected $_id_method = 'getId';

	protected $_secundairy_mappers = array();

	public function setMapper($instance, $method_name = 'toObject') {
		$this->_mapper = array(
			'instance' => $instance,
			'method' => $method_name
		);

		return $this;
	}

	public function setIdMethod($name) {
		$this->_id_method = $name;
		return $this;
	}

	public function addSecundairyMapper($instance, $set_method, $data = false,  $data_method = false, $data_key = false, $mapper_method_name = 'toObject') {
		$this->_secundairy_mappers[] = array(
			'instance' => $instance,
			'set_method' => $set_method,
			'mapper_method' => $mapper_method_name,
			'data' => $data,
			'data_method' => $data_method,
			'data_key' => $data_key
		);

		return $this;
	}

	public function getItems($offset, $itemCountPerPage)
	{
		$this->_select->limit($itemCountPerPage, $offset);
		$rowset = $this->_select->query()->fetchAll();

		$items = array();
        foreach($rowset as $row) {
            $item = $this->_mapper['instance']->{$this->_mapper['method']}($row);

			foreach($this->_secundairy_mappers as $secundairy) {
				if($secundairy['data'] === false) {
					$item->{$secundairy['set_method']}( $secundairy['instance']->{$secundairy['mapper_method']}($row) );
				}
				elseif(is_array($secundairy['data']) && $secundairy['data_method'] != false && $secundairy['data_key'] != false) {
					foreach($secundairy['data'] as $s_row) {
						if ($item->$secundairy['data_method']() == $s_row[$secundairy['data_key']]) {
							$item->{$secundairy['set_method']}( $secundairy['instance']->{$secundairy['mapper_method']}($s_row) );
						}
					}
				}
			}

			$items[$item->{$this->_id_method}()] = $item;
        }

		return $items;
	}
}