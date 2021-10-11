<?php

namespace App\Tests\URL;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Tests\_shared\TestControllerTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ProtectedUrlSmokeTest | file ProtectedUrlSmokeTest.php
 *
 * In this class, we have methods for :
 *
 * Testing proteceted URL
 * Getting all protected URi (path)
 *
 * 
 */
class ProtectedUrlSmokeTest extends WebTestCase
{
    use TestControllerTrait;

    /**
     * Test that all protected pages return code 200 (HTTP_OK)
     *
     * @return void
     */
    public function testAllProtectedPagesAreSuccessfullyLoaded()
    {
        $client= $this->createClientAndFollowRedirections();

        // Get an user with « ADMIN » role
        $user = static::getContainer()->get(UserRepository::class)->findUsersByRole('ROLE_ADMIN');
        
        if ($user === null)
        {
            $user= new User;
        }

        dump($user); // this is to display the loaded user
        
        $client->loginUser($user);

        $protectedUri= $this->getProtectedUri($client);

        // $protectedUri[]= '/unexisting-URI-to-confitm-test';  // this is to test with an unexisting URI
        dump($protectedUri); // this is to display the found URI

        $NumberOfProtectedUri= count($protectedUri);

        $numberOfSuccessfullProtectedUri= 0;

        $uriNotSuccessfullyLoaded= [];
        $uriNotSuccessfullyLoadedErrorCode= [];

        foreach ($protectedUri as $uri) {
            $client->request('GET', $uri);
            // dump($client->getResponse()->getStatusCode(), $uri, $NumberOfProtectedUri, $numberOfSuccessfullProtectedUri);

            if ($client->getResponse()->getStatusCode() === Response::HTTP_OK) {
                $numberOfSuccessfullProtectedUri += 1;
            } else {
                $uriNotSuccessfullyLoaded[]= $uri;
                $uriNotSuccessfullyLoadedErrorCode[]= $client->getResponse()->getStatusCode();
            }
        }

        if (!empty($uriNotSuccessfullyLoaded)) {
            dump($uriNotSuccessfullyLoaded, $uriNotSuccessfullyLoadedErrorCode); // to display URI and errors code if any
        }

        // dd($uri, $NumberOfProtectedUri, $numberOfSuccessfullProtectedUri);
        $this->assertSame($NumberOfProtectedUri, $numberOfSuccessfullProtectedUri);
    }

    /**
     * Get all protected URI (path)
     * 
     * @param KernelBrowser $client
     * @return array
     */
    private function getProtectedUri(KernelBrowser $client): array
    {
        $router= $client->getContainer()->get('router');
        $routesWithParameters= $router->getRouteCollection()->all();
        
        $protectedUri= [];

        foreach ($routesWithParameters as $routeName => $routeWithParameters)
        {
            if (!$routeWithParameters->getDefault('_public_access') === true) {
                $protectedUri[]= str_replace("{id}", 1, ($routeWithParameters->getPath()));
            }
        }
        return $protectedUri;
    }
}
