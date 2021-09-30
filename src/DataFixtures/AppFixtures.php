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
     * protected $encoder is used to get instance of UserPasswordHasherInterface to hash password
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
     * @return void
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

        for ($u= 0; $u < mt_rand(20, 30); $u++)
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

        $cities=[];
        for ($u= 0; $u < mt_rand(15, 25); $u++)
        {
            $city= new City;
            $city->setName($faker->city)
                ->setPostalCode(mt_rand(10000, 95000));
            
            $cities[]= $city;

            $manager->persist($city);
        }

        $RStype= ["Cahute 2.5m X 5m", "Cahute 5m X 5m", "Worklab"];
        $rentalSpaceTypes= [];
        for ($rst=0; $rst<3; $rst++) {
            $rentalSpaceType= new RentalSpaceType;
            $rentalSpaceType->setDesignation($RStype[$rst]);

            $rentalSpaceTypes[]= $rentalSpaceType;

            $manager->persist($rentalSpaceType);
        }

        $manager->persist($rentalSpaceType);

        for ($u= 0; $u < mt_rand(20, 25); $u++)
        {
            $rentalSpace= new RentalSpace;
            $rentalSpace->setRentalSpaceType($faker->randomElement($rentalSpaceTypes))
                        ->setCity($faker->randomElement($cities))
                        ->setQuantity(mt_rand(1, 5))
                        ->setMinimumDurationRule(mt_rand(3, 35))
                        ->setMaximumDurationRule(mt_rand(70, 140))
                        ->setDayPrice(mt_rand(150, 350))
                        ->setWeekPrice(mt_rand(1500, 35000))
                        ->setWeekendPrice(mt_rand(300, 700))
                        ->setMonthPrice(mt_rand(5000, 35000));

            $manager->persist($rentalSpace);
        }

        $manager->flush();
    }
}
