<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230831150635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nft CHANGE launch_date launch_date DATETIME NOT NULL, CHANGE launch_price_eur launch_price_eur DOUBLE PRECISION NOT NULL, CHANGE launch_price_eth launch_price_eth DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nft CHANGE launch_date launch_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE launch_price_eur launch_price_eur DOUBLE PRECISION DEFAULT NULL, CHANGE launch_price_eth launch_price_eth DOUBLE PRECISION DEFAULT NULL');
    }
}
