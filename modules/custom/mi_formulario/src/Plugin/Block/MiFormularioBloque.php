<?php

namespace Drupal\mi_formulario\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Define un bloque con un formulario.
 *
 * @Block(
 *   id = "MiFormularioBloque",
 *   admin_label = @Translation("Bloque con Formulario para guardar datos"),
 * )
 */
class MiFormularioBloque extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    return \Drupal::formBuilder()->getForm('Drupal\mi_formulario\Form\MiFormulario');
  }
}