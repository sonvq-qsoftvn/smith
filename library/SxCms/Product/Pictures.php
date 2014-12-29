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
class SxCms_Product_Pictures
{
    public function getByProductId($id)
    {
        $basePath  = APPLICATION_ROOT . '/public_html/images/products/product_' . $id;
        if (!is_dir($basePath)) {
            return false;
        }

        try {
            $it = new DirectoryIterator($basePath);
            return $it;
        } catch (Exception $e) {
            return false;
        }
    }
}
