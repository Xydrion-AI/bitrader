<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use App\Security\UsersAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier) {}

    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        UserAuthenticatorInterface $userAuthenticator,
        UsersAuthenticator $authenticator
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hash the password
            $plainPassword = $form->get('plainPassword')->getData();
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

            // Persist user
            $entityManager->persist($user);
            $entityManager->flush();

            // Send confirmation email
            try {
                $email = (new TemplatedEmail())
                    ->from(new Address('toto@toto.com', 'Bitrader Bot'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm Your Email')
                    ->htmlTemplate('emails/registration_confirmation.html.twig')
                    ->context([
                        'user' => $user,
                    ]);
                $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user, $email);
            } catch (\Throwable $e) {
                $this->addFlash('danger', 'Erreur lors de l’envoi de l’e-mail : ' . $e->getMessage());
                return $this->redirectToRoute('app_register');
            }

            // Authentifie l'utilisateur immédiatement
            $userAuthenticator->authenticateUser($user, $authenticator, $request);

            // Redirige vers page "check your email"
            return $this->redirectToRoute('app_check_email');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
