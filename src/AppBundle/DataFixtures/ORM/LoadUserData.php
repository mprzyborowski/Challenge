<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Location;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoadUserData extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@admin.pl');
        $user->setEnabled(true);
        $user->setSuperAdmin(true);
        $user->setRoles(['ROLE_ADMIN']);

        $password = $this->encoder->encodePassword($user, '123456');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}