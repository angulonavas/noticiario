<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comentario
 *
 * @ORM\Table(name="comentario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ComentarioRepository")
 */
class Comentario
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
     * @ORM\Column(name="pseudonimo", type="string", length=16)     
     * @Assert\Length(
     *      min = 4,
     *      max = 16,
     *      minMessage = "Pseudónimo debe ser al menos de {{ limit }} caracteres",
     *      maxMessage = "Pseudónimo no puede ser mayor de {{ limit }} caracteres"
     * )
     *
     */
    private $pseudonimo;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=32)     
     * @Assert\Length(
     *      min = 4,
     *      max = 32,
     *      minMessage = "Email debe ser al menos de {{ limit }} caracteres",
     *      maxMessage = "Email no puede ser mayor de {{ limit }} caracteres"
     * )
     *
     * @Assert\Email(
     *     message = "'{{ value }}' no es un email válido",
     *     checkMX = true
     * )     
     *
     */
    private $email;

    /**
     * @var string
     *
    * @ORM\Column(name="descripcion", type="string", length=255)     
     * @Assert\Length(
     *      min = 4,
     *      max = 255,
     *      minMessage = "Descripción debe ser al menos de {{ limit }} caracteres",
     *      maxMessage = "Descripción no puede ser mayor de {{ limit }} caracteres"
     * )     
     *
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="Noticia", inversedBy="comentarios")
     * @ORM\JoinColumn(name="id_noticia", referencedColumnName="id")
     */
    private $noticia;

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
     * Set pseudonimo
     *
     * @param string $pseudonimo
     *
     * @return Comentario
     */
    public function setPseudonimo($pseudonimo)
    {
        $this->pseudonimo = $pseudonimo;

        return $this;
    }

    /**
     * Get pseudonimo
     *
     * @return string
     */
    public function getPseudonimo()
    {
        return $this->pseudonimo;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Comentario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Comentario
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Comentario
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
     * Set noticia
     *
     * @param int $noticia
     *
     * @return Noticia
     */
    public function setNoticia($noticia)
    {
        $this->noticia = $noticia;

        return $this;
    }

    /**
     * Get noticia
     *
     * @return int
     */
    public function getNoticia()
    {
        return $this->noticia;
    }

}

