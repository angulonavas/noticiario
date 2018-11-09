<?php

namespace AppBundle\Repository;

/**
 * CategoriaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoriaRepository extends \Doctrine\ORM\EntityRepository {

	// Busca el comentario según su id
	public function buscar($id_noticia) {
		$noticia = $this->find($id_noticia);
		return $noticia;
	}

	// Busca la primera categoria que encuentre donde el texto coincida con la descripcion
	public function buscarDescripcion($texto) {
		$categoria = $this->findOneByDescripcion($texto);
		return $categoria;
	}	

	// Busca todas las categorias
	public function buscarLista() {
		$categorias = $this->findAll();
		return $categorias;
	}		

}