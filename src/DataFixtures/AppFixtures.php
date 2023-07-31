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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

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

        $users = [];
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user
                ->setPseudo($faker->userName) 
                ->setPassword($this->hasher->hashPassword($user, $faker->password(10, 20)))
                ->setEmail($faker->freeEmail())
                ->setGender($faker->boolean(50))
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setBirthDate($faker->dateTimeBetween('-70 years', '-18 years'))
                ->setAddress($addresses[$i])
                ->setProfilPicture('../../../assets/photo-de-profil.png');

            $manager->persist($user);
            $users[] = $user;
        }



        $adminUser = new User();
        $adminUser
            ->setPseudo('admin')
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword($this->hasher->hashPassword($user, 'admin'))
            ->setEmail($faker->freeEmail())
            ->setGender($faker->boolean(50))
            ->setFirstname($faker->firstName())
            ->setLastname($faker->lastName())
            ->setBirthDate($faker->dateTime())
            ->setAddress($addresses[$i])
            ->setProfilPicture('../../../assets/photo-de-profil.png');

        $manager->persist($adminUser);


        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName($faker->word);

            $manager->persist($category);
        }

        $collections = [];
        for ($i = 0; $i < 5; $i++) {
            $nftCollection = new NFTCollection();
            $nftCollection
                ->setName($faker->word)
                ->setDescription($faker->text(300));

            $manager->persist($nftCollection);
            $collections[] = $nftCollection;
        }

        for ($i = 0; $i < 30; $i++) {
            $nft = new NFT();
            $nft
                ->setName($faker->word)
                ->setImg($faker->imageUrl(200, 200))
                ->setDescription($faker->realText(200))
                ->setLaunchDate($faker->dateTimeBetween('-2 years', 'now'))
                ->setLaunchPriceEur($faker->randomFloat(2, 1, 10000))
                ->setLaunchPriceEth($faker->randomFloat(3, 0.05, 100))
                ->setNFTCollection($faker->randomElement($collections))
                ->addCategory($category)
                ->setUser($faker->randomElement($users));

            $manager->persist($nft);
        }

        $manager->flush();
    }
}
