<?php

namespace Platron\Starrys\handbooks;

use MyCLabs\Enum\Enum;

class TaxModes extends Enum
{
	const
		OSN = 1,
		USN_INCOME = 2,
		USN_INCOME_OUTCOME = 4,
		ENDV = 8,
		ESN = 16,
		PATENT = 32;
}