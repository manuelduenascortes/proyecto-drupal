<?php

namespace Drupal\mi_formulario\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;

/**
 * Define un formulario que almacena datos en la base de datos.
 */
class MiFormulario extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mi_formulario_bloque';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['nombre'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Nombre'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Guardar'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $nombre = $form_state->getValue('nombre');
    
    // Insertar en la base de datos.
    $connection = Database::getConnection();
    $connection->insert('mi_formulario_datos')
      ->fields([
        'nombre' => $nombre,
        'creado' => time(),
      ])
      ->execute();

    \Drupal::messenger()->addMessage($this->t('El nombre "@nombre" ha sido guardado.', ['@nombre' => $nombre]));
  }
}