<?php

namespace Acquisto\Classes;

abstract class Payment
{
	public static function getConfig()
	{
		return array();
	}

	public static function buy()
	{
		return (object) array(
			'endProcess' => true,
			'payState'   => false,
			'payData'    => null
		);
	}

	public static function moduleConfiguration($id)
	{
		$Database   = \Database::getInstance();
	    	$objPayment = $Database->prepare("SELECT * FROM tl_shop_payment WHERE id=?")->limit(1)->execute($id);

		return unserialize($objPayment->configData);
	}
}