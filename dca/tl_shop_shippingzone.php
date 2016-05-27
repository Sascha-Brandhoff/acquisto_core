<?php

/**
 * The AcquistoShop extension allows the creation a OnlineStore width
 * the OpenSource Contao CMS. For Question visit our Website under
 * http://www.contao-acquisto.de  
 *
 * PHP version 5
 * @package    AcquistoShop
 * @subpackage Backend
 * @author     Sascha Brandhoff <brandhoff@contao-acquisto.de>
 * @copyright  AcquistoShop
 * @license    LGPL.
 * @filesource
 */

$GLOBALS['TL_DCA']['tl_shop_shippingzone'] = array
(
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_shop_shippingprice'),
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		),
	),
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('title'),
			'flag'                    => 1,
			'panelLayout'             => 'filter,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s <span style="color:#b3b3b3; padding-left:3px;">[]</span>'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_shippingzone']['edit'],
				'href'                => 'table=tl_shop_shippingprice',
				'icon'                => 'edit.gif'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_shippingzone']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_shippingzone']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_shippingzone']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_shippingzone']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	'palettes' => array
	(
		'default'                     => '{title_legend},title,calculate_tax,description;{country_legend},countrys',
	),
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_shippingzone']['title'],
			'inputType'               => 'text',
			'search'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'calculate_tax' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_shippingzone']['calculate_tax'],
			'inputType'               => 'checkbox',
			'default'                 => true,
			'eval'                    => array('mandatory'=>false, 'isBoolean'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_shippingzone']['description'],
			'inputType'               => 'textarea',
			'eval'                    => array('mandatory'=>false, 'tl_class' => 'clr'),
			'sql'                     => "text NOT NULL"
		),
		'countrys' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_shippingzone']['countrys'],
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'options'                 => $this->getCountries(),
			'eval'                    => array('mandatory'=>true, 'multiple'=>true),
			'sql'                     => "text NOT NULL"
		)
	)
);