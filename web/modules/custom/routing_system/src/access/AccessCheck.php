<?php

namespace Drupal\routing_system\access;

use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Checks custom access for the current user.
 */
class AccessCheck implements AccessInterface {

  /**
   * Checks Permisson for the user.
   *
   * If current user has 'access the custom page',
   *  permission then allow otherwise forbidden the access.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   Stores the user details and methods.
   *
   * @return \Drupal\Core\Access\AccessResult
   *   If user have permissoin return allowed() otherwise forbidden().
   */
  public function access(AccountInterface $account) {
    return ($account->hasPermission('access the custom page')) ? AccessResult::allowed() : AccessResult::forbidden();
  }

}
