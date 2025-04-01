<?php

namespace Drupal\mi_modulo\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Define un bloque personalizado.
 *
 * @Block(
 *   id = "mi_bloque_personalizado",
 *   admin_label = @Translation("Mi Bloque Personalizado"),
 * )
 */
class MiBloque extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => '<p>Este es mi bloque personalizado en Drupal.</p>',
    ];
  }
}