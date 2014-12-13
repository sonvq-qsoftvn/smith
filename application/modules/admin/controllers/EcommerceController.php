<?php

class Admin_EcommerceController extends Zend_Controller_Action
{
	protected $_product;
	protected $_category;

	public function init()
	{
		if ($this->_getParam('reset')) {
			unset($_SESSION['Cms_EcommerceWizard']);
			$this->_redirect('/admin/' .
				$this->getRequest()->getControllerName() . '/' .
				$this->getRequest()->getActionName());
		}

		if (!isset($_SESSION['Cms_EcommerceWizard']['product'])) {
			$product = new SxCms_Product();
			$_SESSION['Cms_EcommerceWizard']['product'] = $product;
		}

		if (!isset($_SESSION['Cms_EcommerceWizard']['category'])) {
			$category = new SxCms_Product_Category();
			$_SESSION['Cms_EcommerceWizard']['category'] = $category;
		}

		$this->_product   = $_SESSION['Cms_EcommerceWizard']['product'];
		$this->_category  = $_SESSION['Cms_EcommerceWizard']['category'];
		$this->view->menu = array(
			'template' => 'system/__modules.phtml',
			'active'   => 'menu-ecommerce',
			'tab'      => 'modules',
		);
		
		$config = Zend_Registry::get('config');
		$lngs = $config->system->language;
		$this->view->lngs = $lngs;
	}

	public function indexAction()
	{
		$this->_helper->redirector->gotoSimple('list-products', 'ecommerce');
	}

	public function initializeProductAction()
	{
		$this->_product->setId($this->_getParam('id'));
		$this->_product->setLanguage($_SESSION['System']['lng']);
		$this->_product->loadState();

		$goto = str_replace('.', '/', $this->_getParam('go'));
		$this->_redirect($goto);
	}

	public function initializeCategoryAction()
	{
		$this->_category->setId($this->_getParam('id'));
		$this->_category->setLanguage($_SESSION['System']['lng']);
		$this->_category->loadState();

		$goto = str_replace('.', '/', $this->_getParam('go'));
		$this->_redirect($goto);
	}

	public function listProductsAction()
	{
		$proxy = new SxCms_Product_DataMapper();
		$products = $proxy->getAllProducts($this->_getParam('category'));

		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($products));
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$paginator->setItemCountPerPage(15);

		$this->view->paginator = $paginator;
	}

	public function addProductAction()
	{
		$product = $this->_product;

		if ($this->getRequest()->isPost()) {
			$product->setTitle($this->_getParam('title'))
				->setDescription($this->_getParam('description'))
				->setSummary($this->_getParam('summary'))
				->setPrice($this->_getParam('price'));

			if ($product->isValid()) {
				$product->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage('Product werd succesvol aangemaakt!');

				$this->_helper->redirector->gotoSimple('list-products', 'ecommerce');
			}
		}

		$this->view->product  = $product;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Product');
	}

	public function editProductAction()
	{
		$product = $this->_product;
		if ($this->getRequest()->isPost()) {
			$product->setTitle($this->_getParam('title'))
				->setDescription($this->_getParam('description'))
				->setSummary($this->_getParam('summary'))
				->setPrice($this->_getParam('price'));

			if ($product->isValid()) {
				$product->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage('Product werd succesvol aangepast!');

				$this->_helper->redirector->gotoSimple('list-products', 'ecommerce');
			}
		}

		$this->view->product  = $product;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Product');
	}

	public function deleteProductAction()
	{
		$this->_product->delete();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage('Product werd succesvol verwijderd!');

		$this->_helper->redirector->gotoSimple('list-products', 'ecommerce');
	}

	public function productPicturesAction()
	{
        $mapper = new SxCms_Product_Pictures();
        $this->view->pictures = $mapper->getByProductId($this->_product->getId());
        $this->view->product = $this->_product;

        if ($this->getRequest()->isPost()) {
            $basePath  = APPLICATION_ROOT . '/public_html/images/products/product_' . $this->_product->getId();
            $thumbPath = $basePath . '/thumbs/';
            if (!is_dir($basePath)) {
                mkdir($basePath, 0777);
                mkdir($thumbPath, 0777);
                mkdir($thumbPath . '/600x400', 0777);
            }

            $adapter = new Zend_File_Transfer_Adapter_Http();
            $adapter->setDestination($basePath);

            if (!$adapter->receive()) {
                $msgr = Sanmax_MessageStack::getInstance('Doeda_Organization');
                $msgr->addMessage('file', $adapter->getMessages(), 'extra');
            }

            $files = $adapter->getFileInfo();
            foreach ($files as $file) {
                if (!$file['tmp_name']) {
                    continue;
                }

                $image = new Imagick($file['tmp_name']);

                $filename = uniqid() . '.jpg';
                $image->setCompression(Imagick::COMPRESSION_JPEG);
                $image->setImageFormat('jpeg');

                $image->cropThumbnailImage(600, 400);
                $image->writeImage($thumbPath . '/600x400/' . $filename);

                $image->cropThumbnailImage(70, 90);
                $image->writeImage($thumbPath . $filename);

                $image->clear();
                $image->destroy();

                rename($file['tmp_name'], $basePath . '/' . $filename);
            }
        }
	}

    public function deletePictureAction()
    {
    	$productId = $this->_getParam('product');
        $basePath  = APPLICATION_ROOT . '/public_html/images/products/product_' . $productId;

        unlink($basePath . '/' . $this->_getParam('file'));
        unlink($basePath . '/thumbs/' . $this->_getParam('file'));
        unlink($basePath . '/thumbs/600x400/' . $this->_getParam('file'));

        $flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $flashMessenger->addMessage('Foto werd succesvol verwijderd');

        $this->_helper->redirector->gotoSimple('initialize.product', 'ecommerce', null, array(
            'id' => $productId, 'go' => 'admin.ecommerce.product-pictures'));
    }

	public function categoryAction()
	{
		$proxy = new SxCms_Product_Category_DataMapper();
		$xmlMapper = new SxCms_Product_Category_TreeMapper();
		$xmlMapper->loadSource(APPLICATION_PATH . '/var/ecommerce.xml');

		$sorted = $xmlMapper->map($proxy->getAllCategories());
		$this->view->tree  = $sorted;
		$this->view->xmlMapper = $xmlMapper;

		$this->_helper->layout->setLayout('nolayout');
	}

	public function listCategoriesAction()
	{
		$proxy = new SxCms_Product_Category_DataMapper();
		$categories = $proxy->getAllCategories();

		$xmlMapper = new SxCms_Product_Category_TreeMapper();
		$xmlMapper->loadSource(APPLICATION_PATH . '/var/ecommerce.xml');

		$this->view->tree = $xmlMapper->map($categories);
		$this->view->xmlMapper = $xmlMapper;
	}

	public function addCategoryAction()
	{
		$category = $this->_category;

		if ($this->getRequest()->isPost()) {
			$category->setTitle($this->_getParam('title'))
				->setDescription($this->_getParam('description'));

			if ($category->isValid()) {
				$category->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage('Categorie werd succesvol aangemaakt!');

				$this->_helper->redirector->gotoSimple('list-categories', 'ecommerce');
			}
		}

		$this->view->category = $category;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Product_Category');
	}

	public function editCategoryAction()
	{
		$category = $this->_category;

		if ($this->getRequest()->isPost()) {
			$category->setTitle($this->_getParam('title'))
				->setDescription($this->_getParam('description'));

			if ($category->isValid()) {
				$category->save();

				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$flashMessenger->addMessage('Categorie werd succesvol aangepast!');

				$this->_helper->redirector->gotoSimple('list-categories', 'ecommerce');
			}
		}

		$this->view->category = $this->_category;
		$this->view->messages = Sanmax_MessageStack::getInstance('SxCms_Product_Category');
	}

	public function deleteCategoryAction()
	{
		$this->_category->delete();

		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$flashMessenger->addMessage('Categorie werd succesvol verwijderd!');

		$this->_helper->redirector->gotoSimple('list-categories', 'ecommerce');
	}

	public function parentCategoryAction()
	{
		$proxy = new SxCms_Product_Category_DataMapper();
		$xmlMapper = new SxCms_Product_Category_TreeMapper();
		$xmlMapper->loadSource(APPLICATION_PATH . '/var/ecommerce.xml');

		$sorted = $xmlMapper->map($proxy->getAllCategories());
		$this->view->tree  = $sorted;
		$this->view->xmlMapper = $xmlMapper;

		$this->_helper->layout->setLayout('nolayout');
	}

	public function setCategoryAction()
	{
		$category = new SxCms_Product_Category();
		$category->setId($this->_getParam('category'));
		$category->loadState();

		$this->_product->setCategory($category);
		$this->_redirect('/admin/ecommerce/close/type/product');
	}

	public function setParentAction()
	{
		$this->_category->setParentId($this->_getParam('category'));
		$this->_redirect('/admin/ecommerce/close/type/category');
	}

	public function closeAction()
	{
		if ($this->_getParam('type') == 'product') {
			$this->view->product = $this->_product;
		} else {
			$this->view->category = $this->_category;
		}

		$this->_helper->layout->setLayout('nolayout');
	}
}
