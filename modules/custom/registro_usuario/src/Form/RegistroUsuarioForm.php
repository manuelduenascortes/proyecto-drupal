<?php

namespace Drupal\registro_usuario\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;

/**
 * Define un formulario que almacena datos en la base de datos.
 */
class RegistroUsuarioForm extends FormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
      return 'registro_usuario_bloque';
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
  
      $form['email'] = [
        '#type' => 'textfield',
        '#title' => $this->t('email'),
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
    $connection->insert('registro_usuario_datos')
      ->fields([
        'nombre' => $nombre,
        'email' => $email,
        'creado' => time(),
      ])
      ->execute();

    \Drupal::messenger()->addMessage($this->t('Felicidades, "@nombre". Tu usuario ha sido registrado.', ['@nombre' => $nombre]));
  }
}