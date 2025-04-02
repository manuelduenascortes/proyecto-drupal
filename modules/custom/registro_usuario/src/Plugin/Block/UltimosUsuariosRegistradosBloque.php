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
 *   admin_label = @Translation("Ultimos usuarios registrados"),
 * )
 */
class UltimosUsuariosRegistradosBloque extends BlockBase {
    /**
     * {@inheritdoc}
     */
    public function build() {
        $connection = Database::getConnection();
        $query = $connection->select('registro_usuario_datos', 'RUD')
            ->fields('RUD', ['nombre', 'creado']);
    }
  }