<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220105215814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE magazine ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE magazine ADD CONSTRAINT FK_378C2FE419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_378C2FE419EB6921 ON magazine (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE magazine DROP FOREIGN KEY FK_378C2FE419EB6921');
        $this->addSql('DROP INDEX IDX_378C2FE419EB6921 ON magazine');
        $this->addSql('ALTER TABLE magazine DROP client_id');
    }
}
