<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902072525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD naf_sous_classe_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045598937D94 FOREIGN KEY (naf_sous_classe_id) REFERENCES naf_sous_classes (id)');
        $this->addSql('CREATE INDEX IDX_C744045598937D94 ON client (naf_sous_classe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045598937D94');
        $this->addSql('DROP INDEX IDX_C744045598937D94 ON client');
        $this->addSql('ALTER TABLE client DROP naf_sous_classe_id');
    }
}
