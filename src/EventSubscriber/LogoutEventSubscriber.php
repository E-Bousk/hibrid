<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Event\LogoutEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

/**
 * Class LogoutEventSubscriber | file LogoutEventSubscriber.php
 *
 * This class is used to display a message an redirect user on main page when loging out
 * In this class, we have methods to :
 *
 * Displaying flash message and redirecting on homepage
 * Restoring with custom TWIG filter the semicolon that has been replaced with '__SEMICOLON__' string
 * 
 */
class LogoutEventSubscriber implements EventSubscriberInterface
{
    private $flashBag;
    private $urlGenerator;

    public function __construct(FlashBagInterface $flashBag, UrlGeneratorInterface $urlGenerator)
    {
        $this->flashBag= $flashBag;
        $this->urlGenerator= $urlGenerator;
    }

    /**
     * Display a flash message and redirect on log out
     *
     * @param LogoutEvent $event
     * @return void
     */
    public function onLogoutEvent(LogoutEvent $event)
    {
        $this->flashBag->add('success', 'Vous êtes maintenant déconnecté !');

        $event->setResponse(new RedirectResponse($this->urlGenerator->generate('homepage')));
    }

    /**
     * subscribe on logout event
     *
     * @return void
     */
    public static function getSubscribedEvents()
    {
        return [
            LogoutEvent::class => 'onLogoutEvent',
        ];
    }
}
