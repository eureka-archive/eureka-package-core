<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Package\Core\Component\Carousel;

/**
 * Class Carousel
 *
 * @author Romain Cottard
 */
class Carousel
{
    private $id = '';
    private $isEnabledControls = true;
    private $controls = null;
    private $items = [];

    public function __construct($id)
    {
        $this->id = (string) $id;
        $this->controls = new Controls();
    }

    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    public function addItem($item)
    {
        $this->item[] = $item;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getControls()
    {
        return $this->controls;
    }
}
