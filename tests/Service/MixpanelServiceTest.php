<?php
declare(strict_types = 1);

namespace DL\MixpanelBundle\Tests\Service;

use DL\MixpanelBundle\Service\MixpanelService;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

/**
 * Test the behaviour of the Mixpanel service.
 *
 * @package DL\MixpanelBundle\Tests\Service
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class MixpanelServiceTest extends TestCase
{
    const TOKEN = 'testtoeken';

    public function testGivenThatDefaultValuesAreProvidedForTheMixpanelServiceThenAnInstanceWillBeGeneratedSuccessfully(): void
    {
        $client = (new MixpanelService(self::TOKEN, []))->getClient();

        $this->assertNotNull($client);
        $this->assertInstanceOf(\Mixpanel::class, $client);
        $this->assertInstanceOf(\Producers_MixpanelPeople::class, $client->people);
        $this->assertEquals(self::TOKEN, $client->people->getToken());
        $this->assertAttributeEquals(Assert::readAttribute($client, '_defaults'), '_options', $client);
    }

    public function testGivenThatCustomValuesAreProvidedForTheMixpanelServiceThenAnInstanceWillBeGeneratedSuccessfully(): void
    {
        $client = (new MixpanelService(self::TOKEN, [
            'test_parameter' => 'testValue',
        ]))->getClient();

        $this->assertNotNull($client);
        $this->assertInstanceOf(\Mixpanel::class, $client);
        $this->assertInstanceOf(\Producers_MixpanelPeople::class, $client->people);
        $this->assertEquals(self::TOKEN, $client->people->getToken());

        $options = Assert::readAttribute($client, '_options');
        $this->assertArrayHasKey('test_parameter', $options);
        $this->assertEquals('testValue', $options['test_parameter']);
    }
}
