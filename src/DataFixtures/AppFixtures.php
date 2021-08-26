<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    protected $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder= $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR'); //call of static method
        
        $admin= new User;
        $admin->setEmail("admin@gmail.com")
            ->setPassword($this->encoder->hashPassword($admin, "root"))
            ->setFirstName("admin")
            ->setLastName("admin")
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);


        for ($u= 0; $u < 5; $u++)
        {
            $user= new User;
            $user->setEmail($faker->email())
                ->setFirstName($faker->name())
                ->setLastName($faker->name())
                ->setPassword($this->encoder->hashPassword($user, "password"));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
