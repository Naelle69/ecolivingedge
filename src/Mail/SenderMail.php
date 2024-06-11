<?php

namespace App\Mail;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class SenderMail
{
    public $twig;
    public $mailer;
    public function __construct(MailerInterface $mailer, Environment $twig){
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /* #[Route('/')] */
    public function sendEmail($firstName, $lastName, $email): Void
    {
        $content = $this->twig->render('contact/mail.html.twig', ['firstname' => $firstName, 'lastName' => $lastName, 'email'=> $email]);
        $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html($content);

        $this->mailer->send($email);

        // ...
    }
}