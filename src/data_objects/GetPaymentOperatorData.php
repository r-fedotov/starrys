<?php

namespace Platron\Starrys\data_objects;

class GetPaymentOperatorData extends BaseDataObject
{
	/** @var string */
	protected $Phone;

	/**
	 * GetPaymentOperatorData constructor.
	 * @param $phone
	 */
	public function __construct($phone)
	{
		$this->Phone = (string)$phone;
	}
}