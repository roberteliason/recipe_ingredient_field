<?php

/**
 * @file
 * Contains Drupal\recipe_ingredient_field\Plugin\Field\FieldType\IngredientRowFieldItem.
 */

namespace Drupal\recipe_ingredient_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'recipe_ingredient_field' field type.
 *
 * @FieldType(
 *   id = "recipe_ingredient_field",
 *   label = @Translation("Ingredient"),
 *   description = @Translation("Store amount of an ingredient for a recipe"),
 *   default_widget = "recipe_ingredient_field_default",
 *   default_formatter = "recipe_ingredient_field_text"
 * )
 */
class IngredientRowFieldItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'ingredient' => array(
          'description' => t('The ingredient'),
          'type' => 'varchar',
          'length' => 50,
          'not null' => FALSE,
        ),
        'unit' => array(
          'description' => t('The unit of measurement'),
          'type' => 'varchar',
          'length' => 20,
          'not null' => FALSE,
        ),
        'amount' => array(
          'description' => t('The number of units'),
          'type' => 'varchar',
          'length' => 10,
          'not null' => FALSE,
        ),
      ),
      'indexes' => array(
        'color' => array('ingredient'),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['ingredient'] = DataDefinition::create('string')
      ->setLabel(t('Ingredient'));

    $properties['unit'] = DataDefinition::create('string')
      ->setLabel(t('Unit'));

    $properties['amount'] = DataDefinition::create('string')
      ->setLabel(t('Amount'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('ingredient')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    $element = array();

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    return '';
  }

}
