<?php

class Admin_Page_PictureController extends Zend_Controller_Action
{
	protected $_page;
	protected $_type;

	public function init()
	{

		if ($this->_getParam('reset')) {
			unset($_SESSION['Cms_PageWizard']);
			$this->_redirect('/admin/' .
				$this->getRequest()->getControllerName() . '/' .
				$this->getRequest()->getActionName());
		}

		if (!isset($_SESSION['Cms_PageWizard']['page'])) {
			$proxy = new SxCms_Page_Proxy();
			$page = $proxy->getPageById($this->_getParam('id'));

			$_SESSION['Cms_PageWizard']['page'] = $page;
		}
		$this->_page   = $_SESSION['Cms_PageWizard']['page'];
		$this->view->page = $this->_page;
		$this->view->menu = array(
			'template' => 'page/__menu.phtml',
			'active'   => 'menu-page',
			'tab'      => 'cms',
		);

		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;
	}



    //picture controller
     /*
	 * IMAGE CONTROLLER
	 */

    //index
	public function browseAction()
	{
        $page_id	= $this->_page->getId();
        $lng = $_SESSION['System']['lng'];

		if($this->_getParam('json',0) == 1) {
			$proxy =  new SxCms_Page_Picture_Proxy();
			$pictures = $proxy->getAllByPage($page_id,0, $lng);

			$this->_helper->layout()->disableLayout();
			$this->view->result	= Zend_Json::encode(array('images'=>$pictures));
			$this->render('result');
		} else {
			$this->view->page_id	= $page_id;
		}

	}

    //upload pictures
	public function uploadAction()
	{
		$page_id	= $this->_getParam('page_id');

		if ($this->getRequest()->isPost()) {

			$uploadPath		= APPLICATION_ROOT . '/public_html/images/page';
            //var_dump($uploadPath);die();
			$uploadAdapter	= new Zend_File_Transfer_Adapter_Http();
	        $uploadAdapter->setDestination($uploadPath);
	        $uploadAdapter->setOptions(array(
	        		'ignoreNoFile' => true
	        	)
			);

	      	$extValidator = new Zend_Validate_File_Extension('jpg,png,gif');
	    	$extValidator->setMessage(
	     		'Ongeldige foto extensie',
	         	Zend_Validate_File_Extension::FALSE_EXTENSION
	     	);


	        $uploadAdapter->addValidator($extValidator);
	        $uploadAdapter->receive();
	        $messages = $uploadAdapter->getMessages();

	        if (count($messages)) {
				$this->_helper->layout()->disableLayout();
				$this->view->result = Zend_Json::encode(array('success' => false));
				return;
	        }


	        $basePath = APPLICATION_ROOT . '/public_html/images/page/page_' . $page_id;
			$old_umask = umask(0);
			if (!is_dir($basePath)) { mkdir($basePath, 0777, true); }
			if (!is_dir($basePath . '/100x100')) { mkdir($basePath . '/100x100', 0777, true); }
			if (!is_dir($basePath . '/726x1035')) { mkdir($basePath . '/726x1035', 0777, true); }
			umask($old_umask);

			$files = $uploadAdapter->getFilename(null, false);
			if(!is_array($files)) { $files = array($files); }
            $text = $this->_getParam('text');

			foreach ($files as $key => $filename) {
                $picnumber =  substr($key,8,1);
				$oFname = $uploadPath . '/' . $filename;

				if (!$oFname) { continue; }

				$ext    = '.' . strtolower(substr(strrchr($oFname, '.'), 1));
				$nFname = $basePath . '/' . md5(time() . $oFname) . $ext;

				rename($oFname,  $nFname);

		        $im = new Imagick($nFname);
		        $im->cropThumbnailImage(100, 100);
		        $im->writeImage($basePath . '/100x100/' . basename($nFname));

		        $im = new Imagick($nFname);
		        $im->cropThumbnailImage(726, 1035);
		        $im->writeImage($basePath . '/726x1035/' . basename($nFname));

                //count al items in DB en doe +1 voor de laatste positite aan de foto toe te kennen
                $x = new SxCms_Page_Picture_Proxy();
                $x = $x->countByPage($page_id) + 1;

                //save pic
				$picture = new SxCms_Page_Picture();
				$picture->setPageId($page_id);
				$picture->setFile(basename($nFname));
                $picture->setText($text[$picnumber]);
                $picture->setSeason(0);
				$picture->setPlace($x);
				$picture->save();
			}

			$this->_helper->layout()->disableLayout();
			$this->view->result = Zend_Json::encode(array('success' => true));
			$this->render('result');
		}
	}

	public function pictureAction()
	{
		$picture		= new SxCms_Page_Picture();
		$picture->setPictureId($this->_getParam('picture_id'));
		$picture->save();

		$this->_helper->layout()->disableLayout();
		$this->view->result = Zend_Json::encode(array('success' => true));
		$this->render('result');
	}

    //delete picture
	public function removeAction()
	{
		$picture_id = $this->_getParam('id');

		$proxy = new SxCms_Page_Picture_Proxy();
		$picture = $proxy->getSingle($picture_id);
		$picture->delete();

		$original = APPLICATION_ROOT . '/public_html/images/page/page_' . $picture->getPageId() . '/' . $picture->getFile();
		$thumb = APPLICATION_ROOT . '/public_html/images/page/page' . $picture->getPageId() . '/100x100/' . $picture->getFile();
		$smallimage = APPLICATION_ROOT . '/public_html/images/page/page' . $picture->getPageId() . '/100x65/' . $picture->getFile();
        $image = APPLICATION_ROOT . '/public_html/images/page/page' . $picture->getPageId() . '/500x268/' . $picture->getFile();

		if (file_exists($original)) { unlink($original); }
		if (file_exists($thumb)) { unlink($thumb); }
        if (file_exists($smallimage)) { unlink($smallimage); }
		if (file_exists($image)) { unlink($image); }

		$this->_helper->layout()->disableLayout();
		$this->view->result = Zend_Json::encode(array('success' => true));
		$this->render('result');
	}

    //order picutres
	public function orderAction() {
		$ids = stripslashes($this->_getParam('ids'));
		$ids = Zend_Json::decode($ids);

		foreach($ids as $key => $id) {
			$picture		= new SxCms_Page_Picture();
			$picture->setPictureId((int) $id)
				->setPlace($key)
				->order();
		}

		$this->_helper->layout()->disableLayout();
		$this->view->result = Zend_Json::encode(array('success' => true));
		$this->render('result');
	}

    //update text van pictures
    public function textupdateAction()
	{
		if ($this->getRequest()->isPost()) {
            $lng = $_SESSION['System']['lng'];

            $text = $this->_getParam('text');
            $picture_id = $this->_getParam('picture_id');

		    $picture = new SxCms_Page_Picture();
			$picture->setPictureId($picture_id);
            $picture->setText($text);
            $picture->setSeason(0);
			$picture->saveUpdate($lng);


			$this->_helper->layout()->disableLayout();
			$this->view->result = Zend_Json::encode(array('success' => true));
			$this->render('result');
		}
	}


}
