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
    /**
     * CoreController constructor.
     *
     * @param \Psr\Container\ContainerInterface $container
     * @param \Eureka\Component\Config\Config $config
     * @param \Eureka\Component\Routing\RouteInterface $route
     * @param \Psr\Http\Message\ServerRequestInterface|null $request
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function __construct(ContainerInterface $container, Config $config, RouteInterface $route, ServerRequestInterface $request = null)
    {
        parent::__construct($container, $config, $route, $request);

        $this
            ->initMenu()
            ->initMeta()
            ->initTheme()
        ;
    }

    /**
     * @return $this
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    protected function initMenu()
    {
        $currentRoute = $this->getCurrentRoute();
        $config = $this->getConfig()->get('app.menu');

        $menu = new Menu();
        foreach ($config as $data) {
            $routeUri = isset($data['route']) ? $this->getRoute($data['route'])->getUri() : '#';
            $item = new MenuItem($data['label']);
            $item
                ->setUri($routeUri)
                ->setIcon(Helper::issetget($data['icon']))
                ->setIsActive(true)
            ;

            if (!empty($data['children'])) {
                $submenu = new Menu();
                foreach ($data['children'] as $subData) {
                    $routeUri   = isset($data['route']) ? $this->getRoute($data['route'])->getUri() : '#';
                    $subItem = new MenuItem($subData['label']);
                    $subItem
                        ->setIsDivider((bool) Helper::issetget($subData['divider'], false))
                        ->setUri($routeUri)
                        ->setIcon(Helper::issetget($subData['icon']))
                        ->setIsActive($currentRoute->getUri() === $routeUri)
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
        /** @var \Eureka\Package\Core\Component\Twig\Twig $twigService */
        $twigService = $this->getContainer()->get('twig.service');
        $twig = $twigService->getEnvironment();

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
