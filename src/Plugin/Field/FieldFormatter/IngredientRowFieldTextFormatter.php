<?php

/**
 * @file
 * Contains Drupal\recipe_ingredient_field\Plugin\Field\FieldFormatter\IngredientRowFieldTextFormatter.
 */

namespace Drupal\recipe_ingredient_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'recipe_ingredient_field_text' formatter.
 *
 * @FieldFormatter(
 *   id = "recipe_ingredient_field_text",
 *   module = "recipe_ingredient_field",
 *   label = @Translation("An ingredient row as text"),
 *   field_types = {
 *     "recipe_ingredient_field",
 *   }
 * )
 */
class IngredientRowFieldTextFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'format' => 'string',
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements['format'] = array(
      '#type' => 'select',
      '#title' => t('Format'),
      '#options' => $this->getStringFormat(),
      '#default_value' => $this->getSetting('format'),
    );

    return $elements;
  }


  public function getStringFormat($format = NULL) {
    $formats = array();
    $formats['string'] = $this->t('String');
    if ($format) {
      return $formats[$format];
    }
    return $formats;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = array();

    $format = $this->getSetting('format');

    $summary[] = t('Format: @format', array(
      '@format' => $this->getStringFormat($format),
    ));

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {
    $format = $this->getSetting('format');

    foreach ($items as $delta => $item) {
      switch ($format) {
        case 'string':
          $output = $item->ingredient;
          break;
      }
      $elements[$delta] = array('#markup' => $output);
    }
    return $elements;
  }

}
