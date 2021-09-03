<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\RentalSpace;
use App\Entity\RentalSpaceType;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


/**
 * Class AppFixtures | file AppFixtures.php
 *
 * In this class, we have method to :
 *
 * Fill the tables on Database with dummy data
 * 
 * @return void
 * 
 */
class AppFixtures extends Fixture
{
    /**
     * protected $encoder is used to get encoder object to hash password
     */
    protected $encoder;

    /**
     * init encoder
     * 
     * @param UserPasswordHasherInterface $encoder
     */
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder= $encoder;
    }

    /**
     * Use FAKER to create dummy data
     * Use ORM DOCTRINE to add data on database
     * 
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');
    
        $admin= new User;
        $admin->setEmail("admin@gmail.com")
            ->setPassword($this->encoder->hashPassword($admin, "root"))
            ->setFirstName("admin")
            ->setLastName("admin")
            ->setTelephone1($faker->phoneNumber())
            ->setTelephone2($faker->phoneNumber())
            ->setAddress($faker->address())
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        for ($u= 0; $u < 5; $u++)
        {
            $user= new User;
            $user->setEmail($faker->email())
                ->setPassword($this->encoder->hashPassword($user, "password"))
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setTelephone1($faker->phoneNumber())
                ->setTelephone2($faker->phoneNumber())
                ->setAddress($faker->address());

            $manager->persist($user);
        }

        for ($u= 0; $u < 5; $u++)
        {
            $city= new City;
            $city->setName($faker->city)
                ->setPostalCode(mt_rand(10000, 95000));

            $manager->persist($city);
        }

        $rentalSpaceType= new RentalSpaceType;
        $rentalSpaceType->setDesignation("Cahute 2.5m X 5m");
        $manager->persist($rentalSpaceType);

        $rentalSpaceType= new rentalSpaceType;
        $rentalSpaceType->setDesignation("Cahute 5m X 5m");
        $manager->persist($rentalSpaceType);

        $rentalSpaceType= new rentalSpaceType;
        $rentalSpaceType->setDesignation("Worklab");

        $manager->persist($rentalSpaceType);

        for ($u= 0; $u < 5; $u++)
        {
            $rentalSpace= new RentalSpace;
            $rentalSpace->setRentalSpaceType($rentalSpaceType)
                        ->setCity($city)
                        ->setQuantity(rand(1, 5))
                        ->setMinimumDurationRule(rand(3, 35))
                        ->setMaximumDurationRule(rand(70, 140))
                        ->setDayPrice(rand(150, 350))
                        ->setWeekPrice(rand(1500, 35000))
                        ->setWeekendPrice(rand(300, 700))
                        ->setMonthPrice(rand(5000, 35000));

            $manager->persist($rentalSpace);
        }

        $manager->flush();
    }
}
