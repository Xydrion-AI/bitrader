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
        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setRoles(['ROLE_USER']); // ou ['ROLE_ADMIN'] si vous ajoutez un rôle admin

        // Hash du mot de passe en « password123 »
        $hashed = $this->passwordHasher->hashPassword($user, 'admin');
        $user->setPassword($hashed);

        $manager->persist($user);
        $manager->flush();
    }
}

