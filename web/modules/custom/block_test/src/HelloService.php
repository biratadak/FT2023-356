<?php

namespace Drupal\block_test;

use Drupal\Core\Session\AccountInterface;

/**
 * Custom service to get user current details.
 */
class HelloService {
  /**
   * Contains the current user object.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $user;

  /**
   * Initialise user object in global variable.
   */
  public function __construct(AccountInterface $user) {
    $this->user = $user;
  }

  /**
   * Returns the current user's name.
   *
   * @return string
   *   returns the user's name.
   */
  public function getName() {
    return $this->user->getAccountName();
  }

}
