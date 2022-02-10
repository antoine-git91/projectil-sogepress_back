<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220105103142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE edition_magazine ADD support_magazine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE edition_magazine ADD CONSTRAINT FK_799B23B1EBFABF3D FOREIGN KEY (support_magazine_id) REFERENCES support_magazine (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_799B23B1EBFABF3D ON edition_magazine (support_magazine_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE edition_magazine DROP FOREIGN KEY FK_799B23B1EBFABF3D');
        $this->addSql('DROP INDEX UNIQ_799B23B1EBFABF3D ON edition_magazine');
        $this->addSql('ALTER TABLE edition_magazine DROP support_magazine_id');
    }
}
