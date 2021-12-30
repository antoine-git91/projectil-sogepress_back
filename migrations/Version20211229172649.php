<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211229172649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_contenu (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contenu ADD type_contenu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contenu ADD CONSTRAINT FK_89C2003F211F12AD FOREIGN KEY (type_contenu_id) REFERENCES type_contenu (id)');
        $this->addSql('CREATE INDEX IDX_89C2003F211F12AD ON contenu (type_contenu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenu DROP FOREIGN KEY FK_89C2003F211F12AD');
        $this->addSql('DROP TABLE type_contenu');
        $this->addSql('DROP INDEX IDX_89C2003F211F12AD ON contenu');
        $this->addSql('ALTER TABLE contenu DROP type_contenu_id');
    }
}
