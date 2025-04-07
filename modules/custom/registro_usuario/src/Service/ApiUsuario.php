<?php

namespace Drupal\registro_usuario\Service;

use Drupal\Core\Database\Database;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiUsuario {
    use StringTranslationTrait;
    /**
    * Obtiene contenido basado en el ID.
    *
    * @param int $id El ID del contenido.
    *
    * @return \Symfony\Component\HttpFoundation\JsonResponse
    * Un objeto JsonResponse con el contenido.
    */
  public function datosUsuario($id) {
    $connection = Database::getConnection();
    $query = $connection->select('registro_usuario_datos');
    $query->fields('registro_usuario_datos', ['id', 'nombre', 'email', 'creado']);
    $query->condition('id', $id);
    $result = $query->execute()->fetchAssoc();

    if ($result) {
        $usuario = [
            'id' => $result['id'],
            'nombre' => $result['nombre'],
            'email' => $result['email'],
            'creado' => date('Y-m-d H:i:s', $result['creado']),            
        ];
        return new JsonResponse($usuario);
    } else {
        return new JsonResponse(['mensaje' => 'Usuario no encontrado'], 404);
    }
    }
}