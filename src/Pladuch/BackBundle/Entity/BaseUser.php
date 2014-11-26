<?php

namespace Pladuch\BackBundle\Entity;


use Symfony\Component\Security\Core\User\AdvancedUserInterface;

abstract class BaseUser implements AdvancedUserInterface, \Serializable
{
    protected $id;

    protected $salt;

    protected $username;

    protected $password;

    public function __construct()
    {
        $this->salt = $this->generateSalt();
    }

    public function serialize()
    {
        return serialize($this->id, $this->username);
    }

    public function unserialize($serialized)
    {
        list($this->id, $this->username) = unserialize($serialized);
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function generateSalt()
    {
        return base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return true;
    }
}
