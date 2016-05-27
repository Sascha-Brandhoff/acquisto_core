<?php

namespace Acquisto\Classes;
use Acquisto\Models;

class Category
{
	private static $trail = array();
	private static $blnGenerated = false;

	public static function getTrail($IdOrAlias)
	{
		if(trim($IdOrAlias) && !static::$blnGenerated) {
			if(is_numeric($IdOrAlias)) {
				$objCategory = \ShopCategoryModel::findById($IdOrAlias);
			}
			else {
				$objCategory = \ShopCategoryModel::findByAlias($IdOrAlias);
			}

			static::$blnGenerated = true;
			static::generateTrail($objCategory->id);
		}

		return static::$trail;
	}

	private static function generateTrail($Id)
	{
		if(!$Id) {
			return '';
		}

		$objCategory = \ShopCategoryModel::findById($Id);

		if($objCategory->pid) {
			static::generateTrail($objCategory->pid);
		}

		static::$trail[] = $objCategory->id;
	}
}