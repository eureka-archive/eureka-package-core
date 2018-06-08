<?php

/*
 * Copyright (c) Deezer
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Package\Core\Component\Twig;

use Eureka\Component\Routing\Router;

/**
 * Class Helper
 *
 * @author Romain Cottard
 */
class TwigHelper
{
    /** @var \Eureka\Component\Routing\Router */
    private $router;

    /** @var array $hosts */
    private $hosts;

    /**
     * Helper constructor.
     *
     * @param  \Eureka\Component\Routing\Router $router
     * @param  array $hosts
     */
    public function __construct(Router $router, $hosts = [])
    {
        $this->hosts  = $hosts;
        $this->router = $router;
    }

    /**
     * @return array
     */
    public function getCallbackFunctions()
    {
        return [
            'path'  => [$this, 'path'],
            'image' => [$this, 'image'],
        ];
    }

    /**
     * @param  string $routeName
     * @param  array $params
     * @return string
     * @throws \Eureka\Component\Routing\Exception\RouteNotFoundException
     */
    public function path($routeName, $params = [])
    {
        return $this->router->get($routeName)->getUri($params);
    }

    /**
     * @param  string $filename
     * @param  string $package
     * @param  string $module
     * @param  string $vendor
     * @return string
     */
    public function image($filename, $package, $module = 'main', $vendor = 'eureka')
    {
        return '/cache/' . $vendor . '/' . $package . '/' . $module . '/img/' . $filename;
    }
}
