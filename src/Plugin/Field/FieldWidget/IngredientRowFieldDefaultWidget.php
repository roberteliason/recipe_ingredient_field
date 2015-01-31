<?php

/**
 * @file
 * Contains Drupal\recipe_ingredient_field\Plugin\Field\FieldWidget\IngredientRowFieldDefaultWidget.
 */

namespace Drupal\recipe_ingredient_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'recipe_ingredient_field_default' widget.
 *
 * @FieldWidget(
 *   id = "recipe_ingredient_field_default",
 *   module = "recipe_ingredient_field",
 *   label = @Translation("Ingredient row default"),
 *   field_types = {
 *     "recipe_ingredient_field"
 *   }
 * )
 */
class IngredientRowFieldDefaultWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'placeholder_ingredient' => '',
      'placeholder_unit' => '',
      'placeholder_amount' => '',
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['placeholder_ingredient'] = array(
      '#type' => 'textfield',
      '#title' => t('Ingredient placeholder'),
      '#default_value' => $this->getSetting('placeholder_ingredient'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    );
    $element['placeholder_unit'] = array(
      '#type' => 'textfield',
      '#title' => t('Unit placeholder'),
      '#default_value' => $this->getSetting('placeholder_unit'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    );
    $element['placeholder_amount'] = array(
      '#type' => 'textfield',
      '#title' => t('Amount placeholder'),
      '#default_value' => $this->getSetting('placeholder_amount'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    );
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = array();

    $placeholder_color = $this->getSetting('placeholder_ingredient');
    $placeholder_unit = $this->getSetting('placeholder_unit');

    if (!empty($placeholder_ingredient)) {
      $summary[] = t('Color placeholder: @placeholder_ingredient', array('@placeholder_ingredient' => $placeholder_ingredient));
    }

    if (!empty($placeholder_unit)) {
      $summary[] = t('Unit placeholder: @placeholder_unit', array('@placeholder_unit' => $placeholder_unit));
    }

    if (!empty($placeholder_amount)) {
      $summary[] = t('Amount placeholder: @$placeholder_amount', array('@$placeholder_amount' => $placeholder_amount));
    }

    if (empty($summary)) {
      $summary[] = t('No placeholder');
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['ingredient'] = array(
      '#title' => t('Ingredient'),
      '#type' => 'textfield',
      '#maxlength' => 50,
      '#size' => 40,
      '#required' => $element['#required'],
      '#default_value' => isset($items[$delta]->ingredient) ? $items[$delta]->ingredient : NULL,
    );

    $element['unit'] = array(
      '#title' => t('Unit'),
      '#type' => 'textfield',
      '#maxlength' => 20,
      '#size' => 15,
      '#required' => $element['#required'],
      '#default_value' => isset($items[$delta]->unit) ? $items[$delta]->unit : NULL,
    );

    $element['amount'] = array(
      '#title' => t('Amount'),
      '#type' => 'textfield',
      '#maxlength' => 10,
      '#size' => 10,
      '#required' => $element['#required'],
      '#default_value' => isset($items[$delta]->amount) ? $items[$delta]->amount : NULL,
    );

    return $element;
  }

}
