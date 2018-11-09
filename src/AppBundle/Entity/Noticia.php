<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Noticia
 *
 * @ORM\Table(name="noticia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NoticiaRepository")
 */
class Noticia
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titular", type="string", length=128)
     */
    private $titular;

    /**
     * @var string
     *
     * @ORM\Column(name="clave", type="string", length=255)
     */
    private $clave;

    /**
     * @var string
     *
     * @ORM\Column(name="cuerpo", type="string", length=2048)
     */
    private $cuerpo;

    /**
     * @var string
     *
     * @ORM\Column(name="autor", type="string", length=32)
     */
    private $autor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var bool
     *
     * @ORM\Column(name="tipo_media", type="boolean")
     */
    private $tipoMedia;

    /**
     * @var string
     *
     * @ORM\Column(name="media", type="string", length=128)
     */
    private $media;

    /**
     * @var string
     *
     * @ORM\Column(name="fuente", type="string", length=32, options={"default" : "www.elnoticiario.es"})
     */
    private $fuente;

    /**
     * @var bool
     *
     * @ORM\Column(name="publicada", type="boolean")
     */
    private $publicada;

    /**
     * @ORM\ManyToOne(targetEntity="SeguridadBundle\Entity\Usuario", inversedBy="noticias")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="noticias")
     * @ORM\JoinColumn(name="id_categoria", referencedColumnName="id")
     */
    private $categoria;    

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titular
     *
     * @param string $titular
     *
     * @return Noticia
     */
    public function setTitular($titular)
    {
        $this->titular = $titular;

        return $this;
    }

    /**
     * Get titular
     *
     * @return string
     */
    public function getTitular()
    {
        return $this->titular;
    }

    /**
     * Set clave
     *
     * @param string $clave
     *
     * @return Noticia
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get clave
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set cuerpo
     *
     * @param string $cuerpo
     *
     * @return Noticia
     */
    public function setCuerpo($cuerpo)
    {
        $this->cuerpo = $cuerpo;

        return $this;
    }

    /**
     * Get cuerpo
     *
     * @return string
     */
    public function getCuerpo()
    {
        return $this->cuerpo;
    }

    /**
     * Set autor
     *
     * @param string $autor
     *
     * @return Noticia
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return string
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Noticia
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set tipoMedia
     *
     * @param boolean $tipoMedia
     *
     * @return Noticia
     */
    public function setTipoMedia($tipoMedia)
    {
        $this->tipoMedia = $tipoMedia;

        return $this;
    }

    /**
     * Get tipoMedia
     *
     * @return bool
     */
    public function getTipoMedia()
    {
        return $this->tipoMedia;
    }

    /**
     * Set media
     *
     * @param string $media
     *
     * @return Noticia
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set fuente
     *
     * @param string $fuente
     *
     * @return Noticia
     */
    public function setFuente($fuente)
    {
        $this->fuente = $fuente;

        return $this;
    }

    /**
     * Get fuente
     *
     * @return string
     */
    public function getFuente()
    {
        return $this->fuente;
    }    

    /**
     * Set publicada
     *
     * @param boolean $publicada
     *
     * @return Noticia
     */
    public function setPublicada($publicada)
    {
        $this->publicada = $publicada;

        return $this;
    }

    /**
     * Get publicada
     *
     * @return bool
     */
    public function getPublicada()
    {
        return $this->publicada;
    }
}

