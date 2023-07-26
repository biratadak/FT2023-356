<?php

namespace Drupal\block_test\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides testing block.
 *
 * @Block(
 *  id = "my_custom_block",
 *  admin_label = @Translation("Custom Block"),
 *  category = @Translation("custom block")
 * )
 */
class MyBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $userName = \Drupal::currentUser()->getAccountName();
    return [
      '#prefix' => '<h1>',
      '#markup' => $this->t('Welcome @user!', ['@user' => $userName]),
      '#suffix' => '</h1>',
    ];
  }

  /**
   * @inheritDoc
   */
  public function access(AccountInterface $account, $return_as_object = FALSE) {
    return AccessResult::allowed();
  }

}
