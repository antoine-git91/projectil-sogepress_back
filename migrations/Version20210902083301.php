<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902083301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE naf_classes ADD code VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE naf_divisions ADD code VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE naf_groupes ADD code VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE naf_sections ADD code VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE naf_sous_classes ADD code VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE naf_classes DROP code');
        $this->addSql('ALTER TABLE naf_divisions DROP code');
        $this->addSql('ALTER TABLE naf_groupes DROP code');
        $this->addSql('ALTER TABLE naf_sections DROP code');
        $this->addSql('ALTER TABLE naf_sous_classes DROP code');
    }
}
