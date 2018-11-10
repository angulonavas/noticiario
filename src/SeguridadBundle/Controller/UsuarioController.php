<?php

namespace SeguridadBundle\Controller;

use SeguridadBundle\Entity\Usuario;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class UsuarioController extends Controller {
    
    /**
    * @Route("/hola-mundo", name="hola_mundo")
    */
    public function nadaAction(Request $request) {

        return $this->render('@Seguridad/Default/index.html.twig', []);
    }
}
