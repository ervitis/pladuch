<?php

namespace Pladuch\DataBundle\Utilities;


use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class Utilities
{
    public static function isNullVoid($value)
    {
        if (is_null($value)) {
            return true;
        }

        if ('' == $value) {
            return true;
        }

        return false;
    }

    public static function generatePassword(EncoderFactoryInterface $factory, UserInterface $entity, $password)
    {
        $encoder = $factory->getEncoder($entity);

        return $encoder->encodePassword($password, $entity->getSalt());
    }
}
