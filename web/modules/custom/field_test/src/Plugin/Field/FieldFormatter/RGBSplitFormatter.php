<?php

namespace Drupal\field_test\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'RGB Split' formatter.
 *
 * @FieldFormatter(
 *   id = "rgb_split",
 *   label = @Translation("RGB Split Formatter"),
 *   field_types = {
 *     "rgb_item",
 *   }
 * )
 */
class RGBSplitFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    foreach ($items as $delta => $item) {
      $source = [
        '#theme' => 'snippets_default',
        '#value' => $item->value,
      ];
      $elements[$delta] = ['#markup' => \Drupal::service('renderer')->render($source)];
    }
    return $elements;
  }

}
