<?php

namespace Drupal\registro_usuario\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Define un bloque con un formulario.
 *
 * @Block(
 *   id = "registro_usuario_bloque",
 *   admin_label = @Translation("Formulario para registrar usuarios"),
 * )
 */

class RegistroUsuarioBloque extends BlockBase {
    /**
     * {@inheritdoc}
     */
    public function build() {
      return \Drupal::formBuilder()->getForm('Drupal\registro_usuario\Form\RegistroUsuarioForm');
    }
  }