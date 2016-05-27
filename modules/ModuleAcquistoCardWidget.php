<?php

namespace Acquisto\Frontend;
use Acquisto\Models, Acquisto\Classes;

class ModuleAcquistoCardWidget extends \Module
{
	protected $strTemplate = 'mod_acquisto_card_widget';

	public function generate()
	{
		if (TL_MODE == 'BE') {
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['acquisto_card_widget'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}

	protected function compile()
	{

	}

	public function generateAjax()
	{

	}
}