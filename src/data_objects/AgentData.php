<?php

namespace Platron\Starrys\data_objects;

class AgentData extends BaseDataObject
{
	/** @var string */
	protected $Operation;
	/** @var string */
	protected $Phone;

	/**
	 * AgentData constructor.
	 * @param string $operation
	 * @param int $phone
	 */
	public function __construct($operation, $phone)
	{
		$this->Operation = (string)$operation;
		$this->Phone = (string)$phone;
	}
}