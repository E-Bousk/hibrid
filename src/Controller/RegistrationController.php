<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use App\Security\LoginFormAuthenticator;
use App\Security\PreventSqlInjection;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

/**
 * Class RegistrationController | file RegistrationController.php
 *
 * In this class, we have methods for :
 *
 * Displaying the registration page
 * Registering
 * Verifiying email
 * escaping potential SQL injection
 * 
 */
class RegistrationController extends AbstractController
{
    private $emailVerifier;
    private $PreventSqlInjection;

    public function __construct(EmailVerifier $emailVerifier, PreventSqlInjection $PreventSqlInjection)
    {
        $this->emailVerifier = $emailVerifier;
        $this->PreventSqlInjection= $PreventSqlInjection;
    }

    /**
     * Registration page
     * 
     * @param Request $request
     * @param UserPasswordHasherInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param LoginFormAuthenticator $authenticator
     * @return Response
     */
    #[Route('/register', name: 'app_register', defaults:['_public_access' => true])]
    public function register(
                        Request $request,
                        UserPasswordHasherInterface $passwordEncoder,
                        GuardAuthenticatorHandler $guardHandler,
                        LoginFormAuthenticator $authenticator
                    ): Response
    {

        // don't show this registration page if user is already connected
        // if ($this->getUser()) {
        //     $this->addFlash('error', 'Vous ??tes dej?? connect?? !');
        //     return $this->redirectToRoute('homepage');
        // }

        $user = new User;

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $passwordEncoder->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                    )
                );


            /** *************************************
             ** MALICIOUS SQL INJECTION PREVENTION **
             ************************************* */
            // Get, check and set string with the method 'replaceInData'
            $user->setFirstName($this->PreventSqlInjection->replaceInData($form->getData()->getFirstName()));
            $user->setLastName($this->PreventSqlInjection->replaceInData($form->getData()->getlastName()));
            $user->setAddress($this->PreventSqlInjection->replaceInData($form->getData()->getAddress()));
            
            // dd($user);


            // the 'getDoctrine' shortcut comes form 'AbstractController' which has been extended
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address(
                        $this->getParameter('app.mail_from_address'),
                        $this->getParameter('app.mail_from_name'),
                        ))
                    ->to($user->getEmail())
                    ->subject('Merci de confirmer votre adressse Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * Verify email page
     *
     * @param Request $request
     * @param TranslatorInterface $translator
     * @return Response
     */
    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator ): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            // use 'TranslatorInterface' to get translation in French (with 'messages.fr.yaml)
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason()));

            return $this->redirectToRoute('app_register');
        }

        $this->addFlash('success', 'Votre adresse email a bien ??t?? v??rifi??e');

        return $this->redirectToRoute('homepage');
    }
}
