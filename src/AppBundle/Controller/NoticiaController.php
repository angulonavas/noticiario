<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use AppBundle\Entity\Categoria;
use AppBundle\Entity\Comentario;
use AppBundle\Entity\Noticia;
use AppBundle\Entity\Visita;

use AppBundle\Form\ComentarioType;

class NoticiaController extends Controller {

	// método público que se ejecuta cada vez que un usuario entra
    public function registrarVisitaAction(Request $request) {

        // obtenemos la sesión de usuario
        $session = $request->getSession();

        // Buscamos las cookies de sesión del usuario
        $cookies = $request->cookies; // se obtiene la cookie del request

        // Si existe la cookie visitante es que el usuario no es nuevo
        $visitante_nuevo = ($cookies->has('visitante')) ? 0 : 1;

        // si es la primera vez que se vista la página tras abrir el navegador...
        // nota: La variable de sesión sólo se elimina si se cierra el navegador.
        if (!$session->get('visitando')) {

            // creamos la variable de sesión para saber que ya está navegando a partir de ahora
            $session->set('visitando', 'ok');

            // Comprobamos si es primera visita del día...
            $visita = $this->getDoctrine()->getManager()->getRepository(Visita::class)->buscarFecha(new \DateTime);
            
            // Si no es primera visita...
            if ($visita) {

                // si es visitante nuevo...
                if ($visitante_nuevo) { 
                    $visita->setNuevo($visita->getNuevo()+1);

                // si no es visitante nuevo...
                } else { 
                    $visita->setHabitual($visita->getHabitual()+1); 
                }

            // Si es primera visita...
            } else {

                // Creamos la visita por defecto
                $visita = new Visita();
                $visita->setHabitual(0);
                $visita->setNuevo(0);
                $visita->setFecha(new \DateTime());

                if ($visitante_nuevo) $visita->setNuevo(1);
                else $visita->setHabitual(1);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($visita);
            $em->flush();

        }

        // devolvemos si existe o no la cookie
        return ($visitante_nuevo) ? false : true;
    }

    // es un servicio web que devuelve N noticias siguiente a $ultima_noticia
    public function cargarMasNoticiasAction(Request $request, $desc_categoria, $ultima_noticia) {
        
        $categoria = $this->getDoctrine()->getManager()->getRepository(Categoria::class)->buscarDescripcion($desc_categoria);
        $noticias = $this->getDoctrine()->getManager()->getRepository(Noticia::class)->buscarListaN($categoria, $ultima_noticia, 3);

        // return --> json con las noticias
    }      

    /**
     * @Route("/", name="raiz")
     */
    public function raizAction(Request $request) {

        $desc_categoria = 'España';
        return $this->listarNoticiasAction($request, $desc_categoria);
    }

    /**
     * @Route("/{desc_categoria}/{id_noticia}", name="noticia_completa")
     */
    public function buscarNoticiaAction(Request $request, $id_noticia, $desc_categoria) {

        $existeCookie = $this->registrarVisitaAction($request);

        $categoria = $this->getDoctrine()->getManager()->getRepository(Categoria::class)->buscarDescripcion($desc_categoria);
        $noticia = $this->getDoctrine()->getManager()->getRepository(Noticia::class)->buscar($id_noticia);
        $comentarios = $this->getDoctrine()->getManager()->getRepository(Comentario::class)->buscarListaN($noticia, 0, 3);
        $categorias = $this->getDoctrine()->getManager()->getRepository(Categoria::class)->buscarLista();
 
        // creamos el comentario nuevo
        $comentario = new Comentario();

        // creamos el formulario que va a manejar la info para crear el nuevo comentario
        $form = $this->createForm(ComentarioType::class, $comentario);
        $form->handleRequest($request);

        $mensaje = [
            'estado' => 'vacio',
            'descripcion' => '',
        ];

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

            $mensaje['estado'] = 'ok';
            $mensaje['descripcion'] = 'El comentario ha sido enviado con éxito!';

            // volvemos a cargar los comentarios
            $comentarios = $this->getDoctrine()->getManager()->getRepository(Comentario::class)->buscarListaN($noticia, 0, 3);

        } else if ($form->isSubmitted() && !$form->isValid()) {
            $mensaje['estado'] = 'error';
            $mensaje['descripcion'] = 'Hay errores en el envío. Compruébalo!';            
        }

        $response = $this->render('pagina_noticia.html.twig', [
            'categoria' => $categoria,
            'noticia' => $noticia,
            'comentarios' => $comentarios,
            'form' => $form->createView(),
            'categorias' => $categorias,
            'mensaje_formulario' => $mensaje
        ]);

        // si no existe la cookie de visita se añade
        $time = time() + (3600 * 24 * 365);
        if (!$existeCookie) { $response->headers->setCookie(new Cookie('visitante', 'ok', $time)); }
        
        // enviamos finalmente el response para que se cree la cookie
        return $response;
    }

    /**
     * @Route("/aviso-legal", name="aviso_legal")
     */
    public function avisoLegalAction(Request $request) {
        return $this->render('aviso_legal.html.twig', []);
    }

    /**
     * @Route("/{desc_categoria}", name="categoria_lista")
     */
    public function listarNoticiasAction(Request $request, $desc_categoria) {

        $existeCookie = $this->registrarVisitaAction($request);

        $categoria = $this->getDoctrine()->getManager()->getRepository(Categoria::class)->buscarDescripcion($desc_categoria);
        $noticias = $this->getDoctrine()->getManager()->getRepository(Noticia::class)->buscarListaN($categoria, 0, 3);
        $categorias = $this->getDoctrine()->getManager()->getRepository(Categoria::class)->buscarLista();

        $response = $this->render('pagina_lista_noticias.html.twig', [
            'categoria' => $categoria,
            'noticias' => $noticias,
            'categorias' => $categorias
        ]);

        // si no existe la cookie de visita se añade
        $time = time() + (3600 * 24 * 365);
        if (!$existeCookie) { $response->headers->setCookie(new Cookie('visitante', 'ok', $time)); }

        // enviamos finalmente el response para que se cree la cookie
        return $response;        
    } 

}