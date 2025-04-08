<?php

namespace Drupal\registro_usuario\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\Database;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Define un bloque personalizado.
 *
 * @Block(
 *   id = "ultimos_usuarios_registrados_bloque",
 *   admin_label = @Translation("Últimos usuarios registrados"),
 * )
 */
class UltimosUsuariosRegistradosBloque extends BlockBase {
  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Establecer la conexión a la base de datos.
    $connection = Database::getConnection();
    
    // Hacer la consulta a la base de datos para obtener los últimos 5 usuarios.
    $query = $connection->select('registro_usuario_datos', 'RUD')
      ->fields('RUD', ['nombre', 'creado'])
      ->orderBy('RUD.id', 'DESC')
      ->range(0, 5);
    
    $result = $query->execute()->fetchAll();

    // Si hay resultados, crear el mensaje para mostrar los usuarios.
    if (!empty($result)) {
      $message = 'Últimos cinco usuarios registrados:';
      
      // Formatear los resultados con array_map.
      $formatted_users = array_map(function ($record) {
        return 'Nombre: ' . $record->nombre . '. Registrado: ' . date('Y-m-d h:i:s', $record->creado) . '.';
      }, $result);
      
      // Unir los resultados formateados en un solo mensaje.
      $message .= implode('<br>', $formatted_users);
      
      return [
        '#markup' => $this->t($message),
      ];
    } 
    // Si no hay resultados, mostrar mensaje alternativo.
    else {
      return [
        '#markup' => $this->t('No se encontraron usuarios registrados.'),
      ];
    }
  }
}
