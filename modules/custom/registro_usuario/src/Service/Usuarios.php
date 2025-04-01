<?php

namespace Drupal\registro_usuario\Service;

use Drupal\Core\Database\Database;
use Drupal\Core\StringTranslation\StringTranslationTrait;

class Usuarios {
    use StringTranslationTrait;

    public function mensajePersonalizado() {
        return "Esta es la lista de usuarios registrados.";
    }

    public function listaUsuarios() {
        $connection = Database::getConnection();

        $query = $connection->select('registro_usuario_datos', 'RUD')
            ->fields('RUD', ['id', 'nombre', 'email']);

        $result = $query->execute()->fetchAll();

        if (!empty($result)) {
            $message = 'Lista de usuarios:';
            foreach ($result as $record) {
                $message .= '<br>Nombre: ' . $record->nombre . ', Email: ' . $record->email;
            }
            return ($this->t($message));
        } else {
            return ($this->t('No se encontraron usuarios registrados.'));
        }
    }
}