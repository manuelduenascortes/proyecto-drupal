<?php

namespace Drupal\registro_usuario\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Url;
use Drupal\registro_usuario\Form\EditarUsuarioForm;
use Drupal\Core\Database\Database;

class EditarUsuarioController extends ControllerBase {

    function editarUsuario($id) {
        $connection = Database::getConnection();
        $query = $connection->select('registro_usuario_datos');
        $query->fields('registro_usuario_datos', ['id', 'nombre', 'email']);
        $query->condition('id', $id);
        $datosUsuario = $query->execute()->fetchAssoc();

        if (!$datosUsuario) {
            $url = Url::fromRoute('<front>')->toString();
            return [
                '#markup' => $this->t('Usuario no encontrado. ' . '<p><a href="' . $url . '">Volver a la página principal</a></p>'),
            ];
        }

        $formObject = $this->formBuilder()->getForm(EditarUsuarioForm::class, $datosUsuario);      

        return [
            '#markup' => \Drupal::service('renderer')->render($formObject),
        ];
    }
}