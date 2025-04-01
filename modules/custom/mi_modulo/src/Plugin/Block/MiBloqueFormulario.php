<?php

namespace Drupal\mi_modulo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Define un bloque con un formulario.
 *
 * @Block(
 *   id = "mi_bloque_formulario",
 *   admin_label = @Translation("Bloque con Formulario"),
 * )
 */
class MiBloqueFormulario extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    return \Drupal::formBuilder()->getForm('Drupal\mi_modulo\Form\MiFormularioPrimero');
  }
}