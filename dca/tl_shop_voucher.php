<?php

$GLOBALS['TL_DCA']['tl_shop_voucher'] = array
(
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'switchToEdit'                => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'code' => 'unique'
			)
		)
	),
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('code'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;search,limit'
		),
		'label' => array
		(
			'fields'                  => array('code', 'member:tl_member.CONCAT(firstname, " ", lastname)', 'using_counter', 'active'),
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
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_voucher']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_voucher']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_voucher']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_voucher']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	'palettes' => array
	(
		'__selector__'                => array('active', 'using_counter'),
		'default'                     => '{title_legend},code,costs,member;{config_legend},using_counter,timelimit;{state_legend},active',
	),
	'subpalettes' => array
	(
		'active'                   => 'valid_from,valid_to',
		'using_counter'            => 'max_using'
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
		'order_id' => array
		(
			'sql'                     => "int(10) NOT NULL default '0'"
		),
		'is_used' => array
		(
			'sql'                     => "int(10) NOT NULL default '0'"
		),
		'code' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_voucher']['code'],
			'inputType'               => 'text',
			'search'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>20),
			'sql'                     => "char(20) NOT NULL default ''"
		),
		'costs' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_voucher']['costs'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>20, 'tl_class'=>'w50'),
			'sql'                     => "float NOT NULL default '0'"
		),
		'member' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_voucher']['member'],
			'inputType'               => 'select',
			'foreignKey'              => 'tl_member.CONCAT(firstname, " ", lastname)',
			'eval'                    => array('mandatory'=>false, 'tl_class'=>'w50', 'includeBlankOption'=>true, 'chosen'=>true),
			'sql'                     => "int(10) NOT NULL default '0'"
		),
		'using_counter' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_voucher']['using_counter'],
			'default'                 => '',
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'eval'                    => array('mandatory'=>false, 'isBoolean' => true, 'submitOnChange' => true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'max_using' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_voucher']['max_using'],
			'inputType'               => 'text',
			'search'                  => false,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>20),
			'sql'                     => "int(10) NOT NULL default '0'"
		),
		'valid_from' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_voucher']['valid_from'],
			'default'                 => '',
			'inputType'               => 'text',
			'exclude'                 => true,
			'eval'                    => array('rgxp'=>'date', 'mandatory'=>true, 'maxlength'=>20, 'datepicker'=>$this->getDatePickerString(),'tl_class'=>'w50 wizard'),
			'sql'                     => "char(10) NOT NULL default ''"
		),
		'valid_to' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_voucher']['valdid_to'],
			'default'                 => '',
			'inputType'               => 'text',
			'exclude'                 => true,
			'eval'                    => array('rgxp'=>'date', 'mandatory'=>true, 'maxlength'=>20, 'datepicker'=>$this->getDatePickerString(),'tl_class'=>'w50 wizard'),
			'sql'                     => "char(10) NOT NULL default ''"
		),
		'active' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_voucher']['active'],
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'eval'                    => array('mandatory'=>false, 'submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		)
	)
);