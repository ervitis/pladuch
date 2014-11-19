<?php

namespace Pladuch\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CatalogoPlatosTraduccion
 *
 * @ORM\Table(name="catalogo_platos_traduccion", indexes={@ORM\Index(name="FK_DESCRIPCIONPLATOS_TRADUCCION", columns={"catalogoplatos_id"})})
 * @ORM\Entity
 */
class CatalogoPlatosTraduccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="idioma_id", type="integer", nullable=false)
     */
    private $idiomaId;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var \CatalogoPlatos
     *
     * @ORM\ManyToOne(targetEntity="CatalogoPlatos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="catalogoplatos_id", referencedColumnName="id")
     * })
     */
    private $catalogoplatos;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idiomaId
     *
     * @param integer $idiomaId
     * @return CatalogoPlatosTraduccion
     */
    public function setIdiomaId($idiomaId)
    {
        $this->idiomaId = $idiomaId;

        return $this;
    }

    /**
     * Get idiomaId
     *
     * @return integer 
     */
    public function getIdiomaId()
    {
        return $this->idiomaId;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CatalogoPlatosTraduccion
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
     * Set catalogoplatos
     *
     * @param \Pladuch\DataBundle\Entity\CatalogoPlatos $catalogoplatos
     * @return CatalogoPlatosTraduccion
     */
    public function setCatalogoplatos(\Pladuch\DataBundle\Entity\CatalogoPlatos $catalogoplatos = null)
    {
        $this->catalogoplatos = $catalogoplatos;

        return $this;
    }

    /**
     * Get catalogoplatos
     *
     * @return \Pladuch\DataBundle\Entity\CatalogoPlatos 
     */
    public function getCatalogoplatos()
    {
        return $this->catalogoplatos;
    }
}
