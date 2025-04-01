<?php

namespace Drupal\registro_usuario\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Drupal\registro_usuario\Service\Usuarios;

class RegistroUsuariosController extends ControllerBase {
  protected $usuarios;

  public function __construct(Usuarios $usuarios) {
    $this->usuarios = $usuarios;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('registro_usuario.usuarios')
    );
  }

  public function mostrarUsuarios() {
    return [
      '#markup' => '<h1>' . $this->usuarios->mensajePersonalizado() . '</h1>',
      '#markup' => $this->usuarios->listaUsuarios(),
    ];
  }
}