<?php

use Klein\Klein;
use Klein\Request;
use Klein\Response;
use Klein\ServiceProvider;

final class PortfolioRouter implements IRouter
{

    /**
     * @param Klein $klein
     */
    public function create(Klein $klein)
    {
        $klein->respond(function (Request $request, Response $response, ServiceProvider $service) {

            /** @var Smarty $smarty */
            $smarty = $service->smarty;
            $file = $service->viewDir . '/index.tpl';

            $smarty->assign($service->smartyParams);
            $smarty->display($file);
        });
    }
}