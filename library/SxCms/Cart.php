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

class SxCms_Cart
{
    /**
     * Total price for cart
     * @var float
     */
	protected $total = 0;

    /**
     * Products in cart
     * @var array
     */
    protected $products = array();

    /**
     * We can never have more than 1 shopping cart, so let's implement singleton
     * 
     * @return SxCms_Cart
     */
    static public function getInstance()
    {
    	$shop = new Zend_Session_Namespace('shop');
    	if (!isset($shop->cart)) {
    	   $shop->cart = new self();
    	}

    	return $shop->cart;
    }

    /**
     * Returns the products in cart
     * @return array
     */
    public function getProducts()
    {
    	return $this->products;
    }

    /**
     * Sets the quantity we in our cart for a given product
     * 
     * @param SxCms_Product $product
     * @param  $qty
     * @return SxCms_Cart
     */
    public function setQuantity(SxCms_Product $product, $qty)
    {
        if (!isset($this->products[$product->getId()])) {
        	return $this;
        }

        $current = $this->products[$product->getId()];
        $price   = $current['qty'] * $current['info']->getPrice();

        $this->total -= $price;

        $this->products[$product->getId()]['qty'] = 0;
        if ($qty == 0) {
        	unset($this->products[$product->getId()]);
        } else {
        	for ($i = 0; $i < $qty; $i++) {
        		$this->addProduct($current['info']);
        	}
        }

        return $this;
    }

    /**
     * Adds a product to the shopping cart
     * 
     * @param SxCms_Product $product
     * @return SxCms_Cart
     */
    public function addProduct(SxCms_Product $product)
    {
    	if (isset($this->products[$product->getId()])) {
    		$this->products[$product->getId()]['qty'] += 1;
    	} else {
    	   $this->products[$product->getId()] = array(
    	       'qty' => 1,
    	       'info' => $product,
    	   );
    	}

    	$this->total += $product->getPrice();
    	return $this;
    }

    /**
     * Deletes a product from the shopping cart
     * 
     * @param SxCms_Product $product
     * @return SxCms_Cart
     */
    public function deleteProduct(SxCms_Product $product)
    {
    	$product->loadState();
    	if (isset($this->products[$product->getId()])) {
    	    $total = $this->products[$product->getId()]['qty'] * $product->getPrice();
    	    $this->total -= $total;

    		unset($this->products[$product->getId()]);
    	}

    	return $this;
    }

    /**
     * Returns the total price for the products currently in our cart
     * 
     * @return float|int
     */
    public function getTotal()
    {
    	return $this->total;
    }
}
