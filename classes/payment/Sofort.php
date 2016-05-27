<?php

namespace Acquisto\Payment;
use Acquisto\Classes;

if(file_exists(TL_ROOT . '/system/modules/paywall_shop/libarys/sofortUeberweisung/payment/sofortLibSofortueberweisung.inc.php'))
{
	require_once(TL_ROOT . '/system/modules/paywall_shop/libarys/sofortUeberweisung/payment/sofortLibSofortueberweisung.inc.php');
}

class Sofort extends \Payment
{
	public static function getConfig()
	{
		\System::loadLanguageFile('tl_shop_payment');
		$configData = array(
			'apiKey' => array
			(
				'label'                   => &$GLOBALS['TL_LANG']['tl_shop_payment_sofort']['apiKey'],
				'inputType'               => 'text',
				'search'                  => true,
				'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'')
			),
			'userId' => array
			(
				'label'                   => &$GLOBALS['TL_LANG']['tl_shop_payment_sofort']['userId'],
				'inputType'               => 'text',
				'search'                  => true,
				'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50')
			),
			'projectId' => array
			(
				'label'                   => &$GLOBALS['TL_LANG']['tl_shop_payment_sofort']['projectId'],
				'inputType'               => 'text',
				'search'                  => true,
				'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'tl_class'=>'w50')
			)
		);

		return $configData;
	}

	public static function buy()
	{
		if(\Input::Get('returnFromSolution'))
		{
			return (object) array(
				'endProcess' => true,
				'payState'   => true,
				'payData'    => $_SESSION['cardValues']['transactionId']
			);
		}
		else
		{
			$config = self::moduleConfiguration($_SESSION['cardValues']['paymentSolution']);
			$configkey = str_replace(" ", "", $config['userId'] . ":" . $config['projectId'] . ":" . $config['apiKey']);

			$Sofortueberweisung = new \Sofortueberweisung($configkey);
			$Sofortueberweisung->setAmount(700);
			$Sofortueberweisung->setCurrencyCode('EUR');
			$Sofortueberweisung->setReason('Testueberweisung', 'Verwendungszweck');
			$Sofortueberweisung->setSuccessUrl(\Environment::Get('url') . \Environment::Get('requestUri') . '?returnFromSolution=true', true);
			$Sofortueberweisung->setAbortUrl(\Environment::Get('url') . \Environment::Get('requestUri'));
			$Sofortueberweisung->setNotificationUrl(\Environment::Get('url') . \Environment::Get('requestUri') . '?paymentError=true');
			$Sofortueberweisung->setCustomerprotection(true);

			$Sofortueberweisung->sendRequest();
			$_SESSION['cardValues']['transactionId'] = $Sofortueberweisung->getTransactionId();

			if($Sofortueberweisung->isError()) {
				//PNAG-API didn't accept the data
				echo $Sofortueberweisung->getError();
			} else {
				//buyer must be redirected to $paymentUrl else payment cannot be successfully completed!
				$paymentUrl = $Sofortueberweisung->getPaymentUrl();
				header('Location: '.$paymentUrl);
			}
		}
	}
}