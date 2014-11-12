<?php
/* (c) Anton Medvedev <anton@elfet.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Deployer\Server;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testConfiguration()
    {
        $c = new Configuration('name', 'localhost', 80);
        
        $this->assertEquals('name', $c->getName());
        $this->assertEquals('new_name', $c->setName('new_name')->getName());
        
        $this->assertEquals('localhost', $c->getHost());
        $this->assertEquals('new_localhost', $c->setHost('new_localhost')->getHost());
        
        $this->assertEquals(80, $c->getPort());
        $this->assertEquals(8080, $c->setPort(8080)->getPort());
        
        $this->assertEquals('/home', $c->path('/home')->getPath());
        
        $this->assertEquals('user', $c->user('user', 'password')->getUser());
        $this->assertEquals('password', $c->getPassword());
        $this->assertEquals(Configuration::AUTH_BY_PASSWORD, $c->getAuthenticationMethod());
        
        $this->assertEquals('.config', $c->configFile('.config')->getConfigFile());
        $this->assertEquals(Configuration::AUTH_BY_CONFIG, $c->getAuthenticationMethod());
        
        $this->assertEquals((isset($_SERVER['HOME']) ? $_SERVER['HOME'] : '~') . '/.ssh/id_rsa.pub', $c->pubKey('~/.ssh/id_rsa.pub', '~/.ssh/id_rsa', 'pass')->getPublicKey());
        $this->assertEquals((isset($_SERVER['HOME']) ? $_SERVER['HOME'] : '~') . '/.ssh/id_rsa', $c->getPrivateKey());
        $this->assertEquals('pass', $c->getPassPhrase());
        $this->assertEquals(Configuration::AUTH_BY_PUBLIC_KEY, $c->getAuthenticationMethod());
        
        $this->assertEquals((isset($_SERVER['HOME']) ? $_SERVER['HOME'] : '~') . '/.pem', $c->pemFile('~/.pem')->getPemFile());
        $this->assertEquals(Configuration::AUTH_BY_PEM_FILE, $c->getAuthenticationMethod());
    }
}
