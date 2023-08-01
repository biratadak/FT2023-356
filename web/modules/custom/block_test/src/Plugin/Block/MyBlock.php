<?php

namespace Drupal\block_test\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides testing block.
 *
 * @Block(
 *  id = "my_custom_block",
 *  admin_label = @Translation("Custom Block"),
 *  category = @Translation("custom block")
 * )
 */
class MyBlock extends BlockBase implements ContainerFactoryPluginInterface {
  /**
   * Contains the custom service object.
   *
   * @var Drupal\block_test\Plugin\Block\MyBlockservice
   */
  protected $service;

  /**
   * Injecting dependencies for service.
   */
  public function __construct(array $configuration, mixed $plugin_id, mixed $plugin_definition, mixed $service) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->service = $service;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('block_test.greet_hello')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $userName = $this->service->getName();
    return [
      '#prefix' => '<h1>',
      '#markup' => $this->t('Welcome @user!', ['@user' => $userName]),
      '#suffix' => '</h1>',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function access(AccountInterface $account, $return_as_object = FALSE) {
    return AccessResult::allowed();
  }

}
