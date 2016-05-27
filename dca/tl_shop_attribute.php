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

$GLOBALS['TL_DCA']['tl_shop_attribute'] = array
(
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_shop_attribute_value'),
		'enableVersioning'            => true,
		'switchToEdit'                => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('title'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;sort,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('title', 'type', 'widget'),
			'showColumns'             => true,
			'format'                  => '%s <span style="color:#b3b3b3; padding-left:3px;">[]</span>'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attribute'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_attribute']['edit'],
				'href'                => 'table=tl_shop_attribute_value',
				'icon'                => 'edit.gif',
				'button_callback'     => array('tl_shop_attribute', 'edit_callback')
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_attribute']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_attribute']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_attribute']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attribute'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_attribute']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	'palettes' => array
	(
		'__selector__'                => array('type'),
		'default'                     => '{title_legend},title,type,widget,calculation',
		'item'                        => '{title_legend},title,type,widget,calculation',
		'item_defined'                => '{title_legend},title,type,widget,calculation',
		'counter'                     => '{title_legend},title,type,widget,calculation;{counter_legend},count_from,count_to,count_steps',
		'database'                    => '{title_legend},title,type,widget,calculation;{database_legend},db_table,db_field',
		'callback'                    => '{title_legend},title,type,widget,calculation;{callback_legend},callback_class,callback_function'
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
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute']['title'],
			'inputType'               => 'text',
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'type' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute']['type'],
			'inputType'               => 'select',
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50', 'submitOnChange'=>true),
			'options'                 => array('item', 'item_defined', 'counter', 'database', 'callback'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_shop_attribute']['type_option'],
			'sql'                     => "char(64) NOT NULL default ''"
		),
		'widget' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute']['widget'],
			'inputType'               => 'select',
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'options'                 => array('select', 'checkbox', 'radio', 'textarea', 'text'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_shop_attribute']['widget_option'],
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "char(32) NOT NULL default ''"
		),
		'calculation' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute']['calculation'],
			'inputType'               => 'select',
			'options'                 => array('add', 'set'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_shop_attribute']['calculation_option'],
			'eval'                    => array('mandatory'=>false, 'maxlength'=>64, 'tl_class'=>'w50', 'includeBlankOption'=>true),
			'sql'                     => "char(64) NOT NULL default ''"
		),
		'db_table' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute']['db_table'],
			'inputType'               => 'select',
			'options'                 => array('select', 'checkbox', 'radio', 'textarea', 'text'),
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "char(32) NOT NULL default ''"
		),
		'db_field' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute']['db_field'],
			'inputType'               => 'select',
			'options'                 => array('select', 'checkbox', 'radio', 'textarea', 'text'),
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "char(32) NOT NULL default ''"
		),
		'callback_class' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['callback_class'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'callback_function' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['callback_function'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'count_from' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['count_from'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "float NOT NULL default '0'"
		),
		'count_to' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['count_to'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "float NOT NULL default '0'"
		),
		'count_steps' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['count_steps'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "float NOT NULL default '0'"
		),
//		'decimal' => array
//		(
//			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['decimal'],
//			'inputType'               => 'text',
//			'default'                 => 0,
//			'search'                  => true,
//			'eval'                    => array('mandatory'=>true, 'maxlength'=>3, 'tl_class'=>'w50'),
//			'sql'                     => "int(10) unsigned NOT NULL default '0'"
//		),
		'costs' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['costs'],
			'inputType'               => 'preisWizard',
			'eval'                    => array('mandatory'=>false),
			'sql'                     => "text NOT NULL"
		),
		'teaser' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_produkte']['teaser'],
			'inputType'               => 'textarea',
			'exclude'                 => true,
			'eval'                    => array('style'=>'height: 60px;', 'mandatory'=>false, 'tl_class'=>'clr', 'acquistoSearch'=>true),
			'sql'                     => "text NOT NULL"
		),
		'singleSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['singleSRC'],
			'inputType'               => 'fileTree',
			'exclude'                 => true,
			'eval'                    => array('mandatory'=>false,'fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true,'extensions'=>'jpg,png,gif'),
			'sql'                     => "binary(16) NULL",
		)
	)
);

class tl_shop_attribute extends Backend
{
	public function edit_callback($row, $href, $label, $title, $icon, $attributes)
	{
		if($row['type'] == 'item_defined') {
			return '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
		}
		else {
		    return Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
		}
	}
}