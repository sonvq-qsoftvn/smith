<?php

/**
 * @Author: Kurt Aerts <info@kurtaerts.be>
 * @Copyright: 2012 © Kurt Aerts
 * @Link: http://www.kurtaerts.be/
 */
class SxModule_Twitter
{
	protected $options = array();

	public function __construct($options = array()) {
		$this->options = array_merge(
		array(
			'consumer_key' => '',
			'consumer_secret' => '',
			'user_token' => '',
			'user_secret' => '',
			'debug' => false,
			'caching_ttl' => 900 // vernieuwen om de 15 minuten oftewel 900 seconden
		), $options);
	}

	public function getTweets($params = array()) {
		/* Set locale to Dutch */
		setlocale(LC_ALL, 'nl_NL');

		$cacheId = 'Model_Twitter';
		$cache = Zend_Registry::get('cache');
		if(true == ($result = $cache->load($cacheId))) {
			if( ($result->timestamp+$this->options['caching_ttl']) < time() ) {
				$cache->clean(
					Zend_Cache::CLEANING_MODE_MATCHING_TAG,
					array(
						'Twitter_Webservice'
					)
				);
			}

			return $result->data;
		}
		else {
			require APPLICATION_ROOT.'/library/Twitter/tmhOAuth.php';
			require APPLICATION_ROOT.'/library/Twitter/tmhUtilities.php';

			$tmhOAuth = new tmhOAuth(array(
				'consumer_key' => $this->options['consumer_key'],
				'consumer_secret' => $this->options['consumer_secret'],
				'user_token' => $this->options['user_token'],
				'user_secret' => $this->options['user_secret'],
				'debug' => $this->options['debug']
			));

			$tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline'), $params);

			if($tmhOAuth->response['code'] == 200)  {
				$content = json_decode($tmhOAuth->response['response']);
			}
			else {
				// $tmhOAuth->pr(htmlentities($tmhOAuth->response['response']));
			}

			$data = array();
			
			if(!isset($content)) {
				$content = array();
				$content[0] = new stdClass();
				$content[0]->text = 'Kon twitter feeds niet laden';
				$content[0]->created_at = date("Y-m-d H:i:s");
			}
			
			foreach($content as $entry) {
				$data[] = array(
					'text' => $entry->text,
					'created_at' => date('d/m/Y G:i', strtotime($entry->created_at))
				);
			}

			$object = new stdClass();
			$object->data = $data;
			$object->timestamp = time();

			$cache->save($object, $cacheId, array(
				'Twitter_Webservice',
			));

			return $data;
		}
	}
}