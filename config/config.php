<?php

array_insert($GLOBALS['BE_MOD']['acquisto'], 0, array
(
	'acquisto_manufacture' => array
	(
		'tables'     => array('tl_shop_manufacture'),
		'icon'       => 'system/modules/acquisto_core/assets/icons/be/cog.png'
	),
	'acquisto_voucher' => array
	(
		'tables'     => array('tl_shop_voucher'),
		'icon'       => 'system/modules/acquisto_core/assets/icons/be/cog.png'
	),
	'acquisto_products' => array
	(
		'tables'     => array('tl_shop_product', 'tl_shop_product_attribute', 'tl_shop_product_variant', 'tl_shop_category'),
		'icon'       => 'system/modules/acquisto_core/assets/icons/be/controller.png'
	),
	'acquisto_category' => array
	(
		'tables'     => array('tl_shop_category'),
		'icon'       => 'system/modules/acquisto_core/assets/icons/be/application_cascade.png'
	)
));

array_insert($GLOBALS['BE_MOD']['acquisto_settings'], 0, array
(
	'acquisto_attribute' => array
	(
		'tables'     => array('tl_shop_attribute', 'tl_shop_attribute_value'),
		'icon'       => 'system/modules/acquisto_core/assets/be/tl_shop_attributes.png',
	),
	'acquisto_unit' => array
	(
		'tables'     => array('tl_shop_unit'),
		'icon'       => 'system/modules/acquisto_core/assets/icons/be/table.png'
	),
	'acquisto_tax' => array
	(
		'tables'     => array('tl_shop_tax', 'tl_shop_taxrate'),
		'icon'       => 'system/modules/acquisto_core/assets/icons/be/ruby.png'
	),
	'acquisto_currency' => array
	(
		'tables'     => array('tl_shop_currency'),
		'icon'       => 'system/modules/acquisto_core/assets/icons/be/coins.png'
	),
	'acquisto_pricelist' => array
	(
		'tables'     => array('tl_shop_pricelist'),
		'icon'       => 'system/modules/acquisto_core/assets/icons/be/page_paste.png'
	),
	'acquisto_producttype' => array
	(
		'tables'     => array('tl_shop_producttype'),
		'icon'       => 'system/modules/acquisto_core/assets/icons/be/controller.png'
	),
	'acquisto_shipping' => array
	(
		'tables'     => array('tl_shop_shippingzone', 'tl_shop_shippingprice'),
		'icon'       => 'system/modules/acquisto_core/assets/icons/be/package.png',
	),
	'acquisto_payment' => array
	(
		'tables'     => array('tl_shop_payment'),
		'icon'       => 'system/modules/acquisto_core/assets/icons/be/money.png',
	),
	'acquisto_config' => array
	(
		'tables'     => array('tl_shop_config'),
		'icon'       => 'system/modules/acquisto_core/assets/icons/be/money.png',
	)
));

array_insert($GLOBALS['FE_MOD']['acquisto'], 0, array
(
	'acquisto_breadcrumb'          => 'ModuleAcquistoBreadcrumb',
	'acquisto_card'                => 'ModuleAcquistoCard',
	'acquisto_card_widget'         => 'ModuleAcquistoCardWidget',
	'acquisto_category_nav'        => 'ModuleAcquistoCategoryNav',
	'acquisto_product_list'        => 'ModuleAcquistoProductList',
	'acquisto_product_reader'      => 'ModuleAcquistoProductReader'
));

$GLOBALS['TL_HOOKS']['generatePage'][]       = array('Acquisto\Classes\Hooks', 'onGeneratePage');
$GLOBALS['TL_HOOKS']['generateBreadcrumb'][] = array('Acquisto\Classes\Hooks', 'onGenerateBreadcrumb');
$GLOBALS['TL_HOOKS']['replaceInsertTags'][]  = array('Acquisto\Classes\InsertTags', 'onReplaceInsertTags');

define('__ACQUISTO_MAJOR__', 0);
define('__ACQUISTO_MINOR__', 3);
define('__ACQUISTO_RELEASE__', 0);
define('__ACQUISTO_BUILD__', 2);
define('__ACQUISTO_VERSION__', __ACQUISTO_MAJOR__ . '.' . __ACQUISTO_MINOR__ . '.' . __ACQUISTO_RELEASE__);

array_insert($GLOBALS['TL_PAYMENT'], 0, array
(
	'Bill'     => 'system/modules/acquisto_core/classes/payment/Bill.php',
	'Paypal'   => 'system/modules/acquisto_core/classes/payment/Paypal.php',
	'Prepayed' => 'system/modules/acquisto_core/classes/payment/Prepayed.php',
	'Sofort'   => 'system/modules/acquisto_core/classes/payment/Sofort.php',
));

$GLOBALS['TL_HEAD']['PIXELSPREADDE'] = '<!--
    This Contao OpenSource CMS uses modules from pixelSpread.de
    Copyright (c)2012 - ' . date("Y") . ' by Sascha Brandhoff :: Extensions of pixelSpread.de are copyright of their respective owners
    Visit our website at http://www.pixelSpread.de for more information
//-->';