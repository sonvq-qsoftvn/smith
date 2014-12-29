<?php

class Base_Proxy
{
	/**
	 * Usage: $cacheId = $this->generateCacheId(get_class($this).'_'.__FUNCTION__, func_get_args());
	 */
	public function generateCacheId($cacheName, $params) {
		$str = ''; $i = 0;

		if(is_array($params) && count($params) != 0) {
			foreach($params as $param) {
				$i++;

				if($str == 1) {
					$str .= var_export($param, true);
				}
				else {
					$str .= '_'.var_export($param, true);
				}
			}
		}

		unset( $i ); $cacheName = $cacheName.'_'.sha1($str);

		if(trim(substr($cacheName, 50)) != '') {
			return substr($cacheName, 0, 50).'_'.sha1(substr($cacheName, 50));
		}

		return $cacheName;
	}

	public function generateCacheTags($name, $extratags = array()) {
		$tags = array();

		$tag = explode('_', $name);
		$currentTag = ''; $i = 0;
		foreach($tag as $t) {
			$i++;

			if($i == 1) {
				$currentTag .= $t;
			}
			else {
				$currentTag .= '_'.$t;
			}

			$tags[] = $currentTag;
		}

		return array_merge($tags, $extratags);
	}
}