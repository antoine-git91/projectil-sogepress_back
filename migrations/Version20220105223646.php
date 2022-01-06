<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220105223646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE support_web DROP FOREIGN KEY FK_E74B1F982EA2E54');
        $this->addSql('ALTER TABLE support_web ADD CONSTRAINT FK_E74B1F982EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE support_web DROP FOREIGN KEY FK_E74B1F982EA2E54');
        $this->addSql('ALTER TABLE support_web ADD CONSTRAINT FK_E74B1F982EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
    }
}
