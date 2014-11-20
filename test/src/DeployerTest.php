<?php
/* (c) Anton Medvedev <anton@elfet.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deployer;

use Deployer\Console\Application;

class DeployerTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $console = new Application();
        $input = $this->getMock('Symfony\Component\Console\Input\InputInterface');
        $output = $this->getMock('Symfony\Component\Console\Output\OutputInterface');
        $deployer = new Deployer($console, $input, $output);
        
        $this->assertEquals($deployer, Deployer::get());
    }
}
 