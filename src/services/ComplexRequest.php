<?php

namespace Platron\Starrys\services;

use Platron\Starrys\data_objects\Line;
use Platron\Starrys\handbooks\DocumentTypes;
use Platron\Starrys\handbooks\TaxModes;
use Platron\Starrys\SdkException;

class ComplexRequest extends BaseServiceRequest
{

	/** @var string */
	protected $device = 'auto';
	/** @var string */
	protected $fullResponse = false;
	/** @var string */
	protected $group;
	/** @var int */
	protected $requestId;
	/** @var int */
	protected $documentType;
	/** @var int */
	protected $taxMode;
	/** @var int */
	protected $phone;
	/** @var string */
	protected $email;
	/** @var string */
	protected $place;
	/** @var Line[] */
	protected $lines;
	/** @var string */
	protected $password;
	/** @var float */
	protected $cash;
	/** @var float[] */
	protected $nonCash;
	/** @var float */
	protected $advancePayment;
	/** @var float */
	protected $credit;
	/** @var float */
	protected $consideration;

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
		$this->requestId = $requestId;
	}

	/**
	 * Установить идентификатор предприятия. Передается в случае использования одного сертификата на несколько предприятий
	 * @param string $group
	 */
	public function addGroup($group)
	{
		$this->group = $group;
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
		$this->taxMode = $taxMode->getValue();
	}

	/**
	 * Установить телефон покупателя
	 * @param int $phone
	 */
	public function addPhone($phone)
	{
		$this->phone = $phone;
	}

	/**
	 * Установить email покупателя
	 * @param string $email
	 */
	public function addEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * Сумма оплаты наличными. Если сумма равна нулю, то это поле можно опустить
	 * @param float $cash
	 */
	public function addCash($cash)
	{
		$this->cash = $cash;
	}

	/**
	 * Массив из 3-ех элеметов с суммами оплат 3 различных типов. Обычно передается только первое значение
	 * @param int $firstAmount Сумма в копейках
	 * @param int $secondAmount Сумма в копейках
	 * @param int $thirdAmount Сумма в копейках
	 */
	public function addNonCash($firstAmount, $secondAmount = 0, $thirdAmount = 0)
	{
		$this->nonCash = [$firstAmount, $secondAmount, $thirdAmount];
	}

	/**
	 * Сумма оплаты предоплатой. Поле не обязательное
	 * @param int $advancePayment Сумма в копейках
	 */
	public function addAdvancePayment($advancePayment)
	{
		$this->advancePayment = $advancePayment;
	}

	/**
	 * Сумма оплаты постоплатой. Не обязательное
	 * @param int $credit Сумма в копейках
	 */
	public function addCredit($credit)
	{
		$this->credit = $credit;
	}

	/**
	 * Сумма оплаты встречным предоставлением. Не обязательное
	 * @param int $consideration Сумма в копейках
	 */
	public function addConsideration($consideration)
	{
		$this->consideration = $consideration;
	}

	/**
	 * Место расчетов. Можно указать адрес сайта
	 * @param string $place
	 */
	public function addPlace($place)
	{
		$this->place = $place;
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
		$this->password = $password;
	}

	/**
	 * @return array
	 */
	public function getParameters()
	{
		$lines = [];
		foreach ($this->lines as $line) {
			$lines[] = $line->getParameters();
		}

		$params = [
			'Device' => $this->device,
			'Group' => $this->group,
			'Password' => $this->password,
			'RequestId' => (string)$this->requestId,
			'Lines' => $lines,
			'Cash' => $this->cash,
			'NonCash' => $this->nonCash,
			'AdvancePayment' => $this->advancePayment,
			'Credit' => $this->credit,
			'Consideration' => $this->consideration,
			'TaxMode' => $this->taxMode,
			'PhoneOrEmail' => $this->email ? $this->email : $this->phone,
			'Place' => $this->place,
			'FullResponse' => $this->fullResponse,
		];

		return $params;
	}
}
