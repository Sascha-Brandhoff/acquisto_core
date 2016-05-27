<?php

$GLOBALS['TL_DCA']['tl_shop_payment'] = array
(
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => false,
		'switchToEdit'                => true,
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
			'fields'                  => array('name'),
			'flag'                    => 1,
			'panelLayout'             => 'filter,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('name', 'payment_module', 'protected'),
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
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_payment']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_payment']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_payment']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_payment']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	'palettes' => array
	(
		'__selector__'                => array('payment_module', 'protected'),
		'default'                     => '{title_legend},name,payment_module;{config_legend},configData;{description_legend:hide},description;{protected_legend},protected'
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
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_payment']['name'],
			'inputType'               => 'text',
			'search'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'payment_module' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_payment']['payment_module'],
			'inputType'               => 'select',
			'filter'                  => true,
			'options_callback'        => array('tl_shop_payment', 'getPaymentModules'),
			'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50', 'submitOnChange'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_payment']['description'],
			'inputType'               => 'textarea',
			'eval'                    => array('mandatory'=>false, 'rte'=>'tinyMCE', 'tl_class'=>'clr'),
			'sql'                     => "text NOT NULL"
		),
		'protected' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_payment']['protected'],
			'inputType'               => 'checkbox',
			'search'                  => false,
			'eval'                    => array('mandatory'=>false, 'submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'groups' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_payment']['groups'],
			'inputType'               => 'checkbox',
			'foreignKey'              => 'tl_member_group.name',
			'search'                  => false,
			'eval'                    => array('multiple'=>true, 'mandatory'=>true),
			'sql'                     => "text NOT NULL"
		),
		'configData' => array
		(
			'input_field_callback'    => array('tl_shop_payment', 'readConfig'),
			'sql'                     => "blob NOT NULL"
		)
	)
);

class tl_shop_payment extends Backend
{
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function readConfig(DataContainer $DC) 
	{
		if(\Input::Post('FORM_SUBMIT') == 'tl_shop_payment')
		{
			$this->Database->prepare("UPDATE tl_shop_payment SET configData = '" . serialize(\Input::Post('configData')) . "' WHERE id = ?")->execute($DC->id);
		}

		if($DC->activeRecord->payment_module)
		{
			$className = $DC->activeRecord->payment_module;
			$arrConfig = $className::getConfig();
			$arrData   = deserialize($DC->activeRecord->configData);

			if(!count($arrConfig) OR !is_array($arrConfig))
			{
				return '<div class="long"><h3>' . $GLOBALS['TL_LANG']['tl_shop_payment']['error'][0] . '</h3><p class="tl_help">' . $GLOBALS['TL_LANG']['tl_shop_payment']['error'][1] . '</p></div>';
			}

			if(!is_array($arrData))
			{
				$arrData = array();
			}

			foreach($arrConfig as $k=>$v)
			{
				$objWidget = $GLOBALS['BE_FFL'][$v['inputType']];
				$objWidget = new $objWidget($this->prepareForWidget($v, 'configData[' . $k . ']'));

				
				if($arrData[$k])
				{
					$objWidget->value = $arrData[$k];
				}

				$htmlData .= isset($v['eval']['tl_class']) ? '<div class="' . $v['eval']['tl_class'] . '">' : '<div>';

				if($v['inputType'] != 'checkbox')
				{
					$htmlData .= sprintf('<h3><label for="%s">%s</label></h3>', 'configData[' . $name . ']', $v['label'][0]);
				}

				$htmlData .= $objWidget->generate();
				$htmlData .= sprintf('<p class="tl_help tl_tip">%s</p>', $v['label'][1]);
				$htmlData .= '</div>';
			}
		}
		else
		{
			return '<div class="long"><h3>' . $GLOBALS['TL_LANG']['tl_shop_payment']['error'][0] . '</h3><p class="tl_help">' . $GLOBALS['TL_LANG']['tl_shop_payment']['error'][1] . '</p></div>';
		}

		return $htmlData;
	}

	public function getPaymentModules()
	{
		if(is_array($GLOBALS['TL_PAYMENT']))
		{
			foreach($GLOBALS['TL_PAYMENT'] as $k=>$v)
			{
				$arrPayment[$k] = $k;
			}
		}

		return $arrPayment;
	}
}