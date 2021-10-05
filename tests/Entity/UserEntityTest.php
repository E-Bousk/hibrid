<?php

namespace App\Tests\Entity;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    private const VALID_VALUE_FIRST_NAME=  'Prénom';
    private const VALID_VALUE_LAST_NAME=  'Nom';
    private const NOT_BLANK_CONSTRAINT_MESSAGE_FIRSTNAME= 'Veuillez saisir un prénom';
    private const NOT_BLANK_CONSTRAINT_MESSAGE_LASTNAME= 'Veuillez saisir un nom';

    private const NOT_BLANK_CONSTRAINT_MESSAGE_EMAIL= 'Veuillez saisir une adresse email';
    private const VALID_VALUE_EMAIL=  'toto@gmail.com';
    

    private ValidatorInterface $validator;

    /**
     * Get CONSTRAINT VALIDATOR 
     *
     * @return void
     */
    protected function setUp(): void
    {
        $kernel= self::bootKernel();

        $this->validator= $kernel->getContainer()->get('validator');
    }

    /**
     * Set up Test on USER entity
     * test = valid firstName, valid lastName and valid email
     *
     * @return void
     */
    public function testUserEntityIsValid(): void
    {
        $user= new User;

        $user->setFirstName(self::VALID_VALUE_FIRST_NAME)
            ->setLastName(self::VALID_VALUE_LAST_NAME)
            ->setEmail(self::VALID_VALUE_EMAIL);

        $this->getValidationErrors($user, 0);
    }

    /**
     * Set up Test on USER entity
     * test = missing email
     * 
     * @return void
     */
    public function testUserEntityIsInvalidDueToMissingEmail(): void
    {
        $user= new User;

        $user->setFirstName(self::VALID_VALUE_FIRST_NAME)
            ->setLastName(self::VALID_VALUE_LAST_NAME);

        $errors=$this->getValidationErrors($user, 1);

        $this->assertEquals(self::NOT_BLANK_CONSTRAINT_MESSAGE_EMAIL, $errors[0]->getMessage());
    }
    /**
     * Set up Test on USER entity
     * test = missing email
     * 
     * @return void
     */
    public function testUserEntityIsInvalidDueToMissingFirstName(): void
    {
        $user= new User;

        $user->setFirstName(self::VALID_VALUE_FIRST_NAME)
            ->setEmail(self::VALID_VALUE_EMAIL);

        $errors=$this->getValidationErrors($user, 1);

        $this->assertEquals(self::NOT_BLANK_CONSTRAINT_MESSAGE_LASTNAME, $errors[0]->getMessage());
    }
    /**
     * Set up Test on USER entity
     * test = missing email
     * 
     * @return void
     */
    public function testUserEntityIsInvalidDueToMissingLastName(): void
    {
        $user= new User;

        $user->setLastName(self::VALID_VALUE_LAST_NAME)
            ->setEmail(self::VALID_VALUE_EMAIL);

        $errors=$this->getValidationErrors($user, 1);

        $this->assertEquals(self::NOT_BLANK_CONSTRAINT_MESSAGE_FIRSTNAME, $errors[0]->getMessage());
    }





    /**
     * Launch (use) phpunit to test USER entity
     *
     * @param User $user
     * @param integer $nbrExpectedErrors
     * @return ConstraintViolationList $errors
     */
    private function getValidationErrors(User $user, int $nbrExpectedErrors): ConstraintViolationList
    {
        $errors= $this->validator->validate($user);

        $this->assertCount($nbrExpectedErrors, $errors);

        return $errors;
    }


}
