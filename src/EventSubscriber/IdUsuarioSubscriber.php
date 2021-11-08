<?php

namespace App\EventSubscriber;

use App\Entity\Tarea;
use Symfony\Component\Security\Core\Security;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class IdUsuarioSubscriber implements EventSubscriberInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setIdUsuario'],

        ];
    }

    public function setIdUsuario(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Tarea)) {
            return;
        }

        $idUsuario = $this->security->getUser();
        $entity->setIdUsuario($idUsuario);
    }

    /*public function setCreacion(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Tarea)) {
            return;
        }

        $creacion = new \DateTime('now');
        $entity->setCreacion($creacion);
    }*/
}
