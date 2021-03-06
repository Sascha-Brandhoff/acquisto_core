<?php

$GLOBALS['TL_DCA']['tl_shop_currency'] = array
(
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'switchToEdit'                => true,
		'onsubmit_callback'           => array
		(
			array('tl_shop_currency', 'onsubmit_callback')
		),
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
			'mode'                    => 1,
			'fields'                  => array('title'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;search,limit'
		),
		'label' => array
		(
			'fields'                  => array('title', 'iso_code', 'exchange_ratio', 'default_currency'),
			'showColumns'             => true
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
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_currency']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_currency']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_currency']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_currency']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	'palettes' => array
	(
		'__selector__'                => array('protected'),
		'default'                     => '{title_legend},title;{config_legend},default_currency,iso_code,exchange_ratio;{protected_legend},protected'
	),
	'subpalettes' => array
	(
		'protected'                   => 'groups'
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
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_currency']['title'],
			'inputType'               => 'text',
			'search'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'default_currency' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_currency']['default_currency'],
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'protected' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_currency']['protected'],
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'groups' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_currency']['groups'],
			'inputType'               => 'checkbox',
			'foreignKey'              => 'tl_member_group.name',
			'eval'                    => array('multiple'=>true, 'mandatory'=>true),
			'sql'                     => "blob NOT NULL"
		),
		'iso_code' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_currency']['iso_code'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'exchange_ratio' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_currency']['exchange_ratio'],
			'inputType'               => 'text',
			'default'                 => '0',
			'options'                 => $GLOBALS['ACQUISTO_CONFIG']['currency'],
			'eval'                    => array('mandatory'=>true, 'rgxp' => 'digit', 'maxlength'=>255, 'tl_class'=>'w50', 'includeBlankOption' => true),
			'sql'                     => "float NOT NULL default '0'"
		)
	)
);

class tl_shop_currency extends Backend
{
	public function onsubmit_callback($dc)
	{
		if($this->Input->Post('default_currency') && $this->Input->Post('FORM_SUBMIT') == 'tl_shop_currency') {
			$this->Database->prepare("UPDATE tl_shop_currency SET default_currency = ''")->execute();
			$this->Database->prepare("UPDATE tl_shop_currency SET default_currency = '1' WHERE id=?")->execute($this->Input->Get('id'));
		}
	}
}