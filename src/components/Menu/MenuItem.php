<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Package\Core\Component\Menu;

/**
 * Class to set menu item.
 *
 * @author  Romain Cottard
 */
class MenuItem
{
    /** @var string $name Menu name */
    private $name = '';

    /** @var string $icon Menu icon */
    private $icon = '';

    /** @var string $uri Menu URI */
    private $uri = '';

    /** @var Menu|null $submenu Sub menu. */
    private $submenu = null;

    /** @var bool $isActive If is currently active */
    private $isActive = false;

    /** @var bool $isDivider If is divider */
    private $isDivider = false;

    /**
     * MenuItem constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->setName($name);
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Get Uri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Get submenu
     *
     * @return Menu|null
     */
    public function getSubmenu()
    {
        return $this->submenu;
    }

    /**
     * Get is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * Get is active.
     *
     * @return bool
     */
    public function isDivider()
    {
        return $this->isDivider;
    }

    /**
     * If has submenu with elements.
     *
     * @return bool
     */
    public function hasIcon()
    {
        return !empty($this->getIcon());
    }

    /**
     * If has submenu with elements.
     *
     * @return bool
     */
    public function hasSubmenu()
    {
        return ($this->submenu instanceof Menu) && $this->submenu->count() > 0;
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set icon.
     *
     * @param  string $icon
     * @return self
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Set uri
     *
     * @param  string $uri
     * @return self
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Set is Active
     *
     * @param  bool $isActive
     * @return self
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Set is divider
     *
     * @param  bool $isDivider
     * @return self
     */
    public function setIsDivider($isDivider)
    {
        $this->isDivider = $isDivider;

        return $this;
    }

    /**
     * Set submenu instance.
     *
     * @param  Menu $submenu
     * @return self
     */
    public function setSubmenu(Menu $submenu)
    {
        $this->submenu = $submenu;

        return $this;
    }
}
