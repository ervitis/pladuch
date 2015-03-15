<?php

namespace Pladuch\BackBundle\Command;


use Doctrine\ORM\ORMException;
use Pladuch\BackBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pladuch\DataBundle\Utilities\Utilities;

class CreateAdminUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        parent::configure();

        $this->setName('pladuch:create-admin')
            ->setDescription('Crea a un usuario admin')
            ->addArgument('username', InputArgument::REQUIRED, 'Nombre de usuario')
            ->addArgument('password', InputArgument::REQUIRED, 'Contraseña')
            ->addArgument('email', InputArgument::REQUIRED, 'E-mail');
    }

    protected function execute(InputInterface $inputInterface, OutputInterface $outputInterface)
    {
        $outputInterface->writeln('Nuevo usuario');

        $username = $inputInterface->getArgument('username');
        $password = $inputInterface->getArgument('password');
        $email = $inputInterface->getArgument('email');

        if (Utilities::isNullVoid($username) or Utilities::isNullVoid($password) or Utilities::isNullVoid($email)) {
            $outputInterface->writeln('¡Escriba un valor para cada parámetro!');
            return 1;
        }

        $factory = $this->getContainer()->get('security.encoder_factory');
        $doctrine = $this->getDoctrine();

        $usuario = new Usuario();
        $usuario->setUsername($username);
        $usuario->setEmail($email);
        $usuario->setPassword(Utilities::generatePassword($factory, $usuario, $password));
        $usuario->setRol($doctrine->getRepository('PladuchDataBundle:Rol')->findOneByNombre('Administrador'));

        $em = $this->getDoctrine()->getManager();

        try {
            $em->persist($usuario);
            $em->flush();
        } catch (ORMException $e) {
            $outputInterface->writeln('Ha ocurrido un error');
            $outputInterface->writeln($e->getCode() . ': ' . $e->getMessage());

            return 1;
        }


        $outputInterface->writeln('El usuario ' . $username . ' ha sido creado satisfactoriamente');
        return 0;
    }

    private function getDoctrine()
    {
        return $this->getContainer()->get('doctrine');
    }
}
