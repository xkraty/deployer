<?php
/* (c) Anton Medvedev <anton@elfet.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deployer\Server;

abstract class AbstractServer implements ServerInterface
{
    /**
     * Server name.
     * @var string
     */
    private $name;

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var Environment
     */
    private $environment;

    /**
     * @param string $name
     * @param Configuration $configuration
     * @param Environment $environment
     */
    public function __construct($name, Configuration $configuration, Environment $environment)
    {
        $this->configuration = $configuration;
        $this->environment = $environment;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @return Enviroment
     */
    public function getEnvironment()
    {
        return $this->environment;
    }
    
    /**
     * Run shell command on remote server.
     * @param string $command
     * @return string Output of command.
     */
    abstract public function run($command);
    
    /**
     * Upload file to remote server.
     * @param string $local Local path to file.
     * @param string $remote Remote path where upload.
     */
    abstract public function upload($local, $remote);
    
    /**
     * Download file from remote server.
     * @param string $local Where to download file on local machine.
     * @param string $remote Which file to download from remote server.
     */
    abstract public function download($local, $remote);
}
