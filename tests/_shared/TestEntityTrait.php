<?php

namespace App\Tests\_shared;

use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * trait TestEntityTrait | file TestEntityTrait.php
 *
 * In this trait, we have method for :
 *
 * Access to CONSTRAINT VALIDATOR
 * Use PHPUNIT and count number of error
 * Get potential error message
 * 
 * Provide invalid data to use on tests
 * 
 * ⚠ The class must extends KernelTestCase ⚠
 * 
 */
trait TestEntityTrait
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
     * @return void
     */
    public function provideInvalidData()
    {
        yield '`123`' => [123]; // only (3) numbers or invalid postal code
        yield '`123456`' => [123456]; // only (6) numbers or invalid postal code
        yield '`abc123`' => ['abc123']; // Letters AND numbers
        yield '`<script>`' => ['<script>']; // not allowed character
        yield '`;`' => [';']; // not allowed character
        yield '`"`' => ['"']; // not allowed character
        yield '`invalidEmail_AT_test`' => ['invalidEmail_AT_test']; //  not allowed character or invalid email
        yield '`invalidEmail@test`' => ['invalidEmail@test']; //  not allowed character or invalid email
    }
}
