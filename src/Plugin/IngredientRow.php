<?php

/**
 * @file
 * Contains Drupal\recipe_ingredient_field\IngredientRow;
 */

namespace Drupal\recipe_ingredient_field;


class IngredientRow {

  /**
   * The name of the ingredient
   *
   * @var string
   */
  protected $ingredient;


  /**
   * The type of unit of measurement
   *
   * @var string
   */
  protected $unit;


  /**
   * The number of units of the ingredient
   *
   * @var string
   */
  protected $amount;


  public function __construct( $ingredient, $unit, $amount ) {
    $this->ingredient = $ingredient;
    $this->unit       = $unit;
    $this->amount     = $amount;
  }


  public function get_ingredient() {
    return $this->ingredient;
  }

  public function get_unit() {
    return $this->unit;
  }

  public function get_amount() {
    return $this->amount;
  }


  public function __toString() {
    return $this->amount . ' ' . $this->unit . ' ' . t( 'of' ) . ' ' . $this->ingredient;
  }

}