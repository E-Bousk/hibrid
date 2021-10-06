<?php

namespace App\Tests\Entity;

use App\Entity\User;
use App\Tests\TestTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class UserEntityTest | file UserEntityTest.php
 *
 * In this class, we have methods for :
 *
 * Getting Symfony constraints validator
 * Testing constraints on USER entity with valid data
 * Testing constraints on USER entity with missing data
 * 
 */
class UserEntityTest extends KernelTestCase
{
    use TestTrait;
    
    private const VALID_VALUE_FIRST_NAME=  'PrénomTEST';
    private const VALID_VALUE_LAST_NAME=  'NomTEST';
    private const VALID_VALUE_EMAIL=  'test@test.com';

    private const NOT_BLANK_CONSTRAINT_MESSAGE= 'Veuillez saisir ';
    
    /**
     * Create a new (valid) USER to use it on tests
     *
     * @return User
     */
    public function getUser(): User
    {
        return (new User())
                        ->setFirstName(self::VALID_VALUE_FIRST_NAME)
                        ->setLastName(self::VALID_VALUE_LAST_NAME)
                        ->setEmail(self::VALID_VALUE_EMAIL);
    }
    
    /**
     * Set up Test on USER entity
     * TEST = valid firstName, valid lastName and valid email
     *
     * @return void
     */
    public function testUserEntityIsValid(): void
    {
        $this->getValidationErrors($this->getUser(), 0);
    }

    /**
     * Set up Test on USER entity
     * TEST = missing email
     * 
     * @return void
     */
    public function testUserEntityIsNotValidDueToMissingEmail(): void
    {
        $errors=$this->getValidationErrors($this->getUser()->setEmail(''), 1);
        $this->assertEquals(self::NOT_BLANK_CONSTRAINT_MESSAGE . 'une adresse email', $errors[0]->getMessage());
    }

    /**
     * Set up Test on USER entity
     * test = missing first name
     * 
     * @return void
     */
    public function testUserEntityIsNotValidDueToMissingFirstName(): void
    {
        $errors=$this->getValidationErrors($this->getUser()->setFirstName(''), 1);
        $this->assertEquals(self::NOT_BLANK_CONSTRAINT_MESSAGE . 'un prénom', $errors[0]->getMessage());
    }

    /**
     * Set up Test on USER entity
     * TEST = missing last name
     * 
     * @return void
     */
    public function testUserEntityIsNotValidDueToMissingLastName(): void
    {
        $errors=$this->getValidationErrors($this->getUser()->setLastName(''), 1);
        $this->assertEquals(self::NOT_BLANK_CONSTRAINT_MESSAGE . 'un nom', $errors[0]->getMessage());
    }

    /**
     * Set up Test on USER entity
     * TEST = invalid data on first name, on last name and on email
     * 
     * @dataProvider provideInvalidData
     * 
     * @return void
     */
    public function testUserEntityIsNotValidDueToInvalidData(string|int $invalidData): void
    {
        $this->getValidationErrors($this->getUser()->setFirstName($invalidData), 1);
        $this->getValidationErrors($this->getUser()->setLastName($invalidData), 1);
        $this->getValidationErrors($this->getUser()->setEmail($invalidData), 1);
    }

    // /**
    //  * Set up Test on USER entity
    //  * TEST = email cannot be duplicated
    //  * 
    //  * @return void
    //  */
    // public function testUserEntityIsNotValidDueToDuplicatedEmail(): void
    // {
    //     $this->getValidationErrors($this->getUser()->setEmail('duplicated@email.com'), 1);
    // }

}
