<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220105223809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenu DROP FOREIGN KEY FK_89C2003F82EA2E54');
        $this->addSql('ALTER TABLE contenu ADD CONSTRAINT FK_89C2003F82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE support_magazine DROP FOREIGN KEY FK_833AA4DB82EA2E54');
        $this->addSql('ALTER TABLE support_magazine ADD CONSTRAINT FK_833AA4DB82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE support_print DROP FOREIGN KEY FK_E76C6ABE82EA2E54');
        $this->addSql('ALTER TABLE support_print ADD CONSTRAINT FK_E76C6ABE82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenu DROP FOREIGN KEY FK_89C2003F82EA2E54');
        $this->addSql('ALTER TABLE contenu ADD CONSTRAINT FK_89C2003F82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE support_magazine DROP FOREIGN KEY FK_833AA4DB82EA2E54');
        $this->addSql('ALTER TABLE support_magazine ADD CONSTRAINT FK_833AA4DB82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE support_print DROP FOREIGN KEY FK_E76C6ABE82EA2E54');
        $this->addSql('ALTER TABLE support_print ADD CONSTRAINT FK_E76C6ABE82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
    }
}
