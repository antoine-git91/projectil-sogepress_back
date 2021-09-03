<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210903090019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE potentialite (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, magazine_id INT DEFAULT NULL, type_potentialite_id INT NOT NULL, commentaire LONGTEXT DEFAULT NULL, INDEX IDX_6377138319EB6921 (client_id), INDEX IDX_637713833EB84A1D (magazine_id), INDEX IDX_63771383DD8851F3 (type_potentialite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE potentialite ADD CONSTRAINT FK_6377138319EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE potentialite ADD CONSTRAINT FK_637713833EB84A1D FOREIGN KEY (magazine_id) REFERENCES magazine (id)');
        $this->addSql('ALTER TABLE potentialite ADD CONSTRAINT FK_63771383DD8851F3 FOREIGN KEY (type_potentialite_id) REFERENCES type_potentialite (id)');
        $this->addSql('DROP TABLE potentialites');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE potentialites (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, magazine_id INT DEFAULT NULL, type_potentialite_id INT NOT NULL, commentaire LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_6FDC6A8219EB6921 (client_id), INDEX IDX_6FDC6A823EB84A1D (magazine_id), INDEX IDX_6FDC6A82DD8851F3 (type_potentialite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE potentialites ADD CONSTRAINT FK_6FDC6A8219EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE potentialites ADD CONSTRAINT FK_6FDC6A823EB84A1D FOREIGN KEY (magazine_id) REFERENCES magazine (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE potentialites ADD CONSTRAINT FK_6FDC6A82DD8851F3 FOREIGN KEY (type_potentialite_id) REFERENCES type_potentialite (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE potentialite');
    }
}
