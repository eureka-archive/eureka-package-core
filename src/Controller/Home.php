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

class Home extends CoreController
{
    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @return \Eureka\Component\Http\Message\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index(RequestInterface $request)
    {
        return $this->getResponse($this->render('@home/Home.twig', ['menu' => []]));
    }
}
