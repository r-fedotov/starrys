<?php

namespace Platron\Starrys\handbooks;

use MyCLabs\Enum\Enum;

class Taxes extends Enum
{
	const
		NONE = 4,
		VAT0 = 3,
		VAT10 = 2,
		VAT18 = 1,
		VAT110 = 6,
		VAT118 = 5;
}