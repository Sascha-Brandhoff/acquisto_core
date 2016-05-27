<?php

$GLOBALS['TL_DCA']['tl_shop_producttype'] = array
(
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id'    => 'primary',
			)
		),
	),
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('name'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;search,limit'
		),
		'label' => array
		(
			'fields'                  => array('name', 'tax:tl_shop_tax.title', 'attribute'),
			'showColumns'             => true
//			'format'                  => '%s <span style="color:#b3b3b3; padding-left:3px;">%s</span>'
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
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_producttype']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif',
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_producttype']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_producttype']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_producttype']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	'palettes' => array
	(
		'default'                     => '{title_legend},name,tax;{template_legend},template_full,template_list;{config_legend},attribute;{fields_legend},fields',
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
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_producttype']['name'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'filter'                  => false,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50', 'acquistoSearch'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'template_list' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_producttype']['template_list'],
			'exclude'                 => true,
			'search'                  => false,
			'filter'                  => false,
			'inputType'               => 'select',
			'options_callback'        => array('tl_shop_producttype', 'getTemplates'),
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50', 'includeBlankOption'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''",
		),
		'template_full' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_producttype']['template_full'],
			'exclude'                 => true,
			'search'                  => false,
			'filter'                  => false,
			'inputType'               => 'select',
			'options_callback'        => array('tl_shop_producttype', 'getTemplates'),
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50', 'includeBlankOption'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''",
		),
		'tax' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_producttype']['tax'],
			'default'                 => 0,
			'inputType'               => 'select',
			'foreignKey'              => 'tl_shop_tax.title',
			'exclude'                 => true,
			'search'                  => false,
			'filter'                  => true,
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
			'sql'                     => "int(10) NOT NULL default '0'"
		),
		'fields' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_producttype']['fields'],
			'default'                 => 0,
			'inputType'               => 'checkboxWizard',
			'options_callback'        => array('tl_shop_producttype', 'fields_options_callback'),
			'eval'                    => array('mandatory'=>true, 'multiple'=>true,'tl_class'=>''),
			'sql'                     => "blob NOT NULL"
		),
		'attribute' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_producttype']['attribute'],
			'default'                 => '',
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'eval'                    => array('mandatory'=>false),
			'sql'                     => "char(1) NOT NULL default ''",
		)
	)
);

class tl_shop_producttype extends Backend
{
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function fields_options_callback()
	{
		$this->loadDataContainer('tl_shop_product');
		$this->loadLanguageFile('tl_shop_product');

		foreach($GLOBALS['TL_DCA']['tl_shop_product']['fields'] as $key => $value) {
			if($value['eval']['be_acqEdit']) {
				$array[$key] = isset($value['label'][0]) ? $value['label'][0] : $key;
			}
		}

		return $array;
	}

	public function getTemplates()
	{
		return $this->getTemplateGroup('product_');
	}
}