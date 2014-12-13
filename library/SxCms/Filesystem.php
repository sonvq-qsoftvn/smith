<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: Filesystem.php 8179 2010-05-28 07:58:13Z andries $
 *
 * LICENSE
 *
 * Warranty on source code, and templates, expires upon modifications, made by
 * either customer, or third party providers. Sanmax Consultancy can not be
 * held responsible for such modifications.
 *
 * Client assumes all responsibility for additional time and cost requirements
 * resulting from such modifications.
 */


/**
 * @category   SxCms
 * @package    SxCms_Filesystem
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Filesystem extends DirectoryIterator
{
	protected $_mapping = array(
		// images
		'bmp'   => 'image.png',
		'jpg'   => 'image.png',
		'png'   => 'image.png',
		'gif'   => 'image.png',
		// documents
		'csv'   => 'excel.png',
		'doc'   => 'word.png',
		'docx'  => 'word.png',
		'pdf'   => 'pdf.png',
		'txt'   => 'word.png',
		'xls'   => 'excel.png',
		'xlst'  => 'excel.png',
		'xlsx'  => 'excel.png',
		'xltx'  => 'excel.png',
	);

    protected $_apb = array();

    public function setApb($apb)
    {
        $abps = array();
        foreach ($apb as $allowed) {
            $pos    = strpos($allowed, '_');
            $apb    = substr($allowed, 0, $pos);
            $folder = substr($allowed, $pos + 1);

            if (!isset($apbs[$apb])) {
                $apbs[$apb] = array();
            }

            $apbs[$apb][] = $folder;
        }

        $this->_apb = $apbs;
    }

    public function getApb()
    {
        return $this->_apb;
    }

    public function isAllowed()
    {
        $sapb  = '';
        $sfolder = '';

        $parts = explode('/', $this->current()->getPathnameFromBase());
        if (count($parts) == 1) {
            $sapb = $parts[0];
        } else if (count($parts) > 1) {
            $sapb = $parts[0];
            $sfolder = $parts[1];
        }

        if (($sapb && !isset($this->_apb[$sapb])) or ($sfolder && !in_array($sfolder, $this->_apb[$sapb]))) {
            return false;
        }

        return true;
    }

    public function valid()
    {
        if (!parent::valid()) {
            return false;
        }
        
        if (!$this->_apb) {
            return true;
        }
        
        return $this->isAllowed();
    }

	public function getFileType()
	{
		if ($this->isDir()) {
			return 'folder.png';
		}

		$name = $this->getBasename();
		$type = strtolower(end(explode('.', $name)));

		if (isset($this->_mapping[$type])) {
			return $this->_mapping[$type];
		}

		return 'default.png';
	}

	public function getSizeString()
	{
	    $units = array('B', 'KB', 'MB', 'GB', 'TB');

	    $bytes = parent::getSize();
	    $bytes = max($bytes, 0);
	    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
	    $pow = min($pow, count($units) - 1);

	    $bytes /= pow(1024, $pow);

	    return round($bytes, 2) . ' ' . $units[$pow];
	}

	public function isHidden()
	{
		if ($this->getBasename() == 'mcith') {
			return true;
		}

		return false;
	}

	public function getPathnameFromBase()
	{
		$base = realpath(APPLICATION_PATH . '/../public_html/files/docmanager/');
		$path = realpath($this->getPathname());

		$path = str_replace($base, '', $path);
		$path = str_replace('\\', '/', $path);

        $path = ltrim($path, '/');
		return $path;
	}
}
