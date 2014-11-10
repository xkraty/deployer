<?php
/* (c) Anton Medvedev <anton@elfet.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deployer\Collection;

class Collection implements CollectionInterface
{
    public $collection = [];

    /**
     * {@inheritdoc}
     */
    public function get($name)
    {
        if ($this->has($name)) {
            return $this->collection[$name];
        } else {
            throw new \RuntimeException("Object `$name` does not exist.");
        }
    }

    /**
     * {@inheritdoc}
     */
    public function has($name)
    {
        return array_key_exists($name, $this->collection);
    }

    /**
     * {@inheritdoc}
     */
    public function set($name, $object)
    {
        $this->collection[$name] = $object;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->collection);
    }
}
