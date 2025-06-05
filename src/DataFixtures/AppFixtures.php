<?php
// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
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
        // Utilisateur Admin
        $admin = new User();
        $admin->setFirstName('Admin');
        $admin->setLastName('User');
        $admin->setEmail('admin@admin.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setIsVerified(true);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'admin'));

        $manager->persist($admin);

        // Utilisateur Standard
        $user = new User();
        $user->setFirstName('John');
        $user->setLastName('Doe');
        $user->setEmail('user@example.com');
        $user->setRoles(['ROLE_USER']);
        $user->setIsVerified(false);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'password123'));

        $manager->persist($user);

        // Auteurs avec rôle ROLE_AUTHOR
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 9; $i++) {
            $author = new User();
            $author->setFirstName($faker->firstName());
            $author->setLastName($faker->lastName());
            $author->setEmail("author{$i}@test.com");
            $author->setRoles(['ROLE_AUTHOR']);
            $author->setIsVerified(true);
            $author->setPicture("assets/images/blog/author/{$i}.png");
            $author->setPassword($this->passwordHasher->hashPassword($author, 'password'));

            $manager->persist($author);

            // Ajout d’une référence pour les futures fixtures (blogs, commentaires, etc.)
            $this->addReference('author_' . $i, $author);
        }

        $manager->flush();
    }
}
