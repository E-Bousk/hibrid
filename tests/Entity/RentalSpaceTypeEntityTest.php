<?php

namespace App\Tests\Entity;

use App\Entity\RentalSpaceType;
use App\Tests\_shared\TestEntityTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class RentalSpaceTypeEntityTest | file RentalSpaceTypeEntityTest.php
 *
 * In this class, we have methods for :
 *
 * Getting Symfony constraints validator
 * Testing constraints on RENTAL SPACE TYPE entity with valid data
 * Testing constraints on RENTAL SPACE TYPE entity with missing data
 * 
 */
class RentalSpaceTypeEntityTest extends KernelTestCase
{
    use TestEntityTrait;
    
    private const VALID_VALUE_DESIGNATION=  'Type-TEST';
    private const NOT_BLANK_CONSTRAINT_MESSAGE= 'Veuillez saisir ';
    
    /**
     * Create a new (valid) RENTAL SPACE TYPE to use it on tests
     *
     * @return RentalSpaceType
     */
    public function getRentalSpaceType(): RentalSpaceType
    {
        return (new RentalSpaceType())
                    ->setDesignation(self::VALID_VALUE_DESIGNATION);
    }
    
    /**
     * Set up Test on RENTAL SPACE TYPE entity
     * TEST = valid designation
     *
     * @return void
     */
    public function testRentalSpaceTypeEntityIsValid(): void
    {
        $this->getValidationErrors($this->getRentalSpaceType(), 0);
    }

    /**
     * Set up Test on RENTAL SPACE TYPE entity
     * test = missing designation
     * 
     * @return void
     */
    public function testRentalSpaceTypeEntityIsNotValidDueToMissingDesignation(): void
    {
        $errors=$this->getValidationErrors($this->getRentalSpaceType()->setDesignation(''), 2);
        $this->assertEquals(self::NOT_BLANK_CONSTRAINT_MESSAGE . 'un type d\'espace locatif', $errors[0]->getMessage());
    }

    /**
     * Set up Test on RENTAL SPACE TYPE entity
     * TEST = invalid data on designation
     * 
     * @dataProvider provideSpecificInvalidData
     * 
     * @return void
     */
    public function testRentalSpaceTypeEntityIsNotValidDueToInvalidData(string|int $invalidData): void
    {
        $this->getValidationErrors($this->getRentalSpaceType()->setDesignation($invalidData), 1);
    }

    /**
     * Provide invalid data to use on THIS tests
     *
     * @return array
     */
    public function provideSpecificInvalidData(): array
    {
        return [
            '`1`' => [1], // less than 3 characters
            '`a`' => ['ab'], // less than 3 characters
            '`test;`' => ['test;'], // not allowed character
            '`"test"`' => ['"test"'], // not allowed character
            '`<test>`' => ['<test>'], // not allowed character
        ];
    }
}
