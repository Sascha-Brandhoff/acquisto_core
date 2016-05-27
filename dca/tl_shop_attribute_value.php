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

$GLOBALS['TL_DCA']['tl_shop_attribute_value'] = array
(
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_shop_attribute',
		'enableVersioning'            => true,
		'switchToEdit'                => true,
		'sql' => array
		(
			'keys' => array
			(
				'id'  => 'primary',
				'pid' => 'index'
			)
		)
	),
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('sorting'),
			'headerFields'            => array('title', 'type'),
			'flag'                    => 11,
			'panelLayout'             => 'search,limit',
			'disableGrouping'         => true,
			'child_record_callback'   => array('tl_shop_attribute_value', 'listItems')
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
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset()"'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	'palettes' => array
	(
		'default'                     => '{title_legend},type,title;{costs_legend},costs;{teaser_legend},teaser;{image_legend},singleSRC'
	),
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'sql'                     => "int(10) NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'sorting' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['title'],
			'inputType'               => 'text',
			'search'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'costs' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['costs'],
			'exclude'                 => true,
			'inputType'               => 'multiColumnWizard',
			'eval'                    => array
			(
				'columnFields' => array
				(
					'value' => array
					(
						'label'                 => &$GLOBALS['TL_LANG']['tl_shop_product']['costs_value'],
						'default'               => '0',
						'inputType'             => 'text',
						'eval'                  => array('mandatory'=>true, 'style'=>'width:130px')
					),
					'label' => array
					(
						'label'                 => &$GLOBALS['TL_LANG']['tl_shop_product']['costs_label'],
						'default'               => '0',
						'inputType'             => 'text',
						'eval'                  => array('mandatory'=>true, 'style'=>'width:130px')
					),
					'specialcosts' => array
					(
						'label'                 => &$GLOBALS['TL_LANG']['tl_shop_product']['specialcosts'],
						'inputType'             => 'text',
						'eval'                  => array('mandatory'=>false, 'style'=>'width:130px')
					),
					'pricelist' => array
					(
						'label'                 => &$GLOBALS['TL_LANG']['tl_shop_product']['pricelist'],
						'exclude'               => true,
						'inputType'             => 'select',
						'foreignKey'            => 'tl_shop_pricelist.title',
						'eval'                  => array('style'=>'width:160px', 'rgxp'=>'digit')
					),
				),
				'be_acqEdit'=>true
			),
			'sql'                     => "text NOT NULL"
		),
		'teaser' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_produkte']['teaser'],
			'inputType'               => 'textarea',
			'exclude'                 => true,
			'search'                  => false,
			'eval'                    => array('style'=>'height: 60px;', 'mandatory'=>false, 'tl_class'=>'clr', 'acquistoSearch'=>true),
			'sql'                     => "text NOT NULL"
		),
		'singleSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_attribute_value']['singleSRC'],
			'inputType'               => 'fileTree',
			'exclude'                 => true,
			'search'                  => false,
			'eval'                    => array('mandatory'=>false,'fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true,'extensions'=>'jpg,png,gif'),
			'sql'                     => "binary(16) NULL",
		)
	)
);

class tl_shop_attribute_value extends Backend
{
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function listItems($arrRow) 
	{
		return $arrRow['title'];
	}
}