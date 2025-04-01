<?php

namespace Drupal\primer_modulo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Drupal\primer_modulo\Service\MiServicio;

class PrimerModuloController extends ControllerBase {
  protected $miServicio;

  public function __construct(MiServicio $miServicio) {
    $this->miServicio = $miServicio;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('primer_modulo.mi_servicio')
    );
  }

  public function mostrarMensaje() {
    return [
      '#markup' => '<h1>' . $this->miServicio->mensajePersonalizado() . '</h1>',
    ];
  }

  public function pruebaLogger() {
    \Drupal::logger('primer_modulo')->notice('Este es un mensaje de prueba en el log.');
    \Drupal::logger('primer_modulo')->warning('Este es un mensaje de advertencia.');
    \Drupal::logger('primer_modulo')->error('Este es un mensaje de error.');

    return new Response("<h1>Mensajes registrados en el log.</h1>");
  }

}