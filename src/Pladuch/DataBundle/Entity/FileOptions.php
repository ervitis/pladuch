<?php

namespace Pladuch\DataBundle\Entity;


interface FileOptions
{
    /**
     * Gets the upload dir for each file entity
     *
     * @return string
     */
    public function getUploadDir();

    /**
     * @return string
     */
    public function getUploadRootDir();

    /**
     * @return string
     */
    public function getAbsolutePath();

    /**
     * @return string
     */
    public function getWebPath();
}
