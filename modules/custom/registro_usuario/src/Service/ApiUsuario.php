<?php

namespace Drupal\registro_usuario\Service;

use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsuarioApiService {
    /**
     * Obtiene la información del usuario por ID.
     *
     * @param int $id El ID del usuario.
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * Respuesta JSON con los datos del usuario.
     */
    public function obtenerUsuarioPorId($id) {
        $db = Database::getConnection();
        $consulta = $db->select('registro_usuario_datos', 'RUD')
            ->fields('RUD', ['id', 'nombre', 'email', 'creado'])
            ->condition('id', $id)
            ->execute()
            ->fetchAssoc();
        
        if ($consulta) {
            $usuario = [
                'usuario_id' => $consulta['id'],
                'nombre_completo' => $consulta['nombre'],
                'correo_electronico' => $consulta['email'],
                'fecha_registro' => date('Y-m-d H:i:s', $consulta['creado']),
            ];
            return new JsonResponse($usuario);
        } else {
            return new JsonResponse(['error' => 'Usuario no encontrado'], 404);
        }
    }
}
