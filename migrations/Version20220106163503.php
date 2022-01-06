<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220106163503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE relance DROP FOREIGN KEY FK_50BBC12682EA2E54');
        $this->addSql('ALTER TABLE relance ADD CONSTRAINT FK_50BBC12682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE relance DROP FOREIGN KEY FK_50BBC12682EA2E54');
        $this->addSql('ALTER TABLE relance ADD CONSTRAINT FK_50BBC12682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
    }
}
