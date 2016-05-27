<?php

namespace Acquisto\Classes;

class InsertTags
{
	public function onReplaceInsertTags($strTag = false)
	{
		$arrTag = explode("::", $strTag);
		
		if($arrTag[0] == 'acquisto') {
			switch($arrTag[1]) {
				case 'category':
					return $this->categoryInsertTags($arrTag[2]);
					break;;
				case 'product':
					return $this->productInsertTags($arrTag[2]);
					break;;
				case 'card':
					return $this->cardInsertTags($arrTag[2]);
					break;;
				case 'view':
					return $this->viewInsertTags($arrTag[2], $arrTag[3]);
					break;;
			}
		}

		return false;
	}

	public function viewInsertTags($part = null, $id = 0)
	{
		switch($part) {
			case 'product_list':
				$objProduct = new \Product($id);
				return $objProduct::generateList();
				break;;
			case 'product_detail':
				$objProduct = new \Product($id);
				return $objProduct::generateDetail();
				break;;
		}

		return false;
	}

	public function cardInsertTags($part = null)
	{
		switch($part) {
			case 'quantity':
				return 0;
				break;;
			case 'summary':
				return 0;
				break;;
		}

		return false;
	}

	public function categoryInsertTags($part = null)
	{
		if(!$part) { 
			$part = 'title';
		}

		$objCategory = \ShopCategoryModel::findByAlias(\Input::get('category'));
		if($objCategory !== null) {
			return $objCategory->$part;
		}
	}

	public function productInsertTags($part = null)
	{
		if(!$part) { 
			$part = 'name';
		}

		$objProduct = \ShopProductModel::findByAlias(\Input::get('product'));
		if($objProduct !== null) {
			return $objProduct->$part;
		}
	}
}