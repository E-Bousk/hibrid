<?php

namespace App\Tests\Entity;

use TypeError;
use App\Entity\City;
use App\Tests\_shared\TestEntityTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class CityEntityTest | file CityEntityTest.php
 *
 * In this class, we have methods for :
 *
 * Create a valid CITY
 * Testing constraints on CITY entity with valid data
 * Testing constraints on CITY entity with missing data
 * Testing constraints on CITY entity with invalid data
 */
class CityEntityTest extends KernelTestCase
{
    use TestEntityTrait;
    
    private const VALID_VALUE_NAME=  'Ville-TEST';
    private const VALID_POSTAL_CODE=  '12345';

    private const NOT_BLANK_CONSTRAINT_MESSAGE= 'Veuillez saisir ';
    
    /**
     * Create a new (valid) CITY to use it on tests
     *
     * @return City
     */
    public function getCity(): City
    {
        return (new City())
                    ->setName(self::VALID_VALUE_NAME)
                    ->setPostalCode(self::VALID_POSTAL_CODE);
    }
    
    /**
     * Test constraints on CITY entity
     * TEST = valid name and valid postal code
     *
     * @return void
     */
    public function testCityEntityIsValid(): void
    {
        $this->getValidationErrors($this->getCity(), 0);
    }

    /**
     * Test constraints on CITY entity
     * test = missing name
     * 
     * @return void
     */
    public function testCityEntityIsNotValidDueToMissingName(): void
    {
        $errors=$this->getValidationErrors($this->getCity()->setName(''), 2);
        $this->assertEquals(self::NOT_BLANK_CONSTRAINT_MESSAGE . 'une ville', $errors[0]->getMessage());
    }

    /**
     * Test constraints on CITY entity
     * TEST = missing postal code
     * 
     * @return void
     */
    public function testCityEntityIsNotValidDueToMissingPostalCode(): void
    {
        // this is to tell PHPUNIT that PHP will return a TypeError exception =
        // (« Argument #1 ($postalCode) must be of type int, string given »)
        $this->expectException(TypeError::class);
        $errors=$this->getValidationErrors($this->getCity()->setPostalCode(""), 1);
        $this->assertEquals(self::NOT_BLANK_CONSTRAINT_MESSAGE . 'un code postal', $errors[0]->getMessage());
    }

    /**
     * Test constraints on CITY entity
     * TEST = invalid data on name and on postal code
     * 
     * @dataProvider provideInvalidData
     * 
     * @return void
     */
    public function testCityEntityIsNotValidDueToInvalidData(string|int $invalidData): void
    {
        $this->getValidationErrors($this->getCity()->setName($invalidData), 1);

        switch (true) {
            case (is_numeric($invalidData)):
                $this->getValidationErrors($this->getCity()->setPostalCode($invalidData), 1);
                break;
            
            default:
                // this is to tell PHPUNIT that PHP will return a TypeError exception =
                // (« Argument #1 ($postalCode) must be of type int, string given »)
                $this->expectException(TypeError::class);
                $this->getValidationErrors($this->getCity()->setPostalCode($invalidData), 1);
                break;
        }
    }
}
