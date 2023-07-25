<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230724075614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD n_ft_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D012FBE0 FOREIGN KEY (n_ft_id) REFERENCES nft (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D012FBE0 ON user (n_ft_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D012FBE0');
        $this->addSql('DROP INDEX IDX_8D93D649D012FBE0 ON user');
        $this->addSql('ALTER TABLE user DROP n_ft_id');
    }
}
