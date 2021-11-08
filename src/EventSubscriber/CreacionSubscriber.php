<?php

namespace App\EventSubscriber;

use App\Entity\Tarea;
use Symfony\Component\Security\Core\Security;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CreacionSubscriber implements EventSubscriberInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreacion'],
        ];
    }

    public function setCreacion(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Tarea)) {
            return;
        }

        $creacion = new \DateTime('now');
        $entity->setCreacion($creacion);
    }
}
