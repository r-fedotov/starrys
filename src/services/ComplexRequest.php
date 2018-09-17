<?php

namespace Platron\Starrys\services;

use Platron\Starrys\data_objects\Line;
use Platron\Starrys\handbooks\DocumentTypes;
use Platron\Starrys\handbooks\TaxModes;

class ComplexRequest extends BaseServiceRequest
{

	/** @var string */
	protected $Device = 'auto';
	/** @var string */
	protected $ClientId;
	/** @var string */
	protected $Group;
	/** @var int */
	protected $RequestId;
	/** @var int */
	protected $documentType;
	/** @var int */
	protected $TaxMode;
	/** @var int */
	private $phone;
	/** @var string */
	private $email;
	/** @var string */
	protected $Place;
	/** @var Line[] */
	protected $lines;
	/** @var string */
	protected $Password;
	/** @var float */
	protected $Cash;
	/** @var float[] */
	protected $NonCash;
	/** @var float */
	protected $AdvancePayment;
	/** @var float */
	protected $Credit;
	/** @var float */
	protected $Consideration;
	/** @var string */
	protected $Address;
	/** @var string */
	protected $Terminal;

	/**
	 * @inheritdoc
	 */
	public function getUrlPath()
	{
		return '/fr/api/v2/Complex';
	}

	/**
	 * @param int $requestId id запроса
	 */
	public function __construct($requestId)
	{
		$this->RequestId = (string)$requestId;
	}

	/**
	 * Установить идентификатор предприятия. Передается в случае использования одного сертификата на несколько предприятий
	 * @param string $group
	 */
	public function addGroup($group)
	{
		$this->Group = (string)$group;
	}

	/**
	 * Установить тип чека
	 * @param DocumentTypes $documentType
	 */
	public function addDocumentType(DocumentTypes $documentType)
	{
		$this->documentType = $documentType->getValue();
	}

	/**
	 * Установить режим налогообложения. Нужно если у организации существует более 1 системы налогообложения
	 * @param TaxModes $taxMode
	 */
	public function addTaxMode(TaxModes $taxMode)
	{
		$this->TaxMode = $taxMode->getValue();
	}

	/**
	 * Установить телефон покупателя
	 * @param int $phone
	 */
	public function addPhone($phone)
	{
		$this->phone = (string)$phone;
	}

	/**
	 * Установить email покупателя
	 * @param string $email
	 */
	public function addEmail($email)
	{
		$this->email = (string)$email;
	}

	/**
	 * Сумма оплаты наличными. Если сумма равна нулю, то это поле можно опустить
	 * @param float $cash
	 */
	public function addCash($cash)
	{
		$this->Cash = (int)$cash;
	}

	/**
	 * Массив из 3-ех элеметов с суммами оплат 3 различных типов. Обычно передается только первое значение
	 * @param int $firstAmount Сумма в копейках
	 * @param int $secondAmount Сумма в копейках
	 * @param int $thirdAmount Сумма в копейках
	 */
	public function addNonCash($firstAmount, $secondAmount = 0, $thirdAmount = 0)
	{
		$this->NonCash = [(int)$firstAmount, (int)$secondAmount, (int)$thirdAmount];
	}

	/**
	 * Сумма оплаты предоплатой. Поле не обязательное
	 * @param int $advancePayment Сумма в копейках
	 */
	public function addAdvancePayment($advancePayment)
	{
		$this->AdvancePayment = (int)$advancePayment;
	}

	/**
	 * Сумма оплаты постоплатой. Не обязательное
	 * @param int $credit Сумма в копейках
	 */
	public function addCredit($credit)
	{
		$this->Credit = (int)$credit;
	}

	/**
	 * Сумма оплаты встречным предоставлением. Не обязательное
	 * @param int $consideration Сумма в копейках
	 */
	public function addConsideration($consideration)
	{
		$this->Consideration = (int)$consideration;
	}

	/**
	 * Место расчетов. Можно указать адрес сайта
	 * @param string $place
	 */
	public function addPlace($place)
	{
		$this->Place = (string)$place;
	}

	/**
	 * Добавить позицию в чек
	 * @param Line $line
	 */
	public function addLine(Line $line)
	{
		$this->lines[] = $line;
	}

	/**
	 * Установить пароль. Не обязательно. Подробнее смотри в полной версии документации
	 * @param int $password
	 */
	public function addPassword($password)
	{
		$this->Password = (string)$password;
	}

	/**
	 * @param $clientId
	 */
	public function addClientId($clientId)
	{
		$this->ClientId = (string)$clientId;
	}

	/**
	 * @param string $address
	 */
	public function addAddress($address)
	{
		$this->Address = (string)$address;
	}

	/**
	 * @param $terminal
	 */
	public function addTerminal($terminal)
	{
		$this->Terminal = $terminal;
	}

	/**
	 * @return array
	 */
	public function getParameters()
	{
		$params = parent::getParameters();
		$params['PhoneOrEmail'] = $this->email ? $this->email : $this->phone;
		$params['FullResponse'] = true;
		return $params;
	}
}
