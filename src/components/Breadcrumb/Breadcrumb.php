<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Package\Core\Component\Breadcrumb;

/**
 * Breadcrumb class
 *
 * @author  Romain Cottard
 */
class Breadcrumb implements \Iterator, \Countable
{
    /** @var int $index Current index key. */
    private $index = 0;

    /** @var int $count Number of element in breadcrumb */
    private $count = 0;

    /** @var BreadcrumbItem[] $collection */
    private $collection = array();

    /**
     * Add item.
     *
     * @param BreadcrumbItem $item
     * @return $this
     */
    public function add(BreadcrumbItem $item)
    {
        $this->collection[$this->count] = $item;

        $this->count++;

        return $this;
    }

    /**
     * Check if is the last element of breadcrumb.
     *
     * @return bool
     */
    public function isLast()
    {
        return ($this->index === ($this->count - 1));
    }

    /**
     * Check if is the first element of breadcrumb.
     *
     * @return bool
     */
    public function isFirst()
    {
        return ($this->index === 0);
    }

    /**
     * Current iterator method.
     *
     * @return BreadcrumbItem
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
