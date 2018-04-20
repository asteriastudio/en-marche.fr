<?php

namespace AppBundle\RepublicanSilence;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class CheckRepublicanSilenceListener implements EventSubscriberInterface
{
    private const ROUTES = [
        'app_referent_users',
        
    ];

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onRequest',
        ];
    }

    public function onRequest(GetResponseEvent $event): void
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }

        if (!$this->supportRoute($event->getRequest()->attributes->get('_route'))) {
            return;
        }

        dump($event);
    }

    private function supportRoute(string $route): bool
    {
        return \in_array($route, self::ROUTES, true);
    }
}
