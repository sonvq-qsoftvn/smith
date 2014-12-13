<?php

class SxCms_View_Helper_Twitter extends Zend_View_Helper_Abstract
{
    public function Twitter() {
		return $this;
    }

	public function getTweets($params = array()) {
		$config = Zend_Registry::get('config');
		
		$twitter = new SxModule_Twitter(array(
			'consumer_key' => $config->twitter->customer_key,
			'consumer_secret' => $config->twitter->customer_secret,
			'user_token' => $config->twitter->user_token,
			'user_secret' => $config->twitter->user_secret
		));

		if(is_string($params)) {
			$tmp = $params;
			unset($params);
			$params['screen_name'] = $tmp;
			unset($tmp);
		}

		$twitter = $twitter->getTweets($params);

		return $twitter;
	}
	
	//URLs in Tweet
	public function processLinks($text) {
		$text = utf8_decode( $text );
		$text = preg_replace('@(https?://([-\w\.]+)+(d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>', $text );
		$text = preg_replace("#(^|[\n ])@([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://www.twitter.com/\\2\" >@\\2</a>'", $text);
		$text = preg_replace("#(^|[\n ])\#([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"https://twitter.com/search?q=\\2&src=hash\" >#\\2</a>'", $text);
	
		return $text;
	}
	
	//Tweet time: '.. ago'
	public function timeDifference($date_created, $tsl = array('s' => 'sec', 'm' => 'min', 'h' => 'u', 'ds' => 'dagen', 'd' => 'dag', 'and' => 'en')) {
		$d = substr($date_created, 0, 2);
        $m = substr($date_created, 3, 2);
        $date_created = $m.'/'.$d.substr($date_created, 5);
        $s = strtotime($date_created);
	    $s = time() - 60*60 - 60*60 - $s;
	    $td = $s;

	    if($s >= 1){
	        $td = "$s " . $tsl['s'];
	    }

	    if($s > 59) {
	        $m = (int) ($s / 60);
	        $s = $s - ($m * 60); // SECONDS 
	        $td = "$m ".$tsl['m'];
	    }

	    if(isset($m)) {
	        if ($m > 59) {
	            $hr = (int) ($m / 60);
	            $m = $m - ($hr * 60); // MINUTES
	            $td = "$hr ".$tsl['h'];

	            if ($hr > 1) {
	                if ($m > 0) {
	                    $td .= ", $m ".$tsl['m'];
					}
				}
	        }

	        if(isset($hr)) {
	            if ($hr > 23) {
	                $d = (int) ($hr / 24);
	                $hr = $hr - ($d * 24); // HOURS

	                if($d > 1){
	                	$td = "$d ".$tsl['ds'];

	                    if ($d < 3) {
	                        if ($hr > 0) {
	                        	$td .= " ".$tsl['and'] . " " . $hr. " " .$tsl['h'];
	                        }    
	                    }
					}
					else {
						$td = "$d ".$tsl['d'];
					}
	            }
	        }
	    }

	    return $td;
	}
}
