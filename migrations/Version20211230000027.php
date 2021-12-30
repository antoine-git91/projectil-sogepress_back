<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211230000027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE community_management DROP FOREIGN KEY FK_3A85E3532D69950E');
        $this->addSql('DROP INDEX IDX_3A85E3532D69950E ON community_management');
        $this->addSql('ALTER TABLE community_management DROP reseau_social_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE community_management ADD reseau_social_id INT NOT NULL');
        $this->addSql('ALTER TABLE community_management ADD CONSTRAINT FK_3A85E3532D69950E FOREIGN KEY (reseau_social_id) REFERENCES reseau_social (id)');
        $this->addSql('CREATE INDEX IDX_3A85E3532D69950E ON community_management (reseau_social_id)');
    }
}
