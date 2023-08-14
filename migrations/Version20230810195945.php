<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230810195945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nft CHANGE launch_date launch_date TIMESTAMP NOT NULL, CHANGE launch_price_eur launch_price_eur DOUBLE PRECISION NOT NULL, CHANGE launch_price_eth launch_price_eth DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', CHANGE birth_date birth_date DATE NOT NULL, CHANGE profil_picture profil_picture VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nft CHANGE launch_date launch_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE launch_price_eur launch_price_eur DOUBLE PRECISION DEFAULT NULL, CHANGE launch_price_eth launch_price_eth DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', CHANGE birth_date birth_date DATE DEFAULT NULL, CHANGE profil_picture profil_picture VARCHAR(255) DEFAULT \'../../../assets/photo-de-profil.png\'');
    }
}
