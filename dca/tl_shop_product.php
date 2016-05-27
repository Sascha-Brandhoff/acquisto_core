<?php

$GLOBALS['TL_DCA']['tl_shop_product'] = array
(
	'config' => array
	(
		'dataContainer'               => 'Product',
		'ctable'                      => array('tl_shop_product_attribute'),
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id'    => 'primary',
				'pid'   => 'index',
				'alias' => 'index'
			)
		),
	),
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('name'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;sort,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('name', 'identification', 'type:tl_shop_producttype.name'),
			'showColumns'             => true
		),
		'global_operations' => array
		(
//			'importData' => array
//			(
//				'label'               => &$GLOBALS['TL_LANG']['tl_shop_product']['importData'],
//				'href'                => 'key=importData',
//				'class'               => 'header_edit_all',
//				'attributes'          => 'onclick="Backend.getScrollOffset();"'
//			),
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
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_product']['edit'],
				'href'                => 'table=tl_shop_product_attribute',
				'icon'                => 'edit.gif',
				'button_callback'     => array('tl_shop_product', 'editPage')
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_product']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_product']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_product']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_product']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	'palettes' => array
	(
		'__selector__' => array
		(
			'type',
//			'published'
		),
		'default' => array
		(
			'title' => array
			(
				'type',
				'name',
				'alias',
				'identification'
			),
			'show' => array
			(
				'marked',
				'published',
				'start',
				'stop'
			),
			'category' => array
			(
				'category'
			)
		)
	),
	'paletteConfig' => array
	(
	    'type' => array('\Acquisto\Models\ShopProducttypeModel', 'findById')
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
		'type' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['type'],
			'inputType'               => 'select',
			'exclude'                 => true,
			'filter'                  => true,
			'foreignKey'              => 'tl_shop_producttype.name',
			'eval'                    => array('mandatory'=>true, 'submitOnChange'=>true, 'includeBlankOption'=>true, 'tl_class'=>'', 'be_acqEdit'=>false, 'be_acqLegend'=>'title'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['name'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'filter'                  => false,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50', 'be_acqEdit'=>false, 'be_acqLegend'=>'title'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['alias'],
			'exclude'                 => true,
			'search'                  => false,
			'filter'                  => false,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'alnum', 'doNotCopy'=>true, 'spaceToUnderscore'=>true, 'maxlength'=>128, 'tl_class'=>'w50', 'be_acqEdit'=>false, 'be_acqLegend'=>'title'),
			'save_callback' => array
			(
				array('tl_shop_product', 'generateAlias')
			),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'ean' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['ean'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'filter'                  => false,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50', 'be_acqEdit'=>true, 'be_acqLegend'=>'title'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'identification' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['identification'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'filter'                  => false,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50', 'be_acqEdit'=>false, 'be_acqLegend'=>'title'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'weight' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['weight'],
			'inputType'               => 'text',
			'default'                 => 0,
			'exclude'                 => true,
			'search'                  => true,
			'filter'                  => false,
			'eval'                    => array('mandatory'=>false, 'rgxp'=>'digit', 'tl_class'=>'w50', 'be_acqEdit'=>true, 'be_acqLegend'=>'extended'),
			'sql'                     => "float NOT NULL default '0'"
		),
		'state' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['state'],
			'inputType'               => 'select',
			'options'                 => array('new' => 'Neu', 'used'=>'Gebraucht', 'refurbished' => 'Erneuert'),
			'exclude'                 => true,
			'search'                  => false,
			'filter'                  => true,
			'eval'                    => array('mandatory'=>false, 'tl_class'=>'w50', 'includeBlankOption'=>true, 'be_acqEdit'=>true, 'be_acqLegend'=>'extended'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'unit' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['unit'],
			'default'                 => 0,
			'inputType'               => 'select',
			'foreignKey'              => 'tl_shop_unit.title',
			'exclude'                 => true,
			'search'                  => false,
			'filter'                  => false,
			'eval'                    => array('mandatory'=>false, 'includeBlankOption'=>true, 'be_acqEdit'=>true, 'be_acqLegend'=>'baseprice'),
			'sql'                     => "int(10) NOT NULL default '0'"
		),
		'volume' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['volume'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'filter'                  => false,
			'eval'                    => array('mandatory'=>false, 'rgxp'=> 'digit ', 'maxlength'=>10, 'tl_class'=>'w50', 'be_acqEdit'=>true, 'be_acqLegend'=>'baseprice'),
			'sql'                     => "char(10) NOT NULL default ''"
		),
		'calculation_unit' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['calculation_unit'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'filter'                  => false,
			'eval'                    => array('mandatory'=>false, 'rgxp'=> 'digit ', 'maxlength'=>10, 'tl_class'=>'w50', 'be_acqEdit'=>true, 'be_acqLegend'=>'baseprice'),
			'sql'                     => "char(10) NOT NULL default ''"
		),
		'manufacture' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['manufacture'],
			'inputType'               => 'select',
			'foreignKey'              => 'tl_shop_manufacture.name',
			'exclude'                 => true,
			'search'                  => false,
			'filter'                  => true,
			'eval'                    => array('mandatory'=>false, 'tl_class'=>'w50', 'includeBlankOption'=>true, 'be_acqEdit'=>true, 'be_acqLegend'=>'extended'),
			'sql'                     => "int(10) NOT NULL default '0'"
		),
		'teaser' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['teaser'],
			'inputType'               => 'textarea',
			'exclude'                 => true,
			'search'                  => false,
			'eval'                    => array('style'=>'height: 60px;', 'mandatory'=>false, 'tl_class'=>'clr', 'be_acqEdit'=>true, 'be_acqLegend'=>'description'),
			'sql'                     => "text NOT NULL"
		),
		'tags' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['tags'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'long  clr', 'be_acqEdit'=>true, 'be_acqLegend'=>'description'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['description'],
			'inputType'               => 'textarea',
			'exclude'                 => true,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'rte'=>'tinyMCE', 'tl_class'=>'clr', 'be_acqEdit'=>true, 'be_acqLegend'=>'description'),
			'sql'                     => "text NOT NULL"
		),
		'costs' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['costs'],
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
		'category' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['category'],
			'exclude'                 => true,
			'inputType'               => 'treePicker',
			'eval'                    => array
			(
				'foreignTable'    => 'tl_shop_category',
				'titleField'      => 'title',
				'searchField'     => 'title',
				'managerHref'     => 'do=acquisto_product&table=tl_shop_categories',
				'fieldType'       => 'checkbox',
				'multiple'        => true,
				'pickerCallback'  => function($row) {
					return $row['title'] . ' [' . $row['id'] . ']';
				}
			),
			'sql'                     => "blob NULL"
		),
		'previewSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['previewSRC'],
			'inputType'               => 'fileTree',
			'exclude'                 => true,
			'search'                  => false,
			'eval'                    => array('mandatory'=>false,'fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true,'extensions'=>Config::get('validImageTypes'), 'be_acqEdit'=>true, 'be_acqLegend'=>'image'),
			'sql'                     => "binary(16) NULL",
		),
		'multiSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['multiSRC'],
			'inputType'               => 'fileTree',
			'exclude'                 => true,
			'search'                  => false,
			'eval'                    => array('multiple'=>true, 'orderField'=>'orderSRC_galerie', 'mandatory'=>false,'fieldType'=>'checkbox', 'files'=>true, 'filesOnly'=>true, 'be_acqEdit'=>true, 'isGallery'=>true, 'extensions'=>Config::get('validImageTypes'), 'be_acqLegend'=>'image'),
			'sql'                     => "blob NOT NULL"
		),
		'orderSRC_galerie' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['orderSRC'],
			'sql'                     => "blob NOT NULL"
		),
		'digital_product' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['digital_product'],
			'inputType'               => 'fileTree',
			'exclude'                 => true,
			'search'                  => false,
			'eval'                    => array('multiple'=>true, 'orderField'=>'orderSRC_digital', 'mandatory'=>false,'fieldType'=>'checkbox', 'files'=>true,'filesOnly'=>true,'extensions'=>strtolower($GLOBALS['TL_CONFIG']['allowedDownload']), 'be_acqEdit'=>true),
			'sql'                     => "blob NOT NULL"
		),
		'orderSRC_digital' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['orderSRC'],
			'sql'                     => "text NULL"
		),
		'marked' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['marked'],
			'inputType'               => 'checkbox',
			'exclude'                 => true,
			'search'                  => false,
			'filter'                  => true,
			'eval'                    => array('mandatory'=>false, 'tl_class'=>'m12 w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['published'],
			'inputType'               => 'checkbox',
			'exclude'                 => true,
			'search'                  => false,
			'filter'                  => true,
			'eval'                    => array('mandatory'=>false, 'tl_class'=>'m12 w50', 'isSelector'=>true, 'submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'catalog_money' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['catalogMoney'],
			'inputType'               => 'checkbox',
			'exclude'                 => true,
			'search'                  => false,
			'filter'                  => true,
			'eval'                    => array('mandatory'=>false, 'tl_class'=>'m12 w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'catalog_mode' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['catalogMode'],
			'inputType'               => 'checkbox',
			'exclude'                 => true,
			'search'                  => false,
			'filter'                  => true,
			'eval'                    => array('mandatory'=>false, 'tl_class'=>'m12 w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'start' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['start'],
			'default'                 => '',
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date', 'mandatory'=>false, 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard', 'subpalette'=>'published'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'stop' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product']['stop'],
			'default'                 => '',
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date', 'mandatory'=>false, 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard', 'subpalette'=>'published'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		)
	)
);

class tl_shop_product extends Backend
{
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function editPage($row, $href, $label, $title, $icon, $attributes)
	{
		$objType = \Acquisto\Models\ShopProducttypeModel::findById($row['type']);
		if($objType !== null) {
			return trim($objType->attribute) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
		}
	}

#	public function changeButton($row, $href, $label, $title, $icon, $attributes)
#	{
#		if($GLOBALS['ACQUISTO_PCLASS'][$row['type']][0]) {
#			$objProdukt = new $GLOBALS['ACQUISTO_PCLASS'][$row['type']][0]($row['id']);
#
#			if($objProdukt->hasAttributes) {
#				return '<a title="edit" href="' . $this->addToUrl(str_replace("act=edit", "table=tl_shop_product_attribute", $href)) . "&id=" . $row['id'] . '"><img width="12" height="16" alt="' . $label . '" title="' . $title . '" src="system/themes/default/images/' . $icon . '"></a>&nbsp;';
#			}
#			elseif($objProdukt->subTable) {
#				return '<a title="edit" href="' . $this->addToUrl(str_replace("act=edit", "table=" . $objProdukt->subTable, $href)) . "&id=" . $row['id'] . '"><img width="12" height="16" alt="' . $label . '" title="' . $title . '" src="system/themes/default/images/' . $icon . '"></a>&nbsp;';
#			} 
#			else {
#				return '<a title="edit" href="' . $this->addToUrl($href) . "&id=" . $row['id'] . '"><img width="12" height="16" alt="' . $label . '" title="' . $title . '" src="system/themes/default/images/' . $icon . '"></a>&nbsp;';
#			}
#		}
#		else {
#			return '<a title="edit" href="' . $this->addToUrl($href) . "&id=" . $row['id'] . '"><img width="12" height="16" alt="' . $label . '" title="' . $title . '" src="system/themes/default/images/' . $icon . '"></a>&nbsp;';
#		}
#	}
#
	public function generateAlias($varValue, DataContainer $dc)
	{
		$autoAlias = false;

		if (!strlen($varValue)){
			$autoAlias = true;
			$varValue = standardize($dc->activeRecord->name);
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_shop_product WHERE id=? OR alias=?")->execute($dc->id, $varValue);

		return $varValue;
	}

#	public function getTemplates(DataContainer $dc)
#	{
#		return $this->getTemplateGroup('acquisto_produkt_', $dc->activeRecord->pid);
#	}
}