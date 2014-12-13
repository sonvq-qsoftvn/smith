<?php

class SxCms_PaginatorAdapter extends Zend_Paginator_Adapter_DbSelect
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

	public function addSecundairyMapper($instance, $set_method, $mapper_method_name = 'toObject') {
		$this->_secundairy_mappers[] = array(
			'instance' => $instance,
			'set_method' => $set_method,
			'mapper_method' => $mapper_method_name
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
				$item->{$secundairy['set_method']}( $secundairy['instance']->{$secundairy['mapper_method']}($row) );
			}

			$items[$item->{$this->_id_method}()] = $item;
        }

		return $items;
	}
}