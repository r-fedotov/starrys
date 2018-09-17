<?php

namespace Platron\Starrys\handbooks;

use MyCLabs\Enum\Enum;

class AgentModes extends Enum
{
	const
		BANK_PAYMENT_AGENT = 1,
		BANK_PAYMENT_SUB_AGENT = 2,
		PAYMENT_AGENT = 4,
		PAYMENT_SUB_AGENT = 8,
		AUTHORIZED_USER = 16, // Поверенный
		COMMISSION_USER = 32, // Комиссионер
		OTHER = 64;
}