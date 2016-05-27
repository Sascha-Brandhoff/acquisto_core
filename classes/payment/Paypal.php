<?php

namespace Acquisto\Payment;
use Acquisto\Classes;

class Paypal extends \Payment
{
	public function buy()
	{
		return (object) array(
			'endProcess' => true,
			'payState'   => false
		);
	}
}