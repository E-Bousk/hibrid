<?php

namespace App\Tests\_shared;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;

/**
 * trait TestControllerTrait | file TestControllerTrait.php
 *
 * In this trait, we have methods for :
 *
 * Following redirections of the User
 * Truncating table before testing
 * 
 */
trait TestControllerTrait
{
    /**
     * Create a client
     * Follow the redirections of the client
     *
     * @return KernelBrowser $client
     */
    private function createClientAndFollowRedirections(): KernelBrowser
    {
        $client = static::createClient();
        $client->followRedirects();
        return $client;
    }

    /**
     * Define which page to test
     *
     * @return KernelBrowser $client
     */
    public function clientRequestedPage(string $path): KernelBrowser
    {
        $client= $this->createClientAndFollowRedirections();

        $client->request('GET', $path);

        return $client;
    }

    /**
     * Truncate the table before each test
     *
     * @param string $table
     * @return void
     */
    private function deleteDataOnTableBeforeTest(string $table, $firstName): void
    {
        $kernel= self::bootKernel();

        $em= $kernel->getContainer()->get('doctrine')->getManager();

        $em->getConnection()->executeQuery("DELETE FROM {$table} WHERE first_name = '{$firstName}'");

        $em->getConnection()->close();
    }
}