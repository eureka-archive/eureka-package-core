<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Package\Core\Component\Menu;

/**
 * Class to set menu form.
 *
 * @author  Romain Cottard
 */
class MenuForm
{
    /** @var string $name Menu name */
    private $template = '';

    /** @var array $params Form parameters */
    private $params = '';

    /**
     * BreadcrumbItem constructor.
     *
     * @param string $template
     * @param array  $params
     */
    public function __construct($template = '', $params = array())
    {
        $this->setTemplate($template);
        $this->setParams($params);
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Get params
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set template
     *
     * @param  string $template
     * @return self
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Set params.
     *
     * @param  array $params
     * @return self
     */
    public function setParams($params = array())
    {
        $this->params = $params;

        return $this;
    }
}
