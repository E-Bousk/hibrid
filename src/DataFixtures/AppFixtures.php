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

    /* get an encoder for password */
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder= $encoder;
    }

    /* get doctrine manager */
    public function load(ObjectManager $manager)
    {
        /* set the faker for Frenchy names */
        $faker= Factory::create('fr_FR'); //call of static method
        
        /* set the values to create an admin in database */
        $admin= new User;
        $admin->setEmail("admin@gmail.com")
            ->setPassword($this->encoder->hashPassword($admin, "root"))
            ->setFirstName("admin")
            ->setLastName("admin")
            ->setRoles(['ROLE_ADMIN']);
        /* make it persistant */
        $manager->persist($admin);

        /* set attributes with faker for 5 users in database */
        for ($u= 0; $u < 5; $u++)
        {
            /* set the values to create an user in database */
            $user= new User;
            $user->setEmail($faker->email())
                ->setPassword($this->encoder->hashPassword($user, "password"))
                ->setFirstName($faker->name())
                ->setLastName($faker->name());
            /* make them persistant */
            $manager->persist($user);
        }

        /* make doctrine write generated users into the database */
        $manager->flush();
    }
}
