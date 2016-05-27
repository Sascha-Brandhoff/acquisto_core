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

$GLOBALS['TL_DCA']['tl_shop_product_attribute'] = array
(
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_shop_product',
		'ctable'                      => array('tl_shop_product_variant'),
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
			'headerFields'            => array('type', 'identification', 'name'),
			'flag'                    => 11,
			'panelLayout'             => 'search,limit',
			'disableGrouping'         => true,
			'child_record_callback'   => array('tl_shop_product_attribute', 'listItems'),
		),
		'label' => array
		(
			'fields'                  => array('attribut_id:tl_shop_attribute.bezeichnung'),
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
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_product_attribute']['edit'],
				'href'                => 'table=tl_shop_product_variant',
				'icon'                => 'edit.gif',
				'button_callback'     => array('tl_shop_product_attribute', 'changeButton')
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_product_attribute']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
//				'button_callback'     => array('tl_shop_product_attribute', 'changeButton')
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_product_attribute']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset()"'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_product_attribute']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_shop_product_attribute']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	'palettes' => array
	(
		'default'                     => '{title_legend},attributeId,attributeBeforeId;',
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
		'attributeId' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product_attribute']['attribut_id'],
			'inputType'               => 'select',
			'foreignKey'              => 'tl_shop_attribute.title',
//			'options_callback'        => array('tl_shop_product_attribute', 'listUnusedAttributes'),
			'search'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "int(10) NOT NULL default '0'"
		),
		'attributeBeforeId' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_shop_product_attribute']['pattribut_id'],
			'inputType'               => 'select',
			'options_callback'        => array('tl_shop_product_attribute', 'prevAttribute'),
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>64, 'tl_class'=>'w50', 'includeBlankOption'=>true),
			'sql'                     => "int(10) NOT NULL default '0'"
		)
	)
);

class tl_shop_product_attribute extends Backend
{
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function changeButton($row, $href, $label, $title, $icon, $attributes)
	{
		$objAttribut    = $this->Database->prepare("SELECT * FROM tl_shop_attribute WHERE id=?")->limit(1)->execute($row['attribut_id']);
		$objSumAttribut = $this->Database->prepare("SELECT COUNT(*) AS NumRows FROM tl_shop_attribute_value WHERE pid=?")->execute($objAttribut->id);

		if(!$objSumAttribut->NumRows) {
			return '<a title="edit" href="' . $this->addToUrl($href) . "&id=" . $row['id'] . '"><img width="12" height="16" alt="' . $label . '" title="' . $title . '" src="system/themes/default/images/' . $icon . '"></a>&nbsp;';
		}
		 else {
			return '<a title="edit" href="' . $this->addToUrl(str_replace("table=tl_shop_produkte_varianten", "act=edit", $href)) . "&id=" . $row['id'] . '"><img width="12" height="16" alt="' . $label . '" title="' . $title . '" src="system/themes/default/images/' . $icon . '"></a>&nbsp;';
		}
	}

	public function listUnusedAttributes() 
	{
		$arrSelected = array();

		$objSelected = $this->Database->prepare("SELECT * FROM tl_shop_product_attribute WHERE pid=?")->execute($this->Input->Get('id'));
		while($objSelected->next()) {
			$arrSelected[] = $objSelected->attribut_id;
		}

		if(count($arrSelected)) {
			$objAttributes2Use = $this->Database->prepare("SELECT * FROM tl_shop_attribute WHERE id NOT IN(" . implode(",", $arrSelected) . ")")->execute();

			while($objAttributes2Use->next()) {
				$arrAttributes2Use[$objAttributes2Use->id] = $objAttributes2Use->bezeichnung;
			}
		}

		return $arrAttributes2Use;
	}

	public function listItems($arrRow)
	{
		$objAttribut    = $this->Database->prepare("SELECT * FROM tl_shop_attribute WHERE id=?")->limit(1)->execute($arrRow['attribut_id']);
		$objSumAttribut = $this->Database->prepare("SELECT COUNT(*) AS numRows FROM tl_shop_attribute_value WHERE pid=?")->execute($objAttribut->id);

		if($objSumAttribut->numRows) {
			$objVarianten   = $this->Database->prepare("SELECT * FROM tl_shop_attribute_value WHERE pid=?")->execute($objAttribut->id);
			while($objVarianten->next()) {
				if($objVarianten->type == 'counter') {
					$ausdruck = "%01." . $objVarianten->dezimal . "f";

					if(substr_count($objVarianten->bezeichnung, '%s')) {
						$ausdruck = sprintf($objVarianten->bezeichnung, $ausdruck);
					}

					for($nI = $objVarianten->from_value; $nI < $objVarianten->to_value; $nI = $nI + $objVarianten->steps_value) {
						$strList .= "<li style=\"color:#b3b3b3;\">&raquo; " . sprintf($ausdruck, $nI) . "</li>";
						$intCounter++;
					}
				}
				else {
					$strList .= "<li style=\"color:#b3b3b3;\">&raquo; " . $objVarianten->bezeichnung . "</li>";
					$intCounter++;
				}
			}

			$strReturnVal = "<div class=\"limit_height h64\" style=\"height: 64px;\">" . $objAttribut->bezeichnung . " <span style=\"color:#b3b3b3; padding-left:3px;\">[ID: " . $arrRow['id'] . " | Varianten: " . $intCounter . $strAdd . "]</span><hr /><ul>" . $strList . "</ul></div>";
		}
		else {
			$objSum         = $this->Database->prepare("SELECT COUNT(*) AS NumRows FROM tl_shop_produkte_varianten WHERE pid=?")->execute($arrRow['id']);
			$objVarianten   = $this->Database->prepare("SELECT * FROM tl_shop_produkte_varianten WHERE pid=?")->execute($arrRow['id']);

			while($objVarianten->next()) {
				$arrElement = $objVarianten->row();

				if($arrElement['produkt_attribut_id']) {
					$strAdd = $this->buildStructure($arrElement['produkt_attribut_id']);
				}

				$strList .= "<li style=\"color:#b3b3b3;\">" . $strAdd . " &raquo; " . $arrElement['bezeichnung'] . "</li>";
			}

			if($arrRow['pattribut_id']) {
				$objPAAttribut  = $this->Database->prepare("SELECT * FROM tl_shop_product_attribute WHERE id=?")->limit(1)->execute($arrRow['pattribut_id']);
				$objPAttribut   = $this->Database->prepare("SELECT * FROM tl_shop_attribute WHERE id=?")->limit(1)->execute($objPAAttribut->attribut_id);
				$strAdd        = " | Elternattribut: " . $objPAttribut->bezeichnung;
			}

			if($objSum->NumRows) {
				$strReturnVal = "<div class=\"limit_height h64\" style=\"height: 64px;\">" . $objAttribut->bezeichnung . " <span style=\"color:#b3b3b3; padding-left:3px;\">[ID: " . $arrRow['id'] . " | Varianten: " . $objSum->NumRows . $strAdd . "]</span><hr /><ul>" . $strList . "</ul></div>";
			}
			else {
				$strReturnVal = "<div class=\"limit_height h64\" style=\"height: 64px;\">" . $objAttribut->bezeichnung . " <span style=\"color:#b3b3b3; padding-left:3px;\">[ID: " . $arrRow['id'] . " | Varianten: " . $objSum->NumRows . $strAdd . "]</span></div>";
			}
		}

		return $strReturnVal;
	}

	public function prevAttribute($row)
	{
		$objRow = $this->Database->prepare("SELECT * FROM tl_shop_product_attribute WHERE id=?")->execute($row->id);
		$objAttributes = $this->Database->prepare("SELECT * FROM tl_shop_product_attribute WHERE pid=? && id!=?")->execute($objRow->pid, $objRow->id);

		while($objAttributes->next()) {
			$objAttribut  = $this->Database->prepare("SELECT * FROM tl_shop_attribute WHERE id=?")->limit(1)->execute($objAttributes->attribut_id);
			$arrOptions[$objAttributes->id] = $objAttribut->bezeichnung;
		}

		return $arrOptions;
	}

	public function buildStructure($previous_id)
	{
		if($previous_id) {
			$objParent = $this->Database->prepare("SELECT * FROM tl_shop_produkte_varianten WHERE id=?")->execute($previous_id);

			if($objParent->produkt_attribut_id) {
				$strAdd = $this->buildStructure($objParent->produkt_attribut_id);
			}
		}

		return $strAdd . " &raquo; " . $objParent->bezeichnung;
	}
}