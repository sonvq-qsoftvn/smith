<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: File.php 8179 2010-05-28 07:58:13Z andries $
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
 * @package    SxCms_File
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_File extends SplFileObject
{
	const META_START = '#=#=#=#SxCms:MetaStart#=#=#=#';
	const META_END   = '#=#=#=#SxCms:MetaEnd#=#=#=#';

	protected $_filename;
	protected $_newFilename;
	protected $_title;
	protected $_source;
	protected $_summary;
	protected $_link;
	protected $_translation;
    protected $_permissions = array();
	protected $_metaLoaded = false;

	public function __construct($filename)
	{
		$this->_filename = realpath($filename);
		parent::__construct($filename);
	}

	public function setFilename($filename)
	{
		$nfilename = realpath($this->getPath()) . DIRECTORY_SEPARATOR . $filename;
		if ($nfilename !== $this->_filename) {
			$this->_newFilename = $nfilename;
		}

		return $this;
	}

	public function getPathnameFromBase()
	{
		$base = realpath(APPLICATION_PATH . '/../public_html/files/');
		$path = realpath(dirname($this->getPathname()));

		$path = str_replace($base, '', $path);
		$path = str_replace('\\', '/', $path);

		return $path;
	}

    public function isApb()
    {
        $path = ltrim($this->getPathnameFromBase(), '/');
        $parts = explode('/', $path);

        if (isset($parts[0]) && $parts[0] == 'docmanager') {
            return true;
        }

        return false;
    }

	public function setTitle($title)
	{
		$this->_title = $title;
		return $this;
	}

	public function getTitle()
	{
		$this->_getMetaTags();
		return $this->_title;
	}

	public function setSource($source)
	{
		$this->_source = $source;
		return $this;
	}

	public function getSource()
	{
		$this->_getMetaTags();
		return $this->_source;
	}

	public function setSummary($summary)
	{
		$this->_summary = $summary;
		return $this;
	}

	public function getSummary()
	{
		$this->_getMetaTags();
		return $this->_summary;
	}


	public function setLink($link)
	{
		$this->_link = $link;
		return $this;
	}

	public function getLink()
	{
		$this->_getMetaTags();
		return $this->_link;
	}

	public function getCleanFile()
	{
		$info = $this->openFile('r+');

		$b = '';
		while (!$info->eof()) {
			$b .= $info->fgets();
		}

		if (preg_match('/#=#=#=#SxCms:MetaStart#=#=#=#.*#=#=#=#SxCms:MetaEnd#=#=#=#/s', $b)) {
			$b = preg_replace('/#=#=#=#SxCms:MetaStart#=#=#=#.*#=#=#=#SxCms:MetaEnd#=#=#=#/s', '', $b);
			return ltrim($b);
		}

		return $b;
	}

	public function save()
	{
		$info = $this->openFile('r+');
		$end  = 0;

		$info->rewind();
		foreach ($info as $num => $line) {
			if ($num === 0 && strpos($line, self::META_START) === false) {
				break;
			} else if (strpos($line, self::META_END) !== false) {
				$end = $num + 1;
				break;
			}
		}

		$nfile = '';
		$info->seek($end);
		while (!$info->eof()) {
		    $nfile .= $info->current();
		    $info->next();
		}

		$info->rewind();
		$info->ftruncate(0);

		$header = $this->_buildMetaHeader();
		$nfile  = $header . $nfile;

		$info->fwrite($nfile);
		$info->fflush();

		if ($this->_newFilename) {
			rename($this->_filename, $this->_newFilename);
		}

		return true;
	}

	public function delete()
	{
		return unlink($this->_filename);
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

    public function addPermission(SxCms_Group $group)
    {
        $this->_permissions[$group->getId()] = $group;
        return $this;
    }

    public function getPermissions()
    {
        return $this->_permissions;
    }

    public function clearPermissions()
    {
        $this->_permissions = array();
        return $this;
    }

    public function isAllowed($identity)
    {
        if (!$this->getPermissions()) {
            return true;
        }

        if (!$identity) {
            return !$this->getPermissions();
        }

        foreach ($identity->getGroups() as $group) {
        	if (isset($this->_permissions[$group->getId()])) {
        		return true;
        	}
        }

        return false;
    }

	protected function _getMetaTags()
	{
		if ($this->_metaLoaded) {
			return true;
		}

		$info = $this->openFile('r');
		$info->rewind();

		$end  = false;
		$meta = '';
		if (strpos($info->current(), self::META_START) !== false) {
			if (strpos($info->current(), self::META_END) !== false) {
				$end = true;
			}

			while ($info->valid() && !$end) {
				$line = $info->fgets();
				if (strpos($line, self::META_END) !== false) {
					$end = true;
				} else {
					$meta .= $line;
				}
			}
		}

		if (!$meta) {
			return true;
		}

		$xml = simplexml_load_string($meta);
		foreach ($xml as $key => $node) {
			if ($key !== 'acl') {
			    $kname = "_{$key}";
                $this->{$kname} = (string) $node;
			} else {
				foreach ($node as $perm) {
                    $group = new SxCms_Group();
                    $group->setId($perm);

                    $this->addPermission($group);
				}
			}
		}

		$this->_metaLoaded = true;
		return true;
	}

	protected function _buildMetaHeader()
	{
		$dom = new DOMDocument();
		$dom->formatOutput = true;
		$meta = $dom->createElement('meta');

		$title = $dom->createElement('title');
		$title->nodeValue = $this->getTitle();
		$meta->appendChild($title);

		$source = $dom->createElement('source');
		$source->nodeValue = $this->getSource();
		$meta->appendChild($source);

		$summary = $dom->createElement('summary');
		$summary->nodeValue = $this->getSummary();
		$meta->appendChild($summary);

		$link = $dom->createElement('link');
		$link->nodeValue = $this->getLink();
		$meta->appendChild($link);

        $acl = $dom->createElement('acl');
        foreach ($this->getPermissions() as $group) {
            $perm = $dom->createElement('group');
	        $perm->nodeValue = $group->getId();
	        $acl->appendChild($perm);
        }

        $meta->appendChild($acl);

		$dom->appendChild($meta);

    	return self::META_START . "\n" .
    		$dom->saveXML() . "\n" . self::META_END  . "\n";
	}

	protected function _fileEextension()
	{
		return strtolower(end(explode('.', $this->_filename)));
	}
}
