<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Noticia;

/**
 * NoticiaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NoticiaRepository extends \Doctrine\ORM\EntityRepository {

	// Busca la noticia según su id
	public function buscar($id_noticia) {
		$noticia = $this->find($id_noticia);
		return $noticia;
	}	

	// Busca la primera noticia que encuentre donde el texto coincida con el titular
	public function buscarTitular($texto) {
		$noticia = $this->findOneByTitular($texto);
		return $noticia;
	}	

	// Busca la primera noticia que encuentre donde el texto esté incluido en la clave
	public function buscarClave($texto) { 
		$qb = $this->createQueryBuilder('n');
		$qb->where( 
			$qb->expr()->like('n.clave', '?1')
		)
		->setParameter(1, '%'.$texto.'%') 
		->addOrderBy('n.fecha', 'DESC'); 
		$noticias = $qb->getQuery()->getResult(); 
		return $noticias[0]; 
	}	

	// Busca la primera noticia que encuentre donde el texto esté incluido en el cuerpo
	public function buscarCuerpo($texto) { 
		$qb = $this->createQueryBuilder('n');
		$qb->where( 
			$qb->expr()->like('n.cuerpo', '?1')
		)
		->setParameter(1, '%'.$texto.'%') 
		->addOrderBy('n.fecha', 'DESC'); 
		$noticias = $qb->getQuery()->getResult(); 
		return $noticias[0]; 
	}	

	// Busca todas las noticias de la categoria
	public function buscarLista($categoria) {
		$noticias = $this->findByCategoria($categoria);
		return $noticias;
	}		

	// Busca N noticias de la categoría comenzando desde el offset inicio
	public function buscarListaN($categoria, $inicio, $N) { 

        $qb = $this->createQueryBuilder('n'); 
        $qb->leftJoin('n.categoria', 'c') 
        	->where($qb->expr()->eq('c.id', '?1')) // ya se puede utilizar ms directamente
            ->setParameter(1, $categoria->getId()) // sólo queremos la categoría pasada como parámetro a la función
			->addOrderBy('n.fecha', 'DESC')
			->setFirstResult($inicio) // offset (número de noticia) a partir del cual vamos a devolver
			->setMaxResults($N) // cantidad de noticias que se vana devolver
		;
      
		$noticias = $qb->getQuery()->getResult(); 
		return $noticias; 
	}	


}
