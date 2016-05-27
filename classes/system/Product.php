<?php

namespace Acquisto\Classes;
use Acquisto\Models;

class Product
{
	private static $id = 0;
	private static $model;

	const LIST_VIEW = 'LIST_TEMPLATE';
	const DETAIL_VIEW = 'DETAIL_TEMPLATE';

	public function __construct($Product)
	{
		if(\Validator::isNumeric($Product)) {
			$objModel = \ShopProductModel::findById($Product);
#			$objModel = static::findById($Product);
		}
		elseif(\Validator::isAlias($Product)) {
			$objModel = \ShopProductModel::findByAlias($Product);
#			$objModel = static::findByAlias($Product);
		}

		static::$id = $objModel->id;
		static::$model = $objModel;

		static::build();
	}

	private static function build()
	{
		$objModel = static::$model;

		$objModel->costs     = new \Price($objModel->costs);
		$objModel->type      = \ShopProducttypeModel::findById($objModel->type);
		$objModel->tax       = \ShopTaxrateModel::findActiveRateByPid($objModel->type->tax);
		$objModel->category  = deserialize($objModel->category);
		$objModel->detailUrl = static::generateDetailUrl();

		if(is_array($objModel->category)) {
			foreach($objModel->category as $v) {
				$arrCategory[] = \ShopCategoryModel::findById($v);
			}

			$objModel->category = $arrCategory;
		}

		if(\Validator::isUuid($objModel->previewSRC)) {
			$objModel->previewSRC = \FilesModel::findByUuid($objModel->previewSRC);
		}

		if($objModel->type->attribute) {

		}
		else {

		}

		static::$model = $objModel;
	}

	public static function generateList()
	{
		return static::generate(self::LIST_VIEW);
	}

	public static function generateDetail()
	{
		return static::generate(self::DETAIL_VIEW);
	}

	public function __set($name, $value)
	{
		if($name == 'cssClass') {
			$value = trim($value);
		}

		$objModel = static::$model;
		$objModel->$name = $value;

		static::$model = $objModel;
	}

	public function __get($name)
	{
		$objModel = static::$model;
		return $objModel->$name;
	}

	private static function generate($mode = self::LIST_VIEW)
	{
		$objModel = static::$model;

		switch($mode) {
			case "DETAIL_TEMPLATE":
				$strTemplate = $objModel->type->template_full;
				break;;
			case "LIST_TEMPLATE":
				$strTemplate = $objModel->type->template_list;
				break;;
		}

#		if(is_array($GLOBALS['ACUISTO_HOOK']['modifyProductModel'])) {
#			foreach($GLOBALS['ACUISTO_HOOK']['modifyProductModel'] as $v) {
#
#			}
#		}

		$objTemplate = new \FrontendTemplate($strTemplate);
		$objTemplate->setData($objModel->row());

		if($objModel->previewSRC) {
			\Controller::addImageToTemplate($objTemplate, array (
                            'addImage'    => 1,
                            'singleSRC'   => $objModel->previewSRC->path));
//                            'alt'         => null,
//                            'size'        => $this->acquistoShop_galerie_imageSize,
//                            'imagemargin' => $this->acquistoShop_galerie_imageMargin,
//                            'imageUrl'    => $Produkt->url,
//                            'caption'     => null,
//                            'floating'    => $this->acquistoShop_galerie_imageFloating,
//                            'fullsize'    => $this->acquistoShop_galerie_imageFullsize
		}

		return $objTemplate->parse();
	}

	public static function generateDetailUrl()
	{
		$objModel = static::$model;

		$objPage = \PageModel::findFirstPublishedByPid($GLOBALS['objPage']->pid);
		$objPage = \PageModel::findById($objPage->trail[0]);

		$objConfig = \ShopConfigModel::findById($objPage->shopConfiguration);
		$objPage = \PageModel::findById($objConfig->jumpTo_detail);

		if(\Input::Get('category')) {
			$strUrl = '/category/' . \Input::Get('category');
		}

		return \Controller::generateFrontendUrl($objPage->row(), $strUrl . '/product/' . $objModel->alias);
	}
}