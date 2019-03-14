<?php
/**
 * Created by PhpStorm.
 * User: Васек
 * Date: 14.03.2019
 * Time: 11:18
 */

namespace Platron\Starrys\tests\unit\services;

use Platron\Starrys\services\ComplexResponse;
use PHPUnit\Framework\TestCase;

class ComplexResponseTest extends TestCase
{
	public function test_construct_withSeveralErrorMessages()
	{
		$responseJson = '{"ClientId":"","Date":{"Date":{"Day":0,"Month":0,"Year":0},"Time":{"Hour":0,"Minute":0,"Second":0}},"Device":{"Name":"0123456789","Address":"1.2.3.4:1234"},"DeviceRegistrationNumber":"0123","DeviceSerialNumber":"4567","DocumentType":0,"FNSerialNumber":"890","Path":"/fr/api/v2/Complex","RequestId":"request_id","Response":{"Error":20,"ErrorMessages":["Error Message 1","Error Message 2"]}}';
		$decodedResponse = json_decode($responseJson);

		$complexResponse = new ComplexResponse($decodedResponse);

		$this->assertEquals('Error Message 1,Error Message 2', $complexResponse->getErrorDescription());
	}
}
