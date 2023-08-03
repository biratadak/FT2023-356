<?php

namespace Drupal\block_test\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for welcome page.
 */
class WelcomeController extends ControllerBase {

  /**
   * Creates blank page for route.
   */
  public function content() {
    return [];
  }

}
