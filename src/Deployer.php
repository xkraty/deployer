<?php
/* (c) Anton Medvedev <anton@elfet.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deployer;

use Deployer\Console\TaskCommand;
use Deployer\Server\GroupCollection;
use Deployer\Server\ServerCollection;
use Deployer\Task\Scenario\ScenarioCollection;
use Deployer\Task\TaskCollection;
use Symfony\Component\Console\Application as Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Deployer
{
    /**
     * Global instance of deployer. It's can be accessed only after constructor call.
     * @var Deployer
     */
    private static $instance;

    /**
     * @var Console
     */
    private $console;

    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var TaskCollection
     */
    private $tasks;

    /**
     * @var ScenarioCollection
     */
    private $scenarios;

    /**
     * @var ServerCollection
     */
    private $servers;

    /**
     * @var GroupCollection
     */
    private $serverGroups;
    
    /**
     * @param Console $console
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function __construct(Console $console, InputInterface $input, OutputInterface $output)
    {
        $this->console = $console;
        $this->input = $input;
        $this->output = $output;
        $this->tasks = new TaskCollection();
        $this->scenarios = new ScenarioCollection();
        $this->servers = new ServerCollection();
        $this->serverGroups = new GroupCollection();
        self::$instance = $this;
    }

    /**
     * @return Deployer
     */
    public static function get()
    {
        return self::$instance;
    }

    /**
     * Run console application.
     */
    public function run()
    {
        $this->transformTasksToConsoleCommands();

        $this->console->run($this->input, $this->output);
    }

    /**
     * Transform tasks to console commands. Run it before run of console app.
     */
    public function transformTasksToConsoleCommands()
    {
        foreach ($this->tasks as $name => $task) {
            $this->console->add(new TaskCommand($name, $task, $this));
        }
    }

    /**
     * @return InputInterface
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @return OutputInterface
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @return Console
     */
    public function getConsole()
    {
        return $this->console;
    }

    /**
     * @return TaskCollection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @return ScenarioCollection
     */
    public function getScenarios()
    {
        return $this->scenarios;
    }

    /**
     * @return ServerCollection
     */
    public function getServers()
    {
        return $this->servers;
    }

    /**
     * @return GroupCollection
     */
    public function getServerGroups()
    {
        return $this->serverGroups;
    }
}
