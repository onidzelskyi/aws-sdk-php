<?php
namespace Aws\Test;

use Aws\Api\Service;
use Aws\AwsCommand;
use GuzzleHttp\Event\Emitter;

/**
 * @covers Aws\AwsCommand
 */
class AwsCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testHasApi()
    {
        $emitter = new Emitter();
        $api = new Service([
            'operations' => [
                'foo' => []
            ]
        ]);

        $command = new AwsCommand(
            'foo',
            ['baz' => 'bar'],
            $api,
            $emitter
        );

        $this->assertInstanceOf('Aws\Api\Operation', $command->getOperation());
        $this->assertEquals('foo', $command->getName());
        $this->assertEquals('bar', $command['baz']);
        $this->assertSame($emitter, $command->getEmitter());
        $this->assertSame($api, $command->getApi());
    }
}