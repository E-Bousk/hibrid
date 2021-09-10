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
 * In this class, we have method for :
 *
 * Displaying the registration page
 * Registering
 * Verifiying email
 * 
 */
class RegistrationController extends AbstractController
{
    private $emailVerifier;
    private $SqlInjection;

    public function __construct(EmailVerifier $emailVerifier, PreventSqlInjection $SqlInjection)
    {
        $this->emailVerifier = $emailVerifier;
        $this->SqlInjection= $SqlInjection;
    }

    /**
     * Registration page
     */
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator): Response
    {

        // don't show this registration page if user is already connected
        // if ($this->getUser()) {
        //     $this->addFlash('error', 'Vous êtes dejà connecté !');
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
            // Get data to replace potential malicious code
            $data= $form->getData();

            // Get, check and set string with the method 'replaceInData'
            $firstName= $data->getFirstName();
            $firstNameSafe= $this->SqlInjection->replaceInData($firstName);
            $user->setFirstName($firstNameSafe);

            $lastName= $data->getlastName();
            $lastNameSafe= $this->SqlInjection->replaceInData($lastName);
            $user->setLastName($lastNameSafe);

            $address= $data->getAddress();
            $addressSafe= $this->SqlInjection->replaceInData($address);
            $user->setAddress($addressSafe);
            
            // dd($user);


            // the 'getDoctrine' shortcut comes form 'AbstractController' which has been extended
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            

            // // generate a signed url and email it to the user
            // $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            //     (new TemplatedEmail())
            //         ->from(new Address('noreply@synerg-in.com', 'Synerg-in'))
            //         ->to($user->getEmail())
            //         ->subject('Merci de confirmer votre adressse Email')
            //         ->htmlTemplate('registration/confirmation_email.html.twig')
            // );

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

        $this->addFlash('success', 'Votre adresse email a bien été vérifiée');

        return $this->redirectToRoute('homepage');
    }
}
