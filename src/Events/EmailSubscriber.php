<?php
namespace App\Events;

use App\Services\MailService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelEvents;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Etudiant;
use App\Entity\MediaObject;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class EmailSubscriber implements EventSubscriberInterface
{
 
    protected $mailService;
    
    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['sendMail', EventPriorities::POST_WRITE],
        ];
    }

    public function sendMail(ViewEvent $event)
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        // dd($event->getControllerResult()->getStatutBenef(),$event->getRequest()->getMethod());
        if ($user instanceof Etudiant && Request::METHOD_POST === $method
        ) {
            $this->mailService->sendEMail();      
        }
        if ($user instanceof Etudiant && Request::METHOD_PUT === $method && $event->getControllerResult()->getStatutBenef() =="acceptable"
        ) {
            $this->mailService->sendEmailStatut();      
        }
        if ($user instanceof Etudiant && Request::METHOD_PUT === $method && $event->getControllerResult()->getStatutBenef() =="actif"
        ) {
            $this->mailService->sendEmailStatutActif();      
        }
    }

}
?>