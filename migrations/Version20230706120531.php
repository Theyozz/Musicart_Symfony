<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230706120531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nft_category (nft_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_33F048EFE813668D (nft_id), INDEX IDX_33F048EF12469DE2 (category_id), PRIMARY KEY(nft_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nft_category ADD CONSTRAINT FK_33F048EFE813668D FOREIGN KEY (nft_id) REFERENCES nft (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nft_category ADD CONSTRAINT FK_33F048EF12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nft_category DROP FOREIGN KEY FK_33F048EFE813668D');
        $this->addSql('ALTER TABLE nft_category DROP FOREIGN KEY FK_33F048EF12469DE2');
        $this->addSql('DROP TABLE nft_category');
    }
}
