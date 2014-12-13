<?php

/**
 * Development by Sanmax Consultancy BVBA
 * @version $Id: Address.php 8234 2010-05-31 14:13:40Z andries $
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
 * @package    SxCms_Address
 * @copyright  Copyright (c) 2009-2010 Sanmax Consultancy BVBA. (http://www.sanmax.be)
 */
class SxCms_Address
{
	/**
	 * Street name
	 * @var string
	 */
	protected $street = '';

	/**
	 * House number
	 * @var string
	 */
	protected $house = '';

	/**
	 * Postal code
	 * @var string
	 */
	protected $postal = '';

	/**
	 * City name
	 * @var string
	 */
	protected $city = '';

	/**
	 * Country code
	 * @var string
	 */
	protected $country = '';
	
	/**
	 * Region
	 * @var string
	 */
	protected $region = '';

	/**
	 * Sets the street name
	 *
	 * @param string $street
	 * @return Icy_Address
	 */
	public function setStreet($street)
	{
		$this->street = (string) $street;
		return $this;
	}

	/**
	 * Gets the street name
	 *
	 * @return string
	 */
	public function getStreet()
	{
		return $this->street;
	}

	/**
	 * Sets the house number
	 *
	 * @param sting $house
	 * @return Icy_Address
	 */
	public function setHouse($house)
	{
		$this->house = (string) $house;
		return $this;
	}

	/**
	 * Gets the house number
	 *
	 * @return string
	 */
	public function getHouse()
	{
		return $this->house;
	}

	/**
	 * Sets the postal code
	 *
	 * @param string $postal
	 * @return Icy_Address
	 */
	public function setPostal($postal)
	{
		$this->postal = (string) $postal;
		return $this;
	}

	/**
	 * Gets the postal code
	 *
	 * @return string
	 */
	public function getPostal()
	{
		return $this->postal;
	}

	/**
	 * Sets the city name
	 *
	 * @param string $city
	 * @return Icy_Address
	 */
	public function setCity($city)
	{
		$this->city = (string) $city;
		return $this;
	}

	/**
	 * Gets the city name
	 *
	 * @return string
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * Sets the country code
	 *
	 * @param string $country
	 * @return Icy_Address
	 */
	public function setCountry($country)
	{
		$this->country = (string) $country;
		return $this;
	}

	/**
	 * Gets the country code
	 *
	 * @return string
	 */
	public function getCountry()
	{
		return $this->country;
	}
	
	/**
	 * Sets the region
	 * 
	 * @param string $region
	 * @return SxCms_Address
	 */
	public function setRegion($region)
	{
		$this->region = (string) $region;
		return $this;
	}
	
	/**
	 * Gets the region
	 * 
	 * @retur string
	 */
	public function getRegion()
	{
		return $this->region;
	}
	
	/**
	 * Gets the full address line
	 * 
	 * @return string
	 */
	public function getFullAddress()
	{
		$address = $this->street . ' ' . $this->house . ', '
			. $this->postal . ' ' . $this->city . ' ' . $this->country;
			
		return $address;
	}
}
