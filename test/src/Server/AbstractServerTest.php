<?php
/* (c) Anton Medvedev <anton@elfet.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deployer\Server;

class AbstractServerTest extends \PHPUnit_Framework_TestCase
{
    public function testServer()
    {
        $config = $this->getMockBuilder('Deployer\Server\Configuration')
            ->disableOriginalConstructor()
            ->getMock();
        $env = $this->getMock('Deployer\Server\Environment');

        $server = $this->getMockForAbstractClass('Deployer\Server\AbstractServer', [
            'name',
            $config,
            $env,
        ]);

        $this->assertEquals('name', $server->getName());
        $this->assertEquals($config, $server->getConfiguration());
        $this->assertEquals($env, $server->getEnvironment());
    }
}
