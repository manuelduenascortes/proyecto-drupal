<?php

namespace Drupal\registro_usuario\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\registro_usuario\Service\ApiUsuario;

class RegistroUsuariosApiController extends ControllerBase {
    protected $apiusuario;

    public function __construct(ApiUsuario $apiusuario) {
        $this->apiusuario = $apiusuario;
    }

    public static function create(ContainerInterface $container) {
        return new static(
            $container->get('registro_usuario.apiusuario')
        );
    } 

    public function datosUsuario($id) {
        $datos = $this->apiusuario->datosUsuario($id);
        return $datos;
    }
}