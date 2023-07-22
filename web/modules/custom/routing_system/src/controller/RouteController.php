<?php

namespace Drupal\routing_system\controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Show a custom text in the route.
 */
class RouteController extends ControllerBase {

  /**
   * Show text at the route.
   */
  public function myContent() {
    return [
      "#type" => "markup",
      "#markup" => "Hello World!",
    ];
  }

}
