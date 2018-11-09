<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use AppBundle\Entity\Comentario;

class ComentarioController extends Controller {
    
    // se trata de un servicio web
    public function cargarMasComentariosAction(Request $request, $id_noticia, $ultimo_comentario) {
        $noticia = $this->getDoctrine()->getManager()->getRepository(Noticia::class)->buscar($id_noticia);
        $comentarios = $this->getDoctrine()->getManager()->getRepository(Comentario::class)->buscarListaN($noticia, $ultimo_comentario, 3);

        // return --> json con los comentarios

    }   

	// se trata de un servicio web
	public function comentarAction(Request $request, $id, $categoria) {

		// creamos el comentario nuevo
		$comentario = new Comentario();

		// creamos el formulario que va a manejar la info para crear el nuevo comentario
        $form = $this->createForm(ComentarioType::class, $comentario);
        $form->handleRequest($request);

        // si el formulario se ha enviado y es válido...
        if ($form->isSubmitted() && $form->isValid()) {

        	// obtenemos la info pasada del formulario
        	$comentario = $form->getData();

        	// añadiendo más info al comentario
        	$comentario->setFecha(new \Datetime);
        	$comentario->setNoticia($noticia);

        	// se actualiza el cmoentario en la BD
            $em = $this->getDoctrine()->getManager();
            $em->persist($comentario);            
            $em->flush();

        }
    }    

}
