<?php

namespace App\DataFixtures;

use App\Entity\Teams;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $admin = $manager->getRepository(User::class)->findOneBy(['email' => 'admin@admin.com']);
        $user = $manager->getRepository(User::class)->findOneBy(['email' => 'user@example.com']);

        if (!$admin || !$user) {
            throw new \Exception('Les utilisateurs de référence ne sont pas trouvés. Exécute AppFixtures d’abord.');
        }

        $now = new \DateTimeImmutable();

        $teamsData = [
            [
                'user' => $admin,
                'picture' => 'assets/images/team/3.png',
                'first_name' => 'Maxime',
                'last_name' => 'Roux',
                'title' => 'Coach principale',
                'desciption' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at sem vel sapien vulputate convallis. Integer sed orci nec orci viverra luctus.',
            ],
            [
                'user' => $admin,
                'picture' => 'assets/images/team/2.png',
                'first_name' => 'Chloé',
                'last_name' => 'Fontaine',
                'title' => 'Développeur Symfony',
                'desciption' => 'Nulla facilisi. Sed luctus libero et ligula fermentum, ut lobortis libero vehicula. Donec vel augue vitae eros suscipit porttitor',
            ],
            [
                'user' => $admin,
                'picture' => 'assets/images/team/1.png',
                'first_name' => 'Lucas',
                'last_name' => 'Garnier',
                'title' => 'Designer UI/UX',
                'desciption' => 'Vivamus convallis, orci vel tincidunt placerat, lorem nisi malesuada risus, non tincidunt est erat a magna. Quisque ac nulla vitae arcu mattis rhoncus.',
            ],
            [
                'user' => $admin,
                'picture' => 'assets/images/team/4.png',
                'first_name' => 'Emma',
                'last_name' => 'Bernard',
                'title' => 'Coach principale',
                'desciption' => 'Suspendisse potenti. Duis vel metus non elit gravida tempus. Cras ac nisi dignissim, laoreet orci nec, pharetra mi.',
            ],
            [
                'user' => $admin,
                'picture' => 'assets/images/team/5.png',
                'first_name' => 'Julien',
                'last_name' => 'Marchand',
                'title' => 'Développeur Symfony',
                'desciption' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam hendrerit, leo nec egestas dignissim, justo nulla congue nisi, id pulvinar nulla felis nec ipsum.',
            ],
            [
                'user' => $admin,
                'picture' => 'assets/images/team/6.png',
                'first_name' => 'Camille',
                'last_name' => 'Morel',
                'title' => 'Designer UI/UX',
                'desciption' => 'Aliquam erat volutpat. Mauris viverra, lacus nec malesuada pretium, lacus justo eleifend metus, ut gravida risus lorem sit amet nunc.',
            ],
            [
                'user' => $admin,
                'picture' => 'assets/images/team/7.png',
                'first_name' => 'Thomas',
                'last_name' => 'Lefèvre',
                'title' => 'Développeur Symfony',
                'desciption' => 'Aenean vel erat vitae nibh euismod finibus. In hac habitasse platea dictumst. Vestibulum at dolor sit amet nulla bibendum accumsan.',
            ],
            [
                'user' => $admin,
                'picture' => 'assets/images/team/8.png',
                'first_name' => 'Léa',
                'last_name' => 'Dubois',
                'title' => 'Designer UI/UX',
                'desciption' => 'Phasellus in purus rutrum, imperdiet magna ac, euismod metus. Nam ut lorem sed sapien facilisis laoreet. Nulla a ex ac metus ullamcorper fringilla.',
            ],
        ];

        foreach ($teamsData as $data) {
            $team = new Teams();
            $team->setUser($data['user']);
            $team->setPicture($data['picture']);
            $team->setFirstName($data['first_name']);
            $team->setLastName($data['last_name']);
            $team->setTitle($data['title']);
            $team->setDesciption($data['desciption']);
            $team->setCreatedAt($now);
            $team->setUpdatedAt($now);

            $manager->persist($team);
        }

        $manager->flush();
    }
}
