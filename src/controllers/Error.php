<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Package\Core\Controller;

use Eureka\Package\Core\Component\Controller\CoreController;
use Psr\Http\Message\RequestInterface;

class Error extends CoreController
{
    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @param null $exception
     * @return \Eureka\Component\Http\Message\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function page404(RequestInterface $request, $exception = null)
    {
        return $this->getResponse($this->render('@home/Page404.twig'));
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @param $exception
     * @return \Eureka\Component\Http\Message\Response
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function page500(RequestInterface $request, $exception)
    {
        $this->addContext('exception', $exception);

        return $this->getResponse($this->render('@home/Page500.twig'));
    }
}
