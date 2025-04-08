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
    $connection = Database::getConnection();
    $query = $connection->select('registro_usuario_datos', 'RUD')
      ->fields('RUD', ['id', 'nombre', 'creado'])
      ->orderBy('RUD.id', 'DESC')
      ->range(0, 5); // Solo los 5 últimos usuarios registrados
    $result = $query->execute()->fetchAll();

    if (!empty($result)) {
      $message = 'Últimos cinco usuarios registrados:';
      foreach ($result as $record) {
        // Mostrar la ID del usuario, nombre y fecha de registro
        $message .= '<br>ID: ' . $record->id . ' - Nombre: ' . $record->nombre . '. Registrado: ' . date('Y-m-d h:i:s', $record->creado) . '.';
      }
      return [
        '#markup' => $this->t($message),
      ];
    } else {
      return [
        '#markup' => $this->t('No se encontraron usuarios registrados.'),
      ];
    }
  }
}

