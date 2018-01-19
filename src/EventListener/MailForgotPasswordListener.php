<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use App\Event\EmailForgotPasswordEvent;

class MailForgotPasswordListener
{
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function onMailForgotPasswordEvent(EmailForgotPasswordEvent $event): void
    {
        $user = $event->getUser();
        $email = $event->getUser()->getEmail();
        $password = $event->getUser()->getPassword();

        $message = (new \Swift_Message('Request Reset Password Successfully!'))
            ->setFrom($email)
            ->setTo($email)
            ->setBody('Request Reset Password Successfully! This is your new password: ' . $password)
    /*
            ->setBody(
                $this->renderView(
                    // app/Resources/views/Emails/registration.html.twig
                    'emails/forgotPassword.html.twig',
                    array('name' => $name)
                ),
                'text/html'
            )
    */
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/forgotPassword.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;

        $this->mailer->send($message);
    }
}
