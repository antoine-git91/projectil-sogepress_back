<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220105204857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE support_magazine ADD magazine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE support_magazine ADD CONSTRAINT FK_833AA4DB3EB84A1D FOREIGN KEY (magazine_id) REFERENCES magazine (id)');
        $this->addSql('CREATE INDEX IDX_833AA4DB3EB84A1D ON support_magazine (magazine_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE support_magazine DROP FOREIGN KEY FK_833AA4DB3EB84A1D');
        $this->addSql('DROP INDEX IDX_833AA4DB3EB84A1D ON support_magazine');
        $this->addSql('ALTER TABLE support_magazine DROP magazine_id');
    }
}
