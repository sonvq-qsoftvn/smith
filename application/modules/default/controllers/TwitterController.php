<?php

class TwitterController extends Zend_Controller_Action
{
    public function init()
    {
        $config = Zend_Registry::get('config');
        $_SESSION['System']['lng'] = $this->_getParam('lng', $config->system->defaults->language);
        $this->view->lng = $_SESSION['System']['lng'];
		
		$this->view->glob_tmx = new Zend_Translate('tmx', APPLICATION_ROOT . '/application/var/locale/global.tmx', $_SESSION['System']['lng']); 
    }


	public function getAction() {
		$this->_helper->layout()->disableLayout(); 
		$this->_helper->viewRenderer->setNoRender(true);

        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

		/* Set locale to Dutch */
		setlocale(LC_ALL, 'nl_NL');

		$cacheId = 'Mobile_Twitter';
		$cache = Zend_Registry::get('cache');
		if (true == ($result = $cache->load($cacheId))) {
			if( ($result->timestamp+240) < time() ) { // vernieuwen om de 4 minuten oftewel 240 seconden
				$cache->clean(
					Zend_Cache::CLEANING_MODE_MATCHING_TAG,
					array(
						'Twitter_Webservice'
					)
				);
			}

			$output = $result->output;

			if($this->_getParam('version', '1') == '2') {
				foreach($output as $key => $tweet) {
					$output[$key]['text'] = $this->processLinks( $tweet['text'] );
				}
			}
		}
		else {
			$config = Zend_Registry::get('config');

			require APPLICATION_ROOT.'/library/Twitter/tmhOAuth.php';
			require APPLICATION_ROOT.'/library/Twitter/tmhUtilities.php';
			$tmhOAuth = new tmhOAuth(array(
				'consumer_key' => $config->twitter->customer_key,
				'consumer_secret' => $config->twitter->customer_secret,
				'user_token' => $config->twitter->user_token,
				'user_secret' => $config->twitter->user_secret,
				'debug' => false
			));

			$tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline'), array('screen_name' => 'NAAM VAN USER INVULLEN'));

			if($tmhOAuth->response['code'] == 200)  {
				$content = json_decode($tmhOAuth->response['response']);
			}
			else {
				$tmhOAuth->pr(htmlentities($tmhOAuth->response['response']));
			}
			
			$output = array();
			foreach($content as $entry) {
				$output[] = array(
					'text' => $entry->text,
					'created_at' => date('d/m/Y G:i', strtotime($entry->created_at))
				);
			}
	
			$object = new stdClass();
			$object->output = $output;
			$object->timestamp = time();

			$cache->save($object, $cacheId, array(
				'Twitter_Webservice',
			));

			if($this->_getParam('version', '1') == '2') {
				foreach($output as $key => $tweet) {
					$output[$key]['text'] = $this->processLinks( $tweet['text'] );
				}
			}
		}

		echo json_encode($output);
	}
	// Method to add hyperlink html tags to any urls, twitter ids or hashtags in the tweet
	public function processLinks($text) {
		// $text = utf8_decode( $text );
		$text = preg_replace('@(https?://([-\w\.]+)+(d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $text );
		$text = preg_replace("#(^|[\n ])@([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"https://www.twitter.com/\\2\" target=\"blank\" >@\\2</a>'", $text);
		$text = preg_replace("#(^|[\n ])\#([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"https://twitter.com/search?q=\\2&src=hash\" >#\\2</a>'", $text);
	
		return $text;
	}
}