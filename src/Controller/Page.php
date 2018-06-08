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

class Page extends CoreController
{
    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @return \Eureka\Component\Http\Message\Response
     * @throws \Eureka\Component\Routing\Exception\ParameterException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function dynamic(RequestInterface $request)
    {
        $pageName = $this->getParameter('page_name');

        $this->addContext('pageContent', $pageName);
        $this->addContext('pageCarousel', '');
        $this->addContext('pageMenu', '');

        return $this->getResponse($this->render('@home/Dynamic.twig'));
    }
}
