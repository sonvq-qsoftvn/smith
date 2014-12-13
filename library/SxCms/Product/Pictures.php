<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: Pictures.php 8235 2010-05-31 14:23:48Z andries $
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
 * @package    SxCms_Product_Pictures
 * @copyright  Copyright (c) 2009 Sanmax Consultancy BVBA. (http://www.sanmax.be)
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
