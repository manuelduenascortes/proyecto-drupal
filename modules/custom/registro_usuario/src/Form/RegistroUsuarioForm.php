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
      $form['#attached']['library'][] = 'tema_miniproyecto/estilos';
      $form['#attached']['library'][] = 'tema_miniproyecto/scripts';
      
      $form['nombre'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Nombre'),
        '#required' => TRUE,
      ];
  
      $form['email'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Correo electrónico'),
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
    $email = $form_state->getValue('email');

    $connection = Database::getConnection();
    $query = $connection->select('registro_usuario_datos', 'RUD')
          ->fields('RUD', ['email']);
    $result = $query->execute()->fetchAll();
    foreach ($result as $record) {
      if ($email === $record->email) {
        $email = false;
        \Drupal::messenger()->addError($this->t('El correo electrónico ya está en uso.'));
      return;
      }
    }

    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

      if ($email === false) {
        \Drupal::messenger()->addError($this->t('Correo electrónico no válido.'));
      } else {       
        $connection = Database::getConnection();
        $connection->insert('registro_usuario_datos')
          ->fields([
            'nombre' => $nombre,
            'email' => $email,
            'creado' => time(),
          ])
          ->execute();

        \Drupal::messenger()->addMessage($this->t('Felicidades, @nombre. Tu usuario ha sido registrado.', ['@nombre' => $nombre]));
        \Drupal::logger('Nuevo Usuario')->notice($this->t('Se ha registrado un nuevo usuario con correo electrónico: @email.', ['@email' => $email]));
      }
  }
}