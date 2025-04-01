<?php

namespace Drupal\mi_modulo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Define un formulario simple dentro de un bloque.
 */
class MiFormularioPrimero extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mi_bloque_formulario';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['nombre'] = [
      '#type' => 'textfield',
      '#title' => $this->t('<h1>Escribe tu nombre.</h1>'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Enviar'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::messenger()->addMessage($this->t('¡Felicidades, @nombre, has creado un formulario!', ['@nombre' => $form_state->getValue('nombre')]));
  }
}