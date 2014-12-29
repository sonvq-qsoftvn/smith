<?php

/**
 * Development by thieusmith
 * @version $Id: Acl.php 8179 2010-05-28 07:58:13Z andries $
 *
 * LICENSE
 *
 * Warranty on source code, and templates, expires upon modifications, made by
 * either customer, or third party providers. thieusmith can not be
 * held responsible for such modifications.
 *
 * Client assumes all responsibility for additional time and cost requirements
 * resulting from such modifications.
 */


/**
 * @category   SxCms
 * @package    SxCms_Acl
 * @copyright  Copyright (c) 2015 thieusmith. (thieusmith@gmail.com)
 */

class SxCms_Page_DataMapper
{
	public function map($page, $map = null)
	{
		if (!$page) {
			return new SxCms_Page();
		}
	
		$pageObject = $map ? $map : new SxCms_Page();
		$pageObject->setId($page['page_id'])
			 ->setLayout($page['layout'])
			 ->setType($page['type'])
			 ->setLocked($page['locked_by'], $page['date_locked'])
			 ->setDateCreated($page['date_created'])
			 ->setDatePublished($page['date_published'])
			 ->setDateExpired($page['date_expired'])
			 ->setLanguage($page['language'])
			 ->setTitle($page['title'])
			 ->setTitleFallback($page['title_fb'])
			 ->setSummary($page['summary'])
			 ->setSummaryFallback($page['summary_fb'])
			 ->setContent($page['content'])
			 ->setContentFallback($page['content_fb'])
			 ->setSource($page['source'])
			 ->setSourceFallback($page['source_fb'])
			 ->setLink($page['link'])
			 ->setLinkFallback($page['link_fb'])
			 ->setThumb($page['thumb'])
			 ->setNavigation($page['navigation'])
			 ->setSitemap($page['sitemap'])
			 ->setAllowComments($page['comments'])
			 ->setInvisible($page['invisible'])
			 ->setSeoTitle($page['seotitle'])
			 ->setSeoTags($page['seotags'])
			 ->setSeoDescription($page['seodescription']);

        if ($page['final']) {
            $pageObject->markTranslationInvalid();
        }
        
		$parentPage = new SxCms_Page();
		$parentPage->setId($page['parent_id']);
		$parentPage->setLanguage($page['language']);
		$pageObject->setParent($parentPage);

		return $pageObject;
	}
}
