<?php
/* (c) Anton Medvedev <anton@elfet.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deployer\Task;

use Deployer\Task\Scenario\ScenarioCollection;

class Scenario
{
    /**
     * @var string
     */
    private $taskName;

    /**
     * Scenario description.
     * @var string
     */
    private $description;

    /**
     * @var Scenario[]
     */
    private $after = [];

    /**
     * @var Scenario[]
     */
    private $before = [];

    /**
     * @param string $taskName
     */
    public function __construct($taskName)
    {
        $this->taskName = $taskName;
    }

    /**
     * {@inheritdoc}
     */
    public function getTasks()
    {
        return array_merge(
            $this->getBefore(),
            [$this->taskName],
            $this->getAfter()
        );
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set scenario description.
     * @param string $description
     * @return $this
     */
    public function desc($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param Scenario $task
     */
    public function addBefore(Scenario $task)
    {
        $this->before[] = $task;
    }

    /**
     * @param Scenario $task
     */
    public function addAfter(Scenario $task)
    {
        $this->after[] = $task;
    }

    /**
     * Get before tasks names.
     * @return string[]
     */
    protected function getBefore()
    {
        $tasks = [];
        foreach ($this->before as $scenario) {
            $tasks = array_merge($tasks, $scenario->getTasks());
        }
        return $tasks;
    }

    /**
     * Get after tasks names.
     * @return string[]
     */
    protected function getAfter()
    {
        $tasks = [];
        foreach ($this->after as $scenario) {
            $tasks = array_merge($tasks, $scenario->getTasks());
        }
        return $tasks;
    }
}
