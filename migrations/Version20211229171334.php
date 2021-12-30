<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211229171334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_print (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE support_print ADD type_print_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE support_print ADD CONSTRAINT FK_E76C6ABEBDE1450 FOREIGN KEY (type_print_id) REFERENCES type_print (id)');
        $this->addSql('CREATE INDEX IDX_E76C6ABEBDE1450 ON support_print (type_print_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE support_print DROP FOREIGN KEY FK_E76C6ABEBDE1450');
        $this->addSql('DROP TABLE type_print');
        $this->addSql('DROP INDEX IDX_E76C6ABEBDE1450 ON support_print');
        $this->addSql('ALTER TABLE support_print DROP type_print_id');
    }
}
