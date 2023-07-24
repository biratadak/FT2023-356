<?php

namespace Drupal\custom_config_form\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Fetchs and shows config data.
 */
class ShowConfigController extends ControllerBase {

  /**
   * Shows Greet to the user using congifFactory stored data.
   */
  public function showContent() {
    $conf = \Drupal::config('custom_config_form.admin_settings')->get();
    return [
      '#type' => 'html_tag',
      '#tag' => 'h1',
      '#value' => "hello " . $conf['name'],
    ];
  }

}
