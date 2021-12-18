<?php
namespace App\Services;

use App\Entity\Etudiant;
use App\Repository\AdminRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Repository\EtudiantRepository;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailService
{
    private $mailer;
    private $etudiantRepository;
    private $adminRepository;

    public function __construct(
        MailerInterface $mailer,
        EtudiantRepository $etudiantRepository,
        AdminRepository $adminRepository
    )
    {
        $this->mailer = $mailer;
        $this->etudiantRepository = $etudiantRepository;
        $this->adminRepository = $adminRepository;
    }

    public function sendEmail() : Response
    {
        $etudiant = $this->etudiantRepository->findOneBy([],['id' => 'desc']);
        $admins = $this->adminRepository->findAll();
        $email = (new TemplatedEmail())
            ->from('oriestmsp@gmail.com')
            ->to($etudiant->getEmail())
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Inscription Reussi !')
            // path of the Twig template to render
            ->htmlTemplate('mail/mail.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'etudiant' => $etudiant,
            ]);
            $this->mailer->send($email);
            foreach($admins as $admin)
            {
            $email2 = (new TemplatedEmail())
            ->from('oriestmsp@gmail.com')
            ->to($admin->getEmail())
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Une personne est inscrite !')
            // path of the Twig template to render
            ->htmlTemplate('mail/mailAdmin.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'etudiant' => $etudiant,
            ]);
                $this->mailer->send($email2);

            }

       return new RedirectResponse('/');
        // ...
    }

    public function sendEmailStatut() : Response
    {
        $etudiant = $this->etudiantRepository->findOneBy([],['id' => 'desc']);
        $email = (new TemplatedEmail())
            ->from('oriestmsp@gmail.com')
            ->to($etudiant->getEmail())
            ->subject('Accès Autorisé !')
            ->htmlTemplate('mail/mailStatut.html.twig')
            ->context([
                'etudiant' => $etudiant,
            ]);
            $this->mailer->send($email);
       return new RedirectResponse('/');
        // ...
    }
    public function sendEmailStatutActif() : Response
    {
        $etudiant = $this->etudiantRepository->findOneBy([],['id' => 'desc']);
        $email = (new TemplatedEmail())
            ->from('oriestmsp@gmail.com')
            ->to($etudiant->getEmail())
            ->subject('Accès Autorisé !')
            ->htmlTemplate('mail/mailStatutActif.html.twig')
            ->context([
                'etudiant' => $etudiant,
            ]);
            $this->mailer->send($email);
       return new RedirectResponse('/');
        // ...
    }
}
?>