<?php

namespace App\Tests\URL;

use App\Tests\_shared\TestControllerTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



/**
 * Class PublicUrlSmokeTest | file PublicUrlSmokeTest.php
 *
 * In this class, we have methods for :
 *
 * Testing all public URL
 * Getting all the public URI (paths)
 * 
 * ⚠ Need to add « defaults:['_public_access' => true] » for public route on the controllers ! ⚠
 * 
 */
class PublicUrlSmokeTest extends WebTestCase
{
    use TestControllerTrait;

    /**
     * Test that all public pages return code 200 (HTTP_OK)
     *
     * @return void
     */
    public function testAllPublicPagesAreSuccessfullyLoaded()
    {
        $client= $this->createClientAndFollowRedirections();

        $publicUri= $this->getPublicUri($client);

        // $publicUri[]= '/unexisting-URI-to-confitm-test'; // this is to test with an unexisting URI
        dump($publicUri); // this is to display the found URI

        $NumberOfPublicUri= count($publicUri);

        $numberOfSuccessfullPublicUri= 0;

        $uriNotSuccessfullyLoaded= [];

        foreach ($publicUri as $uri) {
            $client->request('GET', $uri);

            if ($client->getResponse()->getStatusCode() === Response::HTTP_OK) {
                $numberOfSuccessfullPublicUri += 1;
            } else {
                $uriNotSuccessfullyLoaded[]= $uri;
            }
        }

        if (!empty($uriNotSuccessfullyLoaded)) {
            dump($uriNotSuccessfullyLoaded); // display URI not successfully loaded if any
        }

        $this->assertSame($NumberOfPublicUri, $numberOfSuccessfullPublicUri);
    }

    /**
     * Get all the public URI (path)
     * 
     * ⚠ Need to add « defaults:['_public_access' => true] » for public route on the controllers ! ⚠
     *
     * @param KernelBrowser $client
     * @return array
     */
    public function getPublicUri(KernelBrowser $client): array
    {
        $router= $client->getContainer()->get('router');
        $routesWithParameters= $router->getRouteCollection()->all();
        
        $publicUri= [];

        foreach ($routesWithParameters as $routeName => $routeWithParameters)
        {
            if ($routeWithParameters->getDefault('_public_access') === true) {
                $publicUri[]= $routeWithParameters->getPath();
            }
        }
        return $publicUri;
    }

    // /**
    //  * 
    //  * Test public URLs
    //  * 
    //  * @dataProvider urlProvider
    //  */
    // public function testPageIsSuccessfullyLoaded($url)
    // {
    //     $client = self::createClient();
    //     $client->request('GET', $url);

    //     $this->assertResponseIsSuccessful();
    // }

    // /**
    //  * Provide URLs
    //  *
    //  * @return void
    //  */
    // public function urlProvider()
    // {
    //     yield 'Home page' => ['/'];
    //     yield 'Register page' =>['/register'];
    //     yield 'Reset password page' =>['/reset-password'];
    //     yield 'Loging page' => ['/login'];
    // }
}