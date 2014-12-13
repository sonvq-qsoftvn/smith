<?php

class FileController extends Zend_Controller_Action
{
	public function init() {
		$this->view->lng = $this->_getParam('lng','nl');
	}
	
	public function downloadAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();

		$filename = APPLICATION_ROOT . '/public_html/files/' . $this->_getParam('filename');
		$filename = realpath($filename);

		try {
			$file = new SxCms_File($filename);
			$data = $file->getCleanFile();

			$identity = Zend_Auth::getInstance()->getIdentity();
			if (!$file->isAllowed($identity)) {
	            $this->_helper->redirector
	                ->setExit(true)
	                ->gotoSimple('unauthorized', 'index');

	            return;
			}

            if ($file->isApb()) {
                $as = new SimpleSAML_Auth_Simple('klavsts');
                $attributes = $as->getAttributes();
                if (!$attributes) {
                    $this->_forward('unauthorized', 'index', null, array('url' => $this->view->url()));
                    return;
                }

                $attributes = $attributes['urn:klav:docmanager'];
                $filecheck = new SxCms_Filesystem($file->getPath());
                $filecheck->setApb($attributes);
                
                if (!$filecheck->isAllowed()) {
                    $this->_helper->redirector
                        ->setExit(true)
                        ->gotoSimple('unauthorized', 'index');

                    return;
                }
            }

			// workaround for when PECL class finfo is not installed
			$mimeType = 'application/octet-stream';
			if (@class_exists('finfo')) {
                $finfo = new finfo(FILEINFO_MIME);
	            $mimeType = $finfo->file($filename);
			}

            // mimetype "unknown", let's figure it out by filename extension
            if ($mimeType == 'application/octet-stream') {
            	$ext = strtolower(end(explode('.', $filename)));

                $types = simplexml_load_file(APPLICATION_PATH . '/var/mime-types.xml');
                $result = $types->xpath('//mime-types/mime-type/ext[. ="' . $ext . '"]/..');
                $result = $result[0]->attributes();
                $result = (string) $result['name'];

                $mimeType = $result;
            }

			$size = mb_strlen($data);
			$this->getResponse()
				->setHeader('Content-Type', $mimeType)
				->setHeader('Content-Length', $size);

			echo $data;
		} catch (Exception $e) {
            throw new Zend_Controller_Action_Exception('File not found', 404);
		}
	}
}
