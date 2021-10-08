<?php

namespace App\Tests\Controller;

use App\Tests\_shared\TestControllerTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class RegistrationControllerTest | file RegistrationControllerTest.php
 *
 * In this class, we have methods for :
 *
 * Testing the access to registration page
 * Test the submit form with valid data on registration page
 * 
 */
class RegistrationControllerTest extends WebTestCase
{
    use TestControllerTrait;

    /**
     * Test the access to registration page
     *
     * @return void
     */
    public function testGetToRegistrationPage(): void
    {
        $this->clientRequestedPage("/register");

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Créer un compte');
    }

    /**
     * Test the submit form with valid data on registration page
     *
     * @return void
     */
    public function testSubmitRegistrationFormWithValidDataAndRedirection(): void
    {

        $client= $this->clientRequestedPage("/register");

        $this->deleteDataOnTableBeforeTest('user', 'PrénomTEST');

        $client->submitForm(
            "Inscription",
            [   
                'registration_form[firstName]' => 'PrénomTEST',
                'registration_form[lastName]' => 'NomTEST',
                'registration_form[telephone1]' => '0123456789',
                'registration_form[telephone2]' => '0612345678',
                'registration_form[address]' => 'Test',
                'registration_form[email]' => 'test@registration.com',
                'registration_form[plainPassword][first]' => 'password',
                'registration_form[plainPassword][second]' => 'password'
            ]
        );

        $this->assertResponseIsSuccessful();

        $this->assertRouteSame('homepage');
    }
}