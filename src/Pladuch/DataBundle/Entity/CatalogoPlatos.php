<?php

namespace Pladuch\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CatalogoPlatos
 *
 * @ORM\Table(name="catalogo_platos")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class CatalogoPlatos implements FileOptions
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_foto", type="string", length=255, nullable=true)
     */
    private $rutaFoto;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_foto", type="string", length=255, nullable=true)
     */
    private $nombreFoto;

    /**
     * @Assert\Image(
     *      maxSize="5M",
     *      maxSizeMessage="Tamaño máximo superado para una imagen",
     *      mimeTypes={"image/jpg", "image/jpeg", "image/png"},
     *      mimeTypesMessage="Sólo se admiten subir imágenes"
     * )
     */
    private $file;

    private $temp;

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
     * Set nombre
     *
     * @param string $nombre
     * @return CatalogoPlatos
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set rutaFoto
     *
     * @param string $rutaFoto
     * @return CatalogoPlatos
     */
    public function setRutaFoto($rutaFoto)
    {
        $this->rutaFoto = $rutaFoto;

        return $this;
    }

    /**
     * Get nombreFoto
     *
     * @return string
     */
    public function getNombreFoto()
    {
        return $this->nombreFoto;
    }

    /**
     * Set nombreFoto
     *
     * @param $nombreFoto
     * @return $this
     */
    public function setNombreFoto($nombreFoto)
    {
        $this->nombreFoto = $nombreFoto;

        return $this;
    }

    /**
     * Get rutaFoto
     *
     * @return string 
     */
    public function getRutaFoto()
    {
        return $this->rutaFoto;
    }

    /**
     * @return string
     */
    public function getUploadDir()
    {
        return 'uploads/platos';
    }

    /**
     * @return string
     */
    public function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    /**
     * @return null|string
     */
    public function getAbsolutePath()
    {
        return null === $this->rutaFoto ? null : $this->getUploadDir() . '/' . $this->rutaFoto;
    }

    /**
     * @return null|string
     */
    public function getWebPath()
    {
        return null === $this->rutaFoto ? null : $this->getUploadDir() . '/' . $this->rutaFoto;
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        if (isset($this->rutaFoto)) {
            $this->temp = $this->rutaFoto;
            $this->rutaFoto = null;
        } else {
            $this->rutaFoto = 'uploads/platos';
        }

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            $nombre = sha1(uniqid(mt_rand(), true));
            $this->rutaFoto = $nombre . '.' . $this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->rutaFoto
        );

        if (isset($this->temp)) {
            unlink($this->getUploadRootDir() . DIRECTORY_SEPARATOR . $this->temp);
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }
}
