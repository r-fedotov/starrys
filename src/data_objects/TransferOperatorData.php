<?php

namespace Platron\Starrys\data_objects;

class TransferOperatorData extends BaseDataObject
{
	/** @var string */
	protected $Phone;
	/** @var string */
	protected $Name;
	/** @var string */
	protected $Address;
	/** @var string */
	protected $INN;

	/**
	 * TransferOperatorData constructor.
	 * @param string $name
	 * @param int $inn
	 * @param string $address
	 * @param int $phone
	 */
	public function __construct($name, $inn, $address, $phone)
	{
		$this->Name = (string)$name;
		$this->INN = (string)$inn;
		$this->Address = (string)$address;
		$this->Phone = (string)$phone;
	}

}