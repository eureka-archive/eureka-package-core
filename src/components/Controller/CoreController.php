<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Package\Core\Component\Controller;

use Eureka\Component\Config\Config;
use Eureka\Component\Routing\RouteInterface;
use Eureka\Component\Http\Message\Response;
use Eureka\Kernel\Http\Controller\Controller as KernelController;
use Eureka\Kernel\Http\Utils\Helper;
use Eureka\Package\Core\Component\Menu\Menu;
use Eureka\Package\Core\Component\Menu\MenuItem;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class CoreController
 *
 * @author Romain Cottard
 */
class CoreController extends KernelController
{
    /** @var \Twig_Loader_Filesystem $twigLoader */
    private $twigLoader = null;

    /** @var callable[] $twigFunctions */
    private $twigFunctions = [];

    /** @var callable[] $twigFilters */
    private $twigFilters = [];

    /**
     * CoreController constructor.
     *
     * @param \Psr\Container\ContainerInterface $container
     * @param \Eureka\Component\Config\Config $config
     * @param \Eureka\Component\Routing\RouteInterface $route
     * @param \Psr\Http\Message\ServerRequestInterface|null $request
     * @throws \Twig_Error_Loader
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function __construct(ContainerInterface $container, Config $config, RouteInterface $route, ServerRequestInterface $request = null)
    {
        parent::__construct($container, $config, $route, $request);

        $this
            ->initTwig()
            ->initMenu()
            ->initMeta()
            ->initTheme()
        ;
    }

    /**
     * @return $this
     * @throws \Twig_Error_Loader
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    private function initTwig()
    {
        $this->twigLoader = $this->getContainer()->get('twig.loader');
        $this->twigLoader->addPath($this->config->get('app.twig.theme.layout'), 'layout');
        $this->twigLoader->addPath($this->config->get('app.twig.theme.template'), 'template');
        $this->twigLoader->addPath($this->config->get('app.twig.home.template'), 'home');

        return $this;
    }

    /**
     * @return \Twig_Loader_Filesystem
     */
    protected function getTwigLoader()
    {
        return $this->twigLoader;
    }


    /**
     * @return $this
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    protected function initMenu()
    {
        $config = $this->getConfig()->get('app.menu');

        $menu = new Menu();
        foreach ($config as $data) {
            $item = new MenuItem($data['label']);
            $item
                ->setUri($this->getRoute(Helper::issetget($data['route'], '#'))->getUri())
                ->setIcon(Helper::issetget($data['icon']))
                ->setIsActive(true)
            ;

            if (!empty($data['submenu'])) {
                $submenu = new Menu();
                foreach ($data['submenu'] as $subData) {
                    $subItem = new MenuItem($subData['label']);
                    $subItem
                        ->setIsDivider((bool) Helper::issetget($subData['divider'], false))
                        ->setUri($this->getRoute(Helper::issetget($subData['route'], '#'))->getUri())
                        ->setIcon(Helper::issetget($subData['icon']))
                        ->setIsActive(true)
                    ;
                    $submenu->add($subItem);
                }
                $item->setSubmenu($submenu);
            }
            $menu->add($item);
        }

        $this->addContext('menu', $menu);

        return $this;
    }

    /**
     * @return $this
     */
    protected function initMeta()
    {
        $meta = $this->getConfig()->get('app.meta');
        if (isset($meta['copyright']['year']) && $meta['copyright']['year'] === 'now') {
            $meta['copyright']['year'] = date('Y');
        }

        $this->addContext('meta', $meta);

        return $this;
    }

    /**
     * @return $this
     */
    protected function initTheme()
    {
        $this->addContext('theme', $this->getConfig()->get('app.theme'));

        return $this;
    }

    /**
     * @param  string $name
     * @param  callable $callable
     * @return $this
     */
    protected function addTwigFunction($name, callable $callable)
    {
        $this->twigFunctions[$name] = $callable;

        return $this;
    }

    /**
     * @param  string $name
     * @param  callable $callable
     * @return $this
     */
    protected function addTwigFilter($name, callable $callable)
    {
        $this->twigFilters[$name] = $callable;

        return $this;
    }

    /**
     * @param  string $template
     * @param  array $context
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    protected function render($template, $context = [])
    {
        $routes   = $this->getContainer()->get('router');
        $function = new \Twig_SimpleFunction('uri', function ($routeName, $params = []) use ($routes) {
            return $routes->get($routeName)->getUri($params);
        });

        $twig = new \Twig_Environment($this->twigLoader);
        $twig->addFunction($function);

        //~ Add functions to twig
        foreach ($this->twigFunctions as $name => $function) {
            $twig->addFunction( new \Twig_SimpleFunction($name, $function));
        }

        //~ Add functions to twig
        foreach ($this->twigFilters as $name => $function) {
            $twig->addFilter( new \Twig_SimpleFilter($name, $function));
        }

        return $twig->render($template, $this->getContext());
    }

    /**
     * @param  string $content
     * @return \Eureka\Component\Http\Message\Response
     */
    protected function getResponse($content)
    {
        $response = new Response();
        $response->getBody()->write($content);

        return $response;
    }
}
