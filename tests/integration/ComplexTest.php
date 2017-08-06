<?php

namespace Platron\Shtrihm\tests\integration;

use Platron\Starrys\clients\PostClient;
use Platron\Starrys\data_objects\Line;
use Platron\Starrys\services\ComplexRequest;
use Platron\Starrys\services\ComplexResponse;

class ComplexTest extends IntegrationTestBase {
	public function testComplex(){
		$client = new PostClient($this->secretKeyPath, $this->certPath);
		$line = new Line('Test product', 1, '10.00', Line::TAX_VAT18);
		$line->addPayAttribute(Line::PAY_ATTRIBUTE_TYPE_FULL_PAID_WITH_GET_PRODUCT);
		
		$complexServise = new ComplexRequest(time());
		$complexServise->addDocumentType(ComplexRequest::DOCUMENT_TYPE_BUY)
			->addEmail('test@test.ru')
			->addGroup($this->group)
			->addPhone('79050000000')
			->addPlace('www.test.ru')
			->addTaxMode(ComplexRequest::TAX_MODE_ESN)
			->addLine($line);
		
		$response = new ComplexResponse($client->sendRequest($complexServise));
		
		$this->assertTrue($response->isValid());
	}
}
