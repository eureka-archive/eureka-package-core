<?php

/*
 * Copyright (c) Deezer
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Package\Core\Component\Twig;

/**
 * Class Twig
 *
 * @author Romain Cottard
 */
class Twig
{
    /** @var \Twig_Loader_Filesystem $twigLoader */
    private $twigLoader;

    /** @var \Eureka\Package\Core\Component\Twig\TwigHelper */
    private $helper;

    /** @var array $config */
    private $config = [];

    /**
     * Twig constructor.
     *
     * @param  \Twig_Loader_Filesystem $twigLoader
     * @param  \Eureka\Package\Core\Component\Twig\TwigHelper $helper
     * @param  array $config
     * @throws \Twig_Error_Loader
     */
    public function __construct(\Twig_Loader_Filesystem $twigLoader, TwigHelper $helper, array $config = [])
    {
        $this->twigLoader = clone $twigLoader;

        foreach ($config['theme'] as $name => $path) {
            $this->twigLoader->addPath($path, $name);
        }

        $this->helper = $helper;
        $this->config = $config;
    }

    /**
     * @return \Twig_Loader_Filesystem
     */
    public function getTwigLoader()
    {
        return $this->twigLoader;
    }

    /**
     * @return \Twig_Environment
     */
    public function getEnvironment()
    {
        $cache = false;
        if (isset($this->config['cache']['enabled']) && isset($this->config['cache']['path']) && $this->config['cache']['enabled']) {
            $cache = $this->config['cache']['path'];
        }

        $twig = new \Twig_Environment($this->twigLoader, [
            'debug'   => $this->config['debug'],
            'cache'   => $cache,
            'charset' => $this->config['charset'],
        ]);

        foreach ($this->helper->getCallbackFunctions() as $name => $callback) {
            $twig->addFunction(new \Twig_SimpleFunction($name, $callback));
        }

        return $twig;
    }
}
