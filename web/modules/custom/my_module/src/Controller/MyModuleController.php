<?php

namespace Drupal\my_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;

/**
 * Show hello message to the user.
 */
class MyModuleController extends ControllerBase {

  /**
   * Gets current user and shows greet message.
   */
  public function content() {
    $account = User::load(\Drupal::currentUser()->id());
    return [
      '#type' => 'markup',
      '#markup' => ('Hello,' . $account->getAccountName()),
    ];
  }

}
