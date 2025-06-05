<?php

namespace App\DataFixtures;

use App\Entity\Blogs;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Cocur\Slugify\Slugify;

class BlogFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 10; $i++) {
            $author = $this->getUserReference('author_' . rand(1, 9));
            $slugify = new Slugify();

            $blog = new Blogs();
            $blog->setTitle($title = $faker->sentence(6))
                ->setDescription($faker->paragraph(3))
                ->setTags($faker->randomElement(['Forex trading', 'Investment', 'Trading market']))
                ->setPicture("assets/images/blog/{$i}.png")
                ->setAuthor($author)
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setSlug($slugify->slugify($title));

            $manager->persist($blog);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AppFixtures::class,
        ];
    }

    private function getUserReference(string $name): User
    {
        /** @var User $user */
        $user = parent::getReference($name, User::class);
        return $user;
    }
}
