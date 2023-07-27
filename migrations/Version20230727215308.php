<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230727215308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nft ADD nft_collection_id INT NOT NULL');
        $this->addSql('ALTER TABLE nft ADD CONSTRAINT FK_D9C7463C327C6A9D FOREIGN KEY (nft_collection_id) REFERENCES nftcollection (id)');
        $this->addSql('CREATE INDEX IDX_D9C7463C327C6A9D ON nft (nft_collection_id)');
        $this->addSql('ALTER TABLE nftcollection DROP FOREIGN KEY FK_6D3275B1D012FBE0');
        $this->addSql('DROP INDEX IDX_6D3275B1D012FBE0 ON nftcollection');
        $this->addSql('ALTER TABLE nftcollection DROP n_ft_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nft DROP FOREIGN KEY FK_D9C7463C327C6A9D');
        $this->addSql('DROP INDEX IDX_D9C7463C327C6A9D ON nft');
        $this->addSql('ALTER TABLE nft DROP nft_collection_id');
        $this->addSql('ALTER TABLE nftcollection ADD n_ft_id INT NOT NULL');
        $this->addSql('ALTER TABLE nftcollection ADD CONSTRAINT FK_6D3275B1D012FBE0 FOREIGN KEY (n_ft_id) REFERENCES nft (id)');
        $this->addSql('CREATE INDEX IDX_6D3275B1D012FBE0 ON nftcollection (n_ft_id)');
    }
}
