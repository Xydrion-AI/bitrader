<?php

namespace App\Controller;

use App\Entity\NewsletterSubscriber;
use App\Form\NewsletterFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class NewsletterController extends AbstractController
{
    public function subscribe(Request $request, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        $subscriber = new NewsletterSubscriber();
        $form = $this->createForm(NewsletterFormType::class, $subscriber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subscriber->setSubscribedAt(new \DateTime());

            $existing = $em->getRepository(NewsletterSubscriber::class)->findOneBy(['email' => $subscriber->getEmail()]);
            if (!$existing) {
                $em->persist($subscriber);
                $em->flush();

                $email = (new Email())
                    ->from('no-reply@yoursite.com')
                    ->to($subscriber->getEmail())
                    ->subject('Welcome to our newsletter!')
                    ->html("<p>Thank you for your registration 🎉</p>");

                try {
                    $mailer->send($email);
                    $this->addFlash('success', 'Thank you! You have successfully subscribed to the newsletter. A confirmation email has been sent.');
                } catch (TransportExceptionInterface $e) {
                    $this->addFlash('warning', 'You are subscribed, but the confirmation email could not be sent. Please check your email later.');
                }
            } else {
                $this->addFlash('info', 'This email is already registered.');
            }

            return $this->redirect($request->headers->get('referer') ?? '/');
        }

        return $this->render('pages/newsletter/subscribe.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
