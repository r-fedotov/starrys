<?php

namespace Platron\Starrys\tests\integration;

use Platron\Starrys\clients\PostClient;
use Platron\Starrys\data_objects\Line;
use Platron\Starrys\handbooks\DocumentTypes;
use Platron\Starrys\services\ComplexRequest;
use Platron\Starrys\services\ComplexResponse;

class ComplexTest extends IntegrationTestBase {
	public function testComplex(){
		$client = new PostClient($this->starrysApiUrl, $this->secretKeyPath, $this->certPath);
		$line = new Line('Test product', 1, 10.00, Line::TAX_VAT18);
		$line->addPayAttribute(Line::PAY_ATTRIBUTE_TYPE_FULL_PAID_WITH_GET_PRODUCT);
		
		$complexServise = new ComplexRequest(time());
		$complexServise->addDocumentType(new DocumentTypes(DocumentTypes::BUY));
		$complexServise->addEmail('test@test.ru');
		$complexServise->addPhone('79050000000');
		$complexServise->addPlace('www.test.ru');
		$complexServise->addTaxMode(new TaxModes($this->taxMode));
		$complexServise->addLine($line);
		$complexServise->addNonCash(10.00);

		$response = new ComplexResponse($client->sendRequest($complexServise));
		
		$this->assertTrue($response->isValid());
	}
}
