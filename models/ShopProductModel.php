<?php

namespace Acquisto\Models;

class ShopProductModel extends \Model
{
	protected static $strTable = 'tl_shop_product';

	public static function findByCategory($intCategory, array $arrOptions=array())
	{
		$t = static::$strTable;
		$arrColumns[] = "$t.category LIKE '%:\"$intCategory\";%'";

		$time = \Date::floorToMinute();
		$arrColumns[] = "($t.start='' OR $t.start<='$time') AND ($t.stop='' OR $t.stop>'" . ($time + 60) . "')";
		$arrColumns[] = "published='1'";

		return static::findBy($arrColumns, null, $arrOptions);
	}
}