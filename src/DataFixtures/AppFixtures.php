<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création d’un utilisateur « admin »
        $admin = new User();
        $admin->setFirstName('Admin');
        $admin->setLastName('User');
        $admin->setEmail('admin@admin.com');
        $admin->setRoles(['ROLE_ADMIN']);
        // On marque ce compte comme vérifié (isVerified = true), puisque c'est un fixture
        $admin->setIsVerified(true);

        // Hash du mot de passe « admin »
        $hashedPassword = $this->passwordHasher->hashPassword($admin, 'admin');
        $admin->setPassword($hashedPassword);

        $manager->persist($admin);

        // Création d’un utilisateur « normal »
        $user = new User();
        $user->setFirstName('John');
        $user->setLastName('Doe');
        $user->setEmail('user@example.com');
        $user->setRoles(['ROLE_USER']);
        // On peut laisser isVerified à false pour simuler un compte non vérifié
        $user->setIsVerified(false);

        // Hash du mot de passe « password123 »
        $hashedUserPassword = $this->passwordHasher->hashPassword($user, 'password123');
        $user->setPassword($hashedUserPassword);

        $manager->persist($user);

        // Le createdAt et updatedAt seront automatiquement gérés par les callbacks Doctrine
        $manager->flush();
    }
}
