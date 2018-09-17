<?php

namespace Platron\Starrys\handbooks;

use MyCLabs\Enum\Enum;

class PayAttributeTypes extends Enum
{
	const
		FULL_PRE_PAID_BEFORE_GET_PRODUCT = 1,
		PARTIAL_PRE_PAID_BEFORE_GET_PRODUCT = 2,
		PRE_PAID = 3,
		FULL_PAID_WITH_GET_PRODUCT = 4,
		PRE_PAID_WITH_GET_PRODUCT_AND_CREDIT = 5,
		NOT_PAID_WITH_GET_PRODUCT_AND_CREDIT = 6,
		TYPE_PAID_CREDIT = 7;
}