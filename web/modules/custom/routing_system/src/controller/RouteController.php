<?php

namespace Drupal\routing_system\controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\Routing\RouteCollection;

class RouteController extends ControllerBase{

    public function myContent () {
        return [
            "#type" =>"markup",
            "#markup" => "Hello World!",
        ];
    }
}