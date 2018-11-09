<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visita
 *
 * @ORM\Table(name="visita")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VisitaRepository")
 */
class Visita
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
     * @var int
     *
     * @ORM\Column(name="habitual", type="integer")
     */
    private $habitual;

    /**
     * @var int
     *
     * @ORM\Column(name="nuevo", type="integer")
     */
    private $nuevo;

    /**
     * @var \Date
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;


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
     * Set habitual
     *
     * @param integer $habitual
     *
     * @return Visita
     */
    public function setHabitual($habitual)
    {
        $this->habitual = $habitual;

        return $this;
    }

    /**
     * Get habitual
     *
     * @return int
     */
    public function getHabitual()
    {
        return $this->habitual;
    }

    /**
     * Set nuevo
     *
     * @param integer $nuevo
     *
     * @return Visita
     */
    public function setNuevo($nuevo)
    {
        $this->nuevo = $nuevo;

        return $this;
    }

    /**
     * Get nuevo
     *
     * @return int
     */
    public function getNuevo()
    {
        return $this->nuevo;
    }

    /**
     * Set fecha
     *
     * @param \Date $fecha
     *
     * @return Visita
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \Date
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}

