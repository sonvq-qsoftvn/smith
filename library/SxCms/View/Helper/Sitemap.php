<?php

class SxCms_View_Helper_Sitemap extends Zend_View_Helper_Abstract
{
    public function Sitemap() {
		return $this;
    }

	public function get() {
    	$request = Zend_Controller_Front::getInstance()->getRequest();
		
		$nav = new SxCms_Nav($request->getParam('lng', 'nl'));
        $nav->setBounds(1, 3);

        $this->view->lng = $request->getParam('lng');
		$this->view->menus = $nav->sitemapItems();	

		$nav->setBounds(1,2);
		$this->view->topmenus = $nav->sitemapItems();
	}

	public function orderdedList() {
		$this->createList( $this->view->topmenus, $this->view->menus );
	}

	public function createList($topmenus, $menus) {
		$n = count($topmenus);
		$i = 0;  $lastpage='0';
		$count = 2;
	
		do {
			$page = current($menus);

			if($page !== false) {
				if(substr($page->getLink(),0,7) == 'http://') {
					$url = $page->getLink(); $target = ' target="_blank"';
				}
				else {
					$url = $this->view->url(array('url' => $page->getLink(), 'lng' => $this->view->lng), 'content', false, false);
					$target = '';
				}

				if($page) {
					if ($page->getId() == 0) {
						echo '<li class="parent"><a href="'.$url.'"'.$target.'>'.$page->getTitle().'</a></li>';
					}
	
					if(!$page->hasChildren() && $page->getLevel() == 2) {
						echo '<li class="parent"><a href="'.$url.'"'.$target.'>'.$page->getTitle().'</a></li>';
					}

					if($page->hasChildren() && $page->getLevel() == 2) {
						$amountChildren = count($page->getChildren());
						$i = 0;
	
						echo '<li class="parent-wrap"><a href="'.$url.'"'.$target.'>'.$page->getTitle().'</a><ul class="parent">';
					}

					if($page->getLevel() == 3) {
						echo '<li class="subpage"><a href="'.$url.'"'.$target.'>'.$page->getTitle().'</a></li>';
	
						 if($amountChildren == $i) {
							echo '</ul></li></ul>';
						}
				 	}

					if($n % 7 == 0) {
						echo '<div style="clear:both"></div>';
					}

					if($page->getLevel() == 2) {
						$count++;
					}

					$i++;
				}
			}
		} while(next($menus));
	}

	public function createXml() {
		/*
		<?xml version="1.0" encoding="UTF-8"?>
		<urlset xmlns="http://www.google.com/schemas/sitemap/0.90">
		  <url>
		    <loc>http://www.sitemappro.com/</loc>
		    <lastmod>2011-01-27T23:55:42+01:00</lastmod>
		    <changefreq>daily</changefreq>
		    <priority>0.5</priority>
		  </url>
		</urlset>
		*/

		$n = count($this->view->topmenus);
		$i = 0;  $lastpage='0';
		$count = 2;
		
		$date = date('Y-m-d');

		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo '<urlset xmlns="http://www.google.com/schemas/sitemap/0.90">';

		do {
			$page = current($this->view->menus);

			if($page !== false && substr($page->getLink(),0,7) != 'http://') {
				$url = $this->view->url(array('url' => $page->getLink(), 'lng' => $this->view->lng), 'content', false, false);

				if($page) {
					if ($page->getId() == 0) {
						echo '<url><loc>'.$url.'</loc><lastmod>'.$date.'</lastmod><changefreq>daily</changefreq><priority>1.0</priority></url>';
					}

					if($page->getLevel() == 2) {
						echo '<url><loc>'.$url.'</loc><lastmod>'.$date.'</lastmod><changefreq>daily</changefreq><priority>0.8</priority></url>';
					}

					if($page->getLevel() == 3) {
						echo '<url><loc>'.$url.'</loc><lastmod>'.$date.'</lastmod><changefreq>daily</changefreq><priority>0.6</priority></url>';
				 	}
				}
			}
		} while(next($this->view->menus));
		
		echo '</urlset>';
	}




	public function getNews($type = 'news') {
		$proxy = new SxModule_News_Proxy();
		$this->view->news = $proxy->getAllActive($type, $this->view->lng);
	}

	public function newsRss() {
		$language = ($this->view->lng == 'fr') ? 'fr_FR' : 'nl';
		
		if($this->view->lng == 'fr') {
			setlocale(LC_ALL, 'fr_FR');
		}
		
		header("Content-type: text/xml; charset=utf-8");

		echo '<?xml version="1.0" encoding="UTF-8" ?>'."\n";
		echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/">'."\n";
		echo '<channel>'."\n";
		echo "\t".'<atom:link href="http://www.lafiness.be'.$this->view->url().'" rel="self" type="application/rss+xml" />'."\n";
		
		if($this->view->lng == 'fr') {
			echo "\t".'<title>Actualités | Lafiness - Richesse du bain et source d\'inspiration</title>'."\n";
		}
		else {
			echo "\t".'<title>Nieuws | Lafiness - Bron van baden, bron van inspiratie</title>'."\n";
		}
		
		echo "\t".'<link><![CDATA[http://www.lafiness.be/]]></link>'."\n";
		
		if($this->view->lng == 'fr') {
			echo "\t".'<description>Lafiness incarne la richesse du bain : une gamme complète dédiée à l’aménagement de votre salle de bains. Elle comble en effet toutes les attentes, marie les goûts et les styles et propose une solution pour chaque budget.</description>'."\n";
		}
		else {
			echo "\t".'<description>Lafiness is een compleet gamma om je badkamer in te richten. Omdat het alles omvat wat je maar kan wensen, omdat het tegenover elke smaak een stijl kan plaatsen, en omdat het voor ieders budget een oplossing biedt.</description>'."\n";
			
		}
		echo "\t".'<language>'.$language.'</language>'."\n";
		echo "\t".'<copyright>Calodar N.V. (C) '.date('Y').' lafiness.be</copyright>'."\n";

		foreach($this->view->news as $newsItem) {
			$url = $this->view->url(array(
	            'url' => $newsItem->getUrl(),
	            'lng' => $newsItem->getLng(),
	            'id'  => $newsItem->getNid()
			), 'news-article', true);

			echo "\t".'<item>'."\n";
			echo "\t\t".'<title><![CDATA['.$newsItem->getTitle().']]></title>'."\n";
			echo "\t\t".'<link><![CDATA[http://www.lafiness.be'.$url.']]></link>'."\n";
			echo "\t\t".'<guid><![CDATA[http://www.lafiness.be'.$url.']]></guid>'."\n";
			setlocale(LC_ALL,"en_US");
			echo "\t\t".'<pubDate>'.date(DATE_RFC2822, strtotime($newsItem->getDatePublished())).'</pubDate>'."\n";
			setlocale(LC_ALL,"Nl-Be");
			echo "\t\t".'<description><![CDATA['.$newsItem->getSummary().']]></description>'."\n";
			/* echo '<content:encoded><![CDATA['.$newsItem->getContent().']]></content:encoded>';*/
			//echo "\t\t".'<media:content type="image/jpeg" url="http://www.lafiness.be/images/news/350X350/'.$newsItem->getImage().'"></media>'."\n";
			
			echo "\t\t".'<media:content type="image/jpeg" url="http://www.lafiness.be/images/news/350X350/'.$newsItem->getImage().'">';
			echo "\t\t\t".'<media:thumbnail url="http://www.lafiness.be/images/news/350X350/'.$newsItem->getImage().'" />';
			echo "\t\t".'</media:content>';
			
			
			echo "\t".'</item>'."\n";
		}
		
		
		echo '</channel>'."\n";
		echo '</rss>'."\n";
	}
}