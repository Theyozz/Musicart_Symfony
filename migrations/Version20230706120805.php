<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230706120805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nftcollection (id INT AUTO_INCREMENT NOT NULL, n_ft_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_6D3275B1D012FBE0 (n_ft_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nftcollection ADD CONSTRAINT FK_6D3275B1D012FBE0 FOREIGN KEY (n_ft_id) REFERENCES nft (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nftcollection DROP FOREIGN KEY FK_6D3275B1D012FBE0');
        $this->addSql('DROP TABLE nftcollection');
    }
}
