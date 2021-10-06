<?php

namespace App\Tests;

use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * trait TestTrait | file TestTrait.php
 *
 * In this trait, we have method for :
 *
 * Access to CONSTRAINT VALIDATOR
 * Use PHPUNIT and count number of error
 * Get potential error message
 * 
 * Provide invalid data to use on tests
 * 
 */
trait TestTrait
{
    /**
     * Access CONSTRAINT VALIDATOR and use it on USER entity
     * Use PHPUNIT and count number of error
     * Get potential error message (for debugging test)
     * 
     * @param $entity
     * @param integer $nbrExpectedErrors
     * @return ConstraintViolationList $error
     */
    private function getValidationErrors($entity, int $nbrExpectedErrors = 0): ConstraintViolationList
    {
        self::bootKernel();

        $errors = static::getContainer()->get(ValidatorInterface::class)->validate($entity);

        $messages= [];

        /** @var ConstraintViolation $error */
        foreach($errors as $error) {
            $messages[]= $error->getPropertyPath() . ' => ' . $error->getMessage();
        }

        $this->assertCount($nbrExpectedErrors, $errors, implode(', ', $messages));
        
        return $errors;
    }

    /**
     * Provide invalid data to use on tests
     *
     * @return array
     */
    public function provideInvalidData(): array
    {
        return [
            ['abc123'], // Letters and numbers
            [123], // only (3) numbers or invalid postal code
            [123456], // only (6) numbers or invalid postal code
            [';'], // not allowed caracter
            ['<script>'], // not allowed caracter
            ['"'], // not allowed caracter
            ['invalidEmail_AT_test'], //  not allowed caracter or invalid email
            ['invalidEmail@test'], //  not allowed caracter or invalid email
        ];
    }
}
