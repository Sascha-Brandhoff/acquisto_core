<?php

namespace Acquisto\Frontend;
use Acquisto\Models, Acquisto\Classes;

class ModuleAcquistoProductList extends \Module
{
	protected $strTemplate = 'mod_acquisto_product_list';

	public function generate()
	{
		if (TL_MODE == 'BE') {
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['acquisto_product_list'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		if(!\Input::get('category')) {
			return '';
		}

		return parent::generate();
	}

	protected function compile()
	{
		$objPage        = \PageModel::findById($GLOBALS['objPage']->id);
		$objCategory    = \ShopCategoryModel::findByAlias(\Input::get('category'));
		$objProductList = \ShopProductModel::findByCategory($objCategory->id);
		$baseUrl        = '/category/' . \Input::Get('category');

		if(\Input::Get('view')) {
			$_SESSION['ACQUISTO'][$this->type][$this->id]['view'] = \Input::Get('view');
			$this->redirect(\Controller::generateFrontendUrl($objPage->row(), $baseUrl));
		}

		if($objCategory->SEOKeywords) {
			if($GLOBALS['TL_KEYWORDS'] && !substr($GLOBALS['TL_KEYWORDS'], 0, 1) == ',') {
				$GLOBALS['TL_KEYWORDS'] .= ',';
			}

			$GLOBALS['TL_KEYWORDS'] .= $objCategory->SEOKeywords;
		}

		if($objCategory->SEODescription) {
			$GLOBALS['objPage']->description = trim($GLOBALS['objPage']->description . ' ' . $objCategory->SEODescription);
		}

		$arrConfig = deserialize($this->acquisto_listConfig);
		if(is_array($arrConfig) && count($arrConfig)) {
			if(!$_SESSION['ACQUISTO'][$this->type][$this->id]['view']) {
				$_SESSION['ACQUISTO'][$this->type][$this->id]['view'] = $arrConfig[0]['cssClass'];
			}

			foreach($arrConfig as $item) {
				if($_SESSION['ACQUISTO'][$this->type][$this->id]['view'] == $item['cssClass']) {
					$listConfig = $item;
				}

				$arrView[] = (object) array
				(
					'title'    => $item['title'],
					'url'      => \Controller::generateFrontendUrl($objPage->row(), $baseUrl . '/view/' . $item['cssClass']),
					'cssClass' => $item['cssClass'],
					'isActive' => ($_SESSION['ACQUISTO'][$this->type][$this->id]['view'] == $item['cssClass']) ? $isActive = 1 : $isActive = 0
				);
			}

			$this->Template->View = $arrView;
			$this->Template->viewSelected = $listConfig['cssClass'];
		}

		if($objProductList !== null) {
			$i = 1;
			while($objProductList->next()) {
				$objProduct = new \Product($objProductList->id);

				if(($i % $listConfig['perRow']) == 0) {
					$objProduct->cssClass .= ' break';
				}

				$i++;

				$this->Template->html .= $objProduct::generateList();
			}
		}
		else {

		}
	}

	public function generateAjax()
	{

	}
}