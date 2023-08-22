<?php

namespace Drupal\field_test\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'RGB' field type.
 *
 * @FieldType(
 *   id = "rgb_item",
 *   label = @Translation("RGB Colors"),
 *   description = @Translation("This field stores Color values for RGB."),
 *   default_widget = "rgb_combined",
 *   default_formatter = "rgb_combined",
 * )
 */
class RGBItem extends FieldItemBase {

  /**
   * {@inheritDoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value'   => [
          'type'     => 'varchar',
          'length'   => 7,
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('RGB value'))
      ->setDescription(t('Enter value for RGB hex value'));
    return $properties;
  }

}
