<?php

namespace Acquisto\Classes;
use Acquisto\Models;

class Price
{
	private static $priceConstruct = array();

	public function __construct($arrPrice)
	{
		static::$priceConstruct = deserialize($arrPrice);
	}

	public static function findByPricelist($intPricelist = 0, $intQuantity = 0)
	{
		foreach(static::$priceConstruct as $price) {
			if($price['pricelist'] == $intPricelist) {
				$arrPrices[] = $price;
			}
		}

		return static::sortPrices($arrPrices);
	}

	private static function sortPrices($arrPrices = array())
	{
		if(!count($arrPrices) OR !is_array($arrPrices)) {
			$arrPrices = static::$priceConstruct;
		}

		return $arrPrices;
	}
}