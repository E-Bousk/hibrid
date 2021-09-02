<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;

class LoginFormAuthenticator extends AbstractGuardAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'security_login';

    protected $encoder;
    protected $flashBag;
    protected $entityManager;
    protected $urlGenerator;

    /* will be use on 'checkCredentials' method to hash and verify wordpass */
    public function __construct(UserPasswordHasherInterface $encoder, UrlGeneratorInterface $urlGenerator, FlashBagInterface $flashBag, EntityManagerInterface $entityManager)
    {
       $this->encoder= $encoder;
       $this->flashBag= $flashBag;
       $this->entityManager= $entityManager;
       $this->urlGenerator= $urlGenerator;
    }
    
    public function supports(Request $request)
    {
        /* check if the route is 'security_login' with POST method */
        return $request->attributes->get('_route') === 'security_login' 
            && $request->isMethod('POST');
        /* go to next method if return = true */
    }

    public function getCredentials(Request $request)
    {
        /* get array with email, password and CSRF token */
        return $request->request->get('login');
        /* on success, send this array to next method */
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        /* check (with email) if the user exist on 'user' entity ($userProvider is configured in 'security.yaml' with 'app_user_provider') */
        try {
            return $userProvider->loadUserByIdentifier($credentials['email']);
        /* on error, customize the message displayed (catch the exception and throw another one instead) */
        } catch(UserNotFoundException $e) {
            throw new AuthenticationException("Cette adresse email est inconnue");
        }
        /* on success, send the User to next method */
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        /* check if the password is the same on database : need to encode the password first */
        $isValid= $this->encoder->isPasswordValid($user, $credentials['password']);
        /* (if not valid) send an exception with custom message */
        if (!$isValid) {
            throw new AuthenticationException("Les informations de connexions ne correspondent pas");
        }
        return true;
        /* when 'true' is return : authentication is done and OK */
    }

    /* whenever a previous method failed, exception will arrive here */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        /* get the email to keep it on the inputform (on 'createForm' method, used on 'SecurityController's 'login' method) */
        $request->attributes->set(Security::LAST_USERNAME, $request->get('login')['email']);

        /* get the exception to show it (on 'render' method, used on 'SecurityController's 'login' method) */
        $request->attributes->set(Security::AUTHENTICATION_ERROR, $exception);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        // /* on success, go to homepage */
        // return new RedirectResponse('/');
        $user= $this->entityManager->getRepository(User::class)->findOneBy(['email' => $token->getUser()->getUsername()]);
        $this->flashBag->add('success', 'Welcome ' . $user->getFullName());

        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->urlGenerator->generate('homepage'));
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        /* on failure, go back to login page */
        $this->flashBag->add('error', "Vous devez d'abord vous connecter");
        return new RedirectResponse('/login');
    }

    public function supportsRememberMe()
    {
        //
    }
}













// version Symfony 5.3 :
// <?php

// namespace App\Security;

// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
// use Symfony\Component\Security\Core\Exception\AuthenticationException;
// use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
// use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

// class LoginFormAuthenticator extends AbstractAuthenticator
// {
//     public function supports(Request $request): ?bool
//     {
//         // TODO: Implement supports() method.
//     }

//     public function authenticate(Request $request): PassportInterface
//     {
//         // TODO: Implement authenticate() method.
//     }

//     public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
//     {
//         // TODO: Implement onAuthenticationSuccess() method.
//     }

//     public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
//     {
//         // TODO: Implement onAuthenticationFailure() method.
//     }

// //    public function start(Request $request, AuthenticationException $authException = null): Response
// //    {
// //        /*
// //         * If you would like this class to control what happens when an anonymous user accesses a
// //         * protected page (e.g. redirect to /login), uncomment this method and make this class
// //         * implement Symfony\Component\Security\Http\EntryPoint\AuthenticationEntrypointInterface.
// //         *
// //         * For more details, see https://symfony.com/doc/current/security/experimental_authenticators.html#configuring-the-authentication-entry-point
// //         */
// //    }
// }
