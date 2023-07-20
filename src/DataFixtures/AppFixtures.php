<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Category;
use App\Entity\NFT;
use App\Entity\NFTCollection;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');


        $addresses = [];
        for ($i = 0; $i < 6; $i++) {
            $userAddress = new Address();
            $userAddress
                ->setCity($faker->city())
                ->setZIPCode($faker->postcode())
                ->setStreet($faker->streetAddress());

            $manager->persist($userAddress);
            $addresses[] = $userAddress;
        }

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user
                ->setPseudo($faker->realText(10))
                ->setPassword($faker->password(10, 20))
                ->setEmail($faker->freeEmail())
                ->setGender($faker->boolean(50))
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setBirthDate($faker->dateTime())
                ->setAddress($addresses[$i]);

            $manager->persist($user);
        }


        $adminUser = new User();
        $adminUser
            ->setPseudo($faker->realText(10))
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword($faker->password(10, 20))
            ->setEmail($faker->freeEmail())
            ->setGender($faker->boolean(50))
            ->setFirstname($faker->firstName())
            ->setLastname($faker->lastName())
            ->setBirthDate($faker->dateTime())
            ->setAddress($addresses[$i]);

        $manager->persist($adminUser);


        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName($faker->realText(10));

            $manager->persist($category);
        }

        $collections = [];
        for ($i = 0; $i < 5; $i++) {
            $nftCollection = new NFTCollection();
            $nftCollection
                ->setName($faker->realText(10));

            $manager->persist($nftCollection);
            $collections[] = $nftCollection;

        }

        for ($i = 0; $i < 5; $i++) {
        $nft = new NFT();
        $nft
            ->setName($faker->realText(10))
            ->setImg($faker->imageUrl(200, 200))
            ->setDescription($faker->realText(200))
            ->setLaunchDate($faker->dateTime())
            ->setLaunchPriceEur($faker->randomFloat(2, 1, 1000))
            ->setLaunchPriceEth($faker->randomFloat(2, 0.5, 100))
            ->addNFTCollection($collections[$i])
            ->addCategory($category);

        $manager->persist($nft);
        }

        $manager->flush();
    }
}
