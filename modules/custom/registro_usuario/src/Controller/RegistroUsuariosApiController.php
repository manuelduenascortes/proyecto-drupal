<?php

namespace Drupal\registro_usuario\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\registro_usuario\Service\UsuarioApiService;

class RegistroUsuariosApiController extends ControllerBase {
    protected $apiusuario;

    public function __construct(UsuarioApiService $apiusuario) {
        $this->apiusuario = $apiusuario;
    }

    public static function create(ContainerInterface $container) {
        return new static(
            $container->get('registro_usuario.apiusuario')
        );
    }

    public function datosUsuario($id) {
        $datos = $this->apiusuario->obtenerUsuarioPorId($id);
        return $datos;
    }
}
