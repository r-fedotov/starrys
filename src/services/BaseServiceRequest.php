<?php

namespace Platron\Starrys\services;

use Platron\Starrys\data_objects\BaseDataObject;

abstract class BaseServiceRequest extends BaseDataObject
{

	const REQUEST_URL = 'https://fce.starrys.ru:4443/fr/api/v2/';

	/**
	 * Получить путь для запроса относительно домена
	 * @return string
	 */
	abstract public function getUrlPath();
}
