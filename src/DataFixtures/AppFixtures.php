<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName("Admin")
            ->setUsername("admin@gmail.com")
            ->setPassword($this->userPasswordEncoder->encodePassword($user, "admin"))
            ->setRoles(["ROLE_ADMIN"])
            ->setToken("token")
            ->setConfirmed(true);

        $manager->persist($user);
        $manager->flush();
    }
}
