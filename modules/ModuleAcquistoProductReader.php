<?php

namespace Acquisto\Frontend;
use Acquisto\Models, Acquisto\Classes;

class ModuleAcquistoProductReader extends \Module
{
	protected $strTemplate = 'mod_acquisto_product_reader';

	public function generate()
	{
		if (TL_MODE == 'BE') {
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['acquisto_product_reader'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		if(!\Input::get('product')) {
			return '';
		}

		return parent::generate();
	}

	protected function compile()
	{
		$_SESSION['ACQUISTO']['RECENT'][] = \Input::Get('product');

		\Product::findProduct(\Input::Get('product'));
		$this->Template->html = \Product::generateDetail();
	}

	public function generateAjax()
	{

	}
}