<?php

namespace Platron\Starrys\data_objects;

class ProviderData extends BaseDataObject
{
	/** @var string */
	protected $Phone;
	/** @var string */
	protected $Name;
	/** @var string */
	protected $INN;

	/**
	 * ProviderData constructor.
	 * @param $name
	 * @param $inn
	 * @param $phone
	 */
	public function __construct($name, $inn, $phone)
	{
		$this->Name = (string)$name;
		$this->INN = (string)$inn;
		$this->Phone = (string)$phone;
	}
}