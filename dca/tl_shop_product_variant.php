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

$this->loadLanguageFile('tl_shop_produkte');

$GLOBALS['TL_DCA']['tl_shop_product_variant'] = array
(
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_shop_product_attribute',
		'enableVersioning'            => false,
		'switchToEdit'                => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
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
			'headerFields'            => array('attributeId'),
			'flag'                    => 12,
			'panelLayout'             => 'search,limit',
			'disableGrouping'         => true,
			'child_record_callback'   => array('tl_shop_produkte_varianten', 'listItems'),
		),
		'label' => array
		(
			'fields'                  => array('name'),
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
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_produkte_varianten']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_produkte_varianten']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_produkte_varianten']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset()"'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_produkte_varianten']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_produkte_varianten']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	'palettes' => array
	(
		'default'                     => '{title_legend},name,product_attribute;{costs_legend},costs;{image_legend},singleSRC',
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
		'sorting' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_produkte_varianten']['name'],
			'inputType'               => 'text',
			'search'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'product_attribute' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_produkte_varianten']['product_attribute'],
			'inputType'               => 'select',
			'search'                  => true,
//			'options_callback'        => array('tl_shop_produkte_varianten', 'getOptions'),
			'eval'                    => array('mandatory'=>false, 'maxlength'=>64, 'tl_class'=>'w50', 'includeBlankOption'=>true),
			'sql'                     => "int(10) NOT NULL default '0'"
		),
		'costs' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_products']['costs'],
			'exclude'                 => true,
			'inputType'               => 'multiColumnWizard',
			'eval'                    => array
			(
				'columnFields' => array
				(
					'value' => array
					(
						'label'                 => &$GLOBALS['TL_LANG']['tl_shop_products']['costs_value'],
						'default'               => '0',
						'inputType'             => 'text',
						'eval'                  => array('mandatory'=>true, 'style'=>'width:130px')
					),
					'label' => array
					(
						'label'                 => &$GLOBALS['TL_LANG']['tl_shop_products']['costs_label'],
						'default'               => '0',
						'inputType'             => 'text',
						'eval'                  => array('mandatory'=>true, 'style'=>'width:130px')
					),
					'specialcosts' => array
					(
						'label'                 => &$GLOBALS['TL_LANG']['tl_shop_products']['specialcosts'],
						'inputType'             => 'text',
						'eval'                  => array('mandatory'=>false, 'style'=>'width:130px')
					),
					'pricelist' => array
					(
						'label'                 => &$GLOBALS['TL_LANG']['tl_shop_products']['pricelist'],
						'exclude'               => true,
						'inputType'             => 'select',
						'foreignKey'            => 'tl_shop_pricelist.title',
						'eval'                  => array('style'=>'width:160px', 'rgxp'=>'digit')
					),
				)
			),
			'sql'                     => "text NOT NULL"
		),
		'singleSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_produkte']['imageSRC'],
			'inputType'               => 'fileTree',
			'exclude'                 => true,
			'search'                  => false,
			'eval'                    => array('mandatory'=>false,'fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true,'extensions'=>'jpg,png,gif'),
			'sql'                     => "binary(16) NULL",
		),
	)
);

class tl_shop_produkte_varianten extends Backend
{
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function buildStructure($previous_id)
	{
		if($previous_id) {
			$objParent = $this->Database->prepare("SELECT * FROM tl_shop_products_variant WHERE id=?")->execute($previous_id);

			if($objParent->product_attribute) {
				$strAdd = $this->buildStructure($objParent->product_attribute);
			}
		}

		return $strAdd . " &raquo; " . $objParent->name;
	}

	public function listItems($arrRow)
	{
		if($arrRow['product_attribute']) {
			$strAdd = $this->buildStructure($arrRow['product_attribute']) . " &raquo; ";
		}

		return "<span style=\"color:#b3b3b3; padding-left:3px;\">" . $strAdd . "</span>" . $arrRow['name'];
	}

	public function getOptions($objData)
	{
		$objParent   = $this->Database->prepare("SELECT * FROM tl_shop_produkte_varianten WHERE id=?")->execute($objData->id);
		$objAttribut = $this->Database->prepare("SELECT * FROM tl_shop_produkte_attribute WHERE id=?")->execute($objParent->pid);

		if($objAttribut->pattribut_id) {
			$objWhile = $this->Database->prepare("SELECT * FROM tl_shop_produkte_varianten WHERE pid=?")->execute($objAttribut->pattribut_id);
			while($objWhile->next()) {
				if($objWhile->product_attribute) {
					$strAdd = $this->buildStructure($objWhile->product_attribute) . " &raquo; ";
				}

				$arrOptions[$objWhile->id] = $strAdd . $objWhile->name;
			}
		}

		return $arrOptions;
	}
}
