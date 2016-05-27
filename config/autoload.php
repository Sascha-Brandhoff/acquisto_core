<?php

ClassLoader::addNamespaces(array
(
	'Acquisto',
	'Acquisto\Backend',
	'Acquisto\Classes',
	'Acquisto\Drivers',
	'Acquisto\Frontend',
	'Acquisto\Models',
	'Acquisto\Payment'
));
 
ClassLoader::addClasses(array
(
	// Classes
	'Acquisto\Classes\AcquistoSystem'               => 'system/modules/acquisto_core/classes/system/AcquistoSystem.php',
	'Acquisto\Classes\Card'                         => 'system/modules/acquisto_core/classes/system/Card.php',
	'Acquisto\Classes\Category'                     => 'system/modules/acquisto_core/classes/system/Category.php',
	'Acquisto\Classes\Hooks'                        => 'system/modules/acquisto_core/classes/system/Hooks.php',
	'Acquisto\Classes\InsertTags'                   => 'system/modules/acquisto_core/classes/system/InsertTags.php',
	'Acquisto\Classes\Payment'                      => 'system/modules/acquisto_core/classes/system/Payment.php',
	'Acquisto\Classes\Price'                        => 'system/modules/acquisto_core/classes/system/Price.php',
	'Acquisto\Classes\Product'                      => 'system/modules/acquisto_core/classes/system/Product.php',

	// Drivers
	'Acquisto\Drivers\DC_Product'                   => 'system/modules/acquisto_core/drivers/DC_Product.php',

	// FE-Modules
	'Acquisto\Frontend\ModuleAcquistoBreadcrumb'    => 'system/modules/acquisto_core/modules/ModuleAcquistoBreadcrumb.php',
	'Acquisto\Frontend\ModuleAcquistoCard'          => 'system/modules/acquisto_core/modules/ModuleAcquistoCard.php',
	'Acquisto\Frontend\ModuleAcquistoCardWidget'    => 'system/modules/acquisto_core/modules/ModuleAcquistoCardWidget.php',
	'Acquisto\Frontend\ModuleAcquistoCategoryNav'   => 'system/modules/acquisto_core/modules/ModuleAcquistoCategoryNav.php',
	'Acquisto\Frontend\ModuleAcquistoProductList'   => 'system/modules/acquisto_core/modules/ModuleAcquistoProductList.php',
	'Acquisto\Frontend\ModuleAcquistoProductReader' => 'system/modules/acquisto_core/modules/ModuleAcquistoProductReader.php',

	// Models
	'Acquisto\Models\ShopCategoryModel'             => 'system/modules/acquisto_core/models/ShopCategoryModel.php',
	'Acquisto\Models\ShopConfigModel'               => 'system/modules/acquisto_core/models/ShopConfigModel.php',
	'Acquisto\Models\ShopCurrencyModel'             => 'system/modules/acquisto_core/models/ShopCurrencyModel.php',
	'Acquisto\Models\ShopManufactureModel'          => 'system/modules/acquisto_core/models/ShopManufactureModel.php',
	'Acquisto\Models\ShopPricelistModel'            => 'system/modules/acquisto_core/models/ShopPricelistModel.php',
	'Acquisto\Models\ShopProductModel'              => 'system/modules/acquisto_core/models/ShopProductModel.php',
	'Acquisto\Models\ShopProducttypeModel'          => 'system/modules/acquisto_core/models/ShopProducttypeModel.php',
	'Acquisto\Models\ShopTaxModel'                  => 'system/modules/acquisto_core/models/ShopTaxModel.php',
	'Acquisto\Models\ShopTaxrateModel'              => 'system/modules/acquisto_core/models/ShopTaxrateModel.php',
	'Acquisto\Models\ShopUnitModel'                 => 'system/modules/acquisto_core/models/ShopUnitModel.php',

	// Payment
	'Acquisto\Payment\Bill'                                 => 'system/modules/acquisto_core/classes/payment/Bill.php',
	'Acquisto\Payment\Paypal'                               => 'system/modules/acquisto_core/classes/payment/Paypal.php',
	'Acquisto\Payment\Prepayed'                             => 'system/modules/acquisto_core/classes/payment/Prepayed.php',
	'Acquisto\Payment\Sofort'                               => 'system/modules/acquisto_core/classes/payment/Sofort.php'
));

TemplateLoader::addFiles(array
(
	'category_node'                      => 'system/modules/acquisto_core/templates/navigation',

	'product_detail'                     => 'system/modules/acquisto_core/templates/product',
	'product_list'                       => 'system/modules/acquisto_core/templates/product',

	'mod_acquisto_breadcrumb'            => 'system/modules/acquisto_core/templates/modules',
	'mod_acquisto_card'                  => 'system/modules/acquisto_core/templates/modules',
	'mod_acquisto_card_widget'           => 'system/modules/acquisto_core/templates/modules',
	'mod_acquisto_category_nav'          => 'system/modules/acquisto_core/templates/modules',
	'mod_acquisto_product_list'          => 'system/modules/acquisto_core/templates/modules',
	'mod_acquisto_product_reader'        => 'system/modules/acquisto_core/templates/modules',
));