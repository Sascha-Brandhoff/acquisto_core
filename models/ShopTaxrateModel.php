<?php

namespace Acquisto\Models;

class ShopTaxrateModel extends \Model
{
	protected static $strTable = 'tl_shop_taxrate';

        public static function findActiveRateByPid($intPid, array $arrOptions=array())
        {
                $t = static::$strTable;
                $arrColumns[] = "$t.pid = $intPid";

                $time = \Date::floorToMinute();
                $arrColumns[] = "$t.valid_from<='$time'";

		if (!isset($arrOptions['order']))
		{
			$arrOptions['order'] = "$t.valid_from DESC";
		}

		if (!isset($arrOptions['limit']))
		{
			$arrOptions['limit'] = 1;
		}

                return static::findBy($arrColumns, null, $arrOptions);
        }
}
