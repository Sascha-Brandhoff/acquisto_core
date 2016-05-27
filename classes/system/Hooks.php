<?php

namespace Acquisto\Classes;
use Acquisto\Models;

class Hooks
{
	public function onGeneratePage($objPage, $objLayout, $objPageRegular)
	{
		if(\Input::get('category')) {
			$objCategory = \ShopCategoryModel::findByAlias(\Input::get('category'));

			if(trim($objCategory->cssClass)) {
				$objLayout->cssClass .= $objCategory->cssClass . ' ';
			}
		}
	}

	public function onGenerateBreadcrumb($arrItems, $objModule)
	{
		$objPage = \PageModel::findById($arrItems[0]['data']['trail'][0]);
		$arrTrail = \Category::getTrail(\Input::Get('category'));

		if($objPage->assignShopConfig && $objPage->shopConfiguration) {
			$objConfig = \ShopConfigModel::findById($objPage->shopConfiguration);

			if($objConfig !== null) {
				foreach($arrItems as $item) {
					if($objConfig->jumpTo_list == $item['data']['id']) {
						$objCategoryPage = \PageModel::findById($item['data']['id']);
						$strUrl = \Controller::generateFrontendUrl($objCategoryPage->row(), '/category/%s');

						foreach($arrTrail as $trail) {
							$newItem = $item;
							$objCategory = \ShopCategoryModel::findById($trail);

							$newItem['href'] = sprintf($strUrl, $objCategory->alias);
#$newItem['title'] = 
#print_r($newItem);
							$arrNew[] = $newItem;
						}
					}
					else {
						$arrNew[] = $item;
					}
				}

				return $arrNew;
			}
			else {
				return $arrItems;
			}
		}
	}
}