<?php

$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'assignShopConfig';
$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = str_replace("{publish_legend}", "{shop_legend:hide},assignShopConfig;{publish_legend}", $GLOBALS['TL_DCA']['tl_page']['palettes']['root']);
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['assignShopConfig'] = 'shopConfiguration';

$GLOBALS['TL_DCA']['tl_page']['fields']['assignShopConfig'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['assignShopConfig'],
	'inputType'               => 'checkbox',
	'exclude'                 => true,
	'search'                  => false,
	'filter'                  => true,
	'eval'                    => array('mandatory'=>false, 'tl_class'=>'', 'submitOnChange'=>true),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['shopConfiguration'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['shopConfiguration'],
	'inputType'               => 'select',
	'exclude'                 => true,
	'foreignKey'              => 'tl_shop_config.name',
	'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>''),
	'sql'                     => "int(10) unsigned NOT NULL default '0'"
);