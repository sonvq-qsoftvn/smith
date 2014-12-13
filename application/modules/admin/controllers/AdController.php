<?php

class Admin_AdController extends Zend_Controller_Action
{
	public function init()
	{
		$this->view->menu = array(
			'template' => 'system/__modules.phtml',
			'active'   => 'menu-ad',
			'tab' => 'modules'
		);
		
		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;
	}

	public function indexAction()
	{
		SxCms_Acl::requireAcl('ad', 'ad.edit');

		$filename = APPLICATION_PATH . '/var/ads.xml';

		$dom = new DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->loadXml(file_get_contents($filename));
		$dom->formatOutput = true;

		$xpath = new DOMXpath($dom);
		$xml = simplexml_import_dom($dom);

		if ($this->getRequest()->isPost()) {
			$ads = $this->_getParam('ad');
			foreach ($ads as $key => $value) {
				$nodeList = $xpath->query("//zone[id='{$key}']/content");
				if ($nodeList->length) {
					$cdata   = $dom->createCDATASection(stripslashes($value));
					$content = $dom->createElement('content');
					$content->appendChild($cdata);

					$nodeList->item(0)->parentNode->replaceChild($content, $nodeList->item(0));
				}
			}

			$dom->save($filename);
			$flashMessenger = $this->_helper->getHelper('FlashMessenger');
			$flashMessenger->addMessage('Advertentie werd succesvol aangepast');
		}

		$this->view->ads = $xml;
	}
}
