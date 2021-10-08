<?php

namespace App\Tests\Repository;

use App\Repository\RentalSpaceRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class RentalSpaceRepositoryTest | file RentalSpaceRepositoryTest.php
 *
 * In this class, we have methods for :
 *
 * Testing repository on USER entity
 * 
 */
class RentalSpaceRepositoryTest extends KernelTestCase
{

    /**
     * Testing repository on USER entity
     * 
     * count test
     *
     * @return void
     */
    public function testCount()
    {
        self::bootKernel();
        $rentalSpace= static::getContainer()->get(RentalSpaceRepository::class)->count([]);

        $this->assertEquals(22, $rentalSpace);
    }
}