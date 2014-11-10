<?php
/* (c) Anton Medvedev <anton@elfet.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deployer\Task;

use Deployer\Task\TaskInterface;

class Task implements TaskInterface
{
    /**
     * Task code.
     * @var callable
     */
    private $callback;

    /**
     * @param string $name Task name.
     * @param callable $callback Task code.
     */
    public function __construct(\Closure $callback)
    {
        $this->callback = $callback;
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        call_user_func($this->callback);
    }
}
