<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;


class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $admin = new User();
        $admin->setEmail('admin@gmail.com');
        $admin->setFirstname($faker->firstname);
        $admin->setLastname($faker->lastname);
        $admin->setPassword($this->hasher->hashPassword($admin, 'admin'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $manager1 = new User();
        $manager1->setEmail('manager1@gmail.com');
        $manager1->setFirstname($faker->firstname);
        $manager1->setLastname($faker->lastname);
        $manager1->setPassword($this->hasher->hashPassword($manager1, 'manager'));
        $manager1->setRoles(['ROLE_MANAGER']);

        $manager2 = new User();
        $manager2->setEmail('manager2@gmail.com');
        $manager2->setFirstname($faker->firstname);
        $manager2->setLastname($faker->lastname);
        $manager2->setPassword($this->hasher->hashPassword($manager2, 'manager'));
        $manager2->setRoles(['ROLE_MANAGER']);


        $manager3 = new User();
        $manager3->setEmail('manager3@gmail.com');
        $manager3->setFirstname($faker->firstname);
        $manager3->setLastname($faker->lastname);
        $manager3->setPassword($this->hasher->hashPassword($manager3, 'manager'));
        $manager3->setRoles(['ROLE_MANAGER']);

        $manager->persist($manager1);
        $manager->persist($manager2);
        $manager->persist($manager3);

        $recruteur1 = new User();
        $recruteur1->setEmail('recruteur1@gmail.com');
        $recruteur1->setFirstname($faker->firstname);
        $recruteur1->setLastname($faker->lastname);
        $recruteur1->setPassword($this->hasher->hashPassword($recruteur1, 'recruteur'));
        $recruteur1->setRoles(['ROLE_RECRUTEUR']);

        $recruteur2 = new User();
        $recruteur2->setEmail('recruteur2@gmail.com');
        $recruteur2->setFirstname($faker->firstname);
        $recruteur2->setLastname($faker->lastname);
        $recruteur2->setPassword($this->hasher->hashPassword($recruteur2, 'recruteur'));
        $recruteur2->setRoles(['ROLE_RECRUTEUR']);

        $recruteur3 = new User();
        $recruteur3->setEmail('recruteur3@gmail.com');
        $recruteur3->setFirstname($faker->firstname);
        $recruteur3->setLastname($faker->lastname);
        $recruteur3->setPassword($this->hasher->hashPassword($recruteur3, 'recruteur'));
        $recruteur3->setRoles(['ROLE_RECRUTEUR']);

        $recruteur4 = new User();
        $recruteur4->setEmail('recruteur4@gmail.com');
        $recruteur4->setFirstname($faker->firstname);
        $recruteur4->setLastname($faker->lastname);
        $recruteur4->setPassword($this->hasher->hashPassword($recruteur4, 'recruteur'));
        $recruteur4->setRoles(['ROLE_RECRUTEUR']);

        $recruteur5 = new User();
        $recruteur5->setEmail('recruteur5@gmail.com');
        $recruteur5->setFirstname($faker->firstname);
        $recruteur5->setLastname($faker->lastname);
        $recruteur5->setPassword($this->hasher->hashPassword($recruteur5, 'recruteur'));
        $recruteur5->setRoles(['ROLE_RECRUTEUR']);

        $recruteur6 = new User();
        $recruteur6->setEmail('recruteur6@gmail.com');
        $recruteur6->setFirstname($faker->firstname);
        $recruteur6->setLastname($faker->lastname);
        $recruteur6->setPassword($this->hasher->hashPassword($recruteur6, 'recruteur'));
        $recruteur6->setRoles(['ROLE_RECRUTEUR']);

        $recruteur7 = new User();
        $recruteur7->setEmail('recruteur7@gmail.com');
        $recruteur7->setFirstname($faker->firstname);
        $recruteur7->setLastname($faker->lastname);
        $recruteur7->setPassword($this->hasher->hashPassword($recruteur7, 'recruteur'));
        $recruteur7->setRoles(['ROLE_RECRUTEUR']);

        $recruteur8 = new User();
        $recruteur8->setEmail('recruteur8@gmail.com');
        $recruteur8->setFirstname($faker->firstname);
        $recruteur8->setLastname($faker->lastname);
        $recruteur8->setPassword($this->hasher->hashPassword($recruteur8, 'recruteur'));
        $recruteur8->setRoles(['ROLE_RECRUTEUR']);



        $manager->persist($recruteur1);
        $manager->persist($recruteur2);
        $manager->persist($recruteur3);
        $manager->persist($recruteur4);
        $manager->persist($recruteur5);
        $manager->persist($recruteur6);
        $manager->persist($recruteur7);
        $manager->persist($recruteur8);


        for ($i = 1; $i <= 50; $i++) {
            $user = new User();
            $user->setEmail("user$i@gmail.com");
            $user->setFirstname($faker->firstname);
            $user->setLastname($faker->lastname);
            $user->setPassword($this->hasher->hashPassword($user, 'user'));
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
