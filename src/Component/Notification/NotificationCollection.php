<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Package\Core\Component\Notification;

/**
 * Breadcrumb class
 *
 * @author  Romain Cottar
 */
class NotificationCollection implements \Iterator, \Countable
{
    /** @var int $index Current index item. */
    private $index = 0;

    /** @var int $count Number of notification */
    private $count = 0;

    /** @var NotificationInterface[] $collection */
    private $collection = array();

    /**
     * Add item.
     *
     * @param  NotificationInterface $item
     * @return self
     */
    public function add(NotificationInterface $item)
    {
        $this->collection[$this->count] = $item;

        $this->count++;

        return $this;
    }

    /**
     * Current iterator method.
     *
     * @return NotificationInterface
     */
    public function current()
    {
        return $this->collection[$this->index];
    }

    /**
     * Key iterator method.
     *
     * @return int
     */
    public function key()
    {
        return $this->index;
    }

    /**
     * Next iterator method.
     *
     * @return void
     */
    public function next()
    {
        $this->index++;
    }

    /**
     * Rewind iterator method.
     *
     * @return void
     */
    public function rewind()
    {
        $this->index = 0;
    }

    /**
     * Valid iterator method.
     *
     * @return bool
     */
    public function valid()
    {
        return ($this->index < $this->count);
    }

    /**
     * Count countable method.
     *
     * @return int
     */
    public function count()
    {
        return $this->count;
    }
}
