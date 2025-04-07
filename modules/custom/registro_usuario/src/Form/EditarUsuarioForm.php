<?php

namespace Drupal\registro_usuario\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\user\Entity\User;

/**
 * Define un formulario que almacena datos en la base de datos.
 */
class EditarUsuarioForm extends FormBase {

    protected $datosUsuario;

    public function getFormId() {
        return 'editar_usuario_form';
      }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state, array $datosUsuario = NULL) {
        $this->datosUsuario = $datosUsuario;

        $form['#attached']['library'][] = 'tema_miniproyecto/estilos';
        $form['#attached']['library'][] = 'tema_miniproyecto/scripts';
        
        $form['nombre'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Nombre'),
            '#default_value' => $this->datosUsuario ? $this->datosUsuario['nombre'] : '',
            '#required' => TRUE,
          ];
      
          $form['email'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Correo electrónico'),
            '#default_value' => $this->datosUsuario ? $this->datosUsuario['email'] : '',
            '#required' => TRUE,
          ];
    
          $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Guardar'),
          ];
      
          return $form;
        }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $nombre = $form_state->getValue('nombre');
        $email = $form_state->getValue('email');
        
        $connection = Database::getConnection();
        $query = $connection->select('registro_usuario_datos', 'RUD')
                ->fields('RUD', ['email']);
        $result = $query->execute()->fetchAll();
        foreach ($result as $record) {
            if ($email === $record->email) {
                \Drupal::messenger()->addError($this->t('El correo electrónico ya está en uso.'));
            return;
            } else {
              $connection->update('registro_usuario_datos')
              ->fields([
                  'nombre' => $nombre,
                  'email' => $email,
              ])
              ->condition('id', $this->datosUsuario['id'])
              ->execute();
            }
        }

    \Drupal::messenger()->addMessage($this->t('Felicidades, @nombre. Tus nuevos datos han sido registrados.', ['@nombre' => $nombre]));
    \Drupal::logger('Usuario Editado')->notice($this->t('Se han editado los datos del usuario con correo electrónico: @email.', ['@email' => $email]));
    
    $form_state->setRedirect('<front>');
  }
}