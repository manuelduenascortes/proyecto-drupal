<?php

public function mensajeListaUsuarios() {
    return "Aquí están los usuarios registrados en el sistema.";
}

public function listarUsuariosRecientes() {
    $connection = Database::getConnection();
    $query = $connection->select('registro_usuario_datos', 'RUD')
        ->fields('RUD', ['id', 'nombre', 'email', 'creado'])
        ->orderBy('creado', 'DESC')
        ->range(0, 10);
    
    $result = $query->execute()->fetchAll();
    
    if (!empty($result)) {
        $usuarios = [];
        foreach ($result as $record) {
            $usuarios[] = [
                'id' => $record->id,
                'nombre' => $record->nombre,
                'email' => $record->email,
                'fecha_registro' => date('Y-m-d H:i:s', $record->creado),
            ];
        }
        
        return new JsonResponse($usuarios);
    } else {
        return new JsonResponse(['mensaje' => 'No se encontraron usuarios registrados.'], 404);
    }
}
