<?php

namespace Platron\Starrys\handbooks;

use MyCLabs\Enum\Enum;

class DocumentTypes extends Enum
{
	const
		SELL = 0,
		REFUND = 2,
		BUY = 1,
		BUY_REFUND = 3;
}