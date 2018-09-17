<?php

namespace Platron\Starrys\tests\integration;

use Platron\Starrys\clients\PostClient;
use Platron\Starrys\data_objects\AgentData;
use Platron\Starrys\data_objects\GetPaymentOperatorData;
use Platron\Starrys\data_objects\Line;
use Platron\Starrys\data_objects\ProviderData;
use Platron\Starrys\data_objects\TransferOperatorData;
use Platron\Starrys\handbooks\AgentModes;
use Platron\Starrys\handbooks\DocumentTypes;
use Platron\Starrys\handbooks\PayAttributeTypes;
use Platron\Starrys\handbooks\Taxes;
use Platron\Starrys\services\ComplexRequest;
use Platron\Starrys\services\ComplexResponse;

class ComplexTest extends IntegrationTestBase
{
	public function testComplex()
	{
		$client = new PostClient($this->starrysApiUrl, $this->secretKeyPath, $this->certPath);
		$complexRequest = $this->createComplexRequest();
		$response = new ComplexResponse($client->sendRequest($complexRequest));
		$this->assertTrue($response->isValid());
	}

	/**
	 * @return Line
	 */
	private function createLine()
	{
		$line = new Line('Test product', 1, 10.00, new Taxes(Taxes::VAT10));
		$line->addPayAttribute(new PayAttributeTypes(PayAttributeTypes::FULL_PAID_WITH_GET_PRODUCT));

		$agentData = new AgentData('Test operation', '79050000000');
		$line->addAgentData($agentData);

		$line->addAgentModes(new AgentModes(AgentModes::PAYMENT_AGENT));
		$getPaymentOperatorData = new GetPaymentOperatorData('79050000001');
		$line->addGetPaymentOperatorData($getPaymentOperatorData);
		$providerData = new ProviderData('Test provider data', '7123456789', '79050000002');
		$line->addProviderData($providerData);
		$transferOperatorData = new TransferOperatorData(
			'Test transfer operator',
			'7123456781',
			'Test transfer operator address',
			'79050000003'
		);
		$line->addTransferOperatorData($transferOperatorData);
		return $line;
	}

	/**
	 * @return ComplexRequest
	 */
	private function createComplexRequest()
	{
		$line = $this->createLine();

		$complexRequest = new ComplexRequest(time());
		$complexRequest->addClientId('testClientId');
		$complexRequest->addDocumentType(new DocumentTypes(DocumentTypes::BUY));
		$complexRequest->addEmail('test@test.ru');
		$complexRequest->addPhone('79050000000');
		$complexRequest->addPlace('www.test.ru');
		$complexRequest->addTaxMode(new TaxModes($this->taxMode));
		$complexRequest->addLine($line);
		$complexRequest->addNonCash(10.00);
		return $complexRequest;
	}
}
