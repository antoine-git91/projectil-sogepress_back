<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210901084142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_status (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emplacement_magazine (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE format_encart (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reseau_social (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_historique (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_potentialite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_prestation_web (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_print (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_site_web (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse CHANGE type_adresse statut_adresse TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE commande ADD statut_id INT NOT NULL, DROP statut');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF6203804 FOREIGN KEY (statut_id) REFERENCES commande_status (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DF6203804 ON commande (statut_id)');
        $this->addSql('ALTER TABLE community_management ADD reseau_social_id INT NOT NULL, DROP reseau_social');
        $this->addSql('ALTER TABLE community_management ADD CONSTRAINT FK_3A85E3532D69950E FOREIGN KEY (reseau_social_id) REFERENCES reseau_social (id)');
        $this->addSql('CREATE INDEX IDX_3A85E3532D69950E ON community_management (reseau_social_id)');
        $this->addSql('ALTER TABLE encart ADD emplacement_id INT NOT NULL, ADD format_id INT NOT NULL, DROP emplacement, DROP format');
        $this->addSql('ALTER TABLE encart ADD CONSTRAINT FK_E51EA1CDC4598A51 FOREIGN KEY (emplacement_id) REFERENCES emplacement_magazine (id)');
        $this->addSql('ALTER TABLE encart ADD CONSTRAINT FK_E51EA1CDD629F605 FOREIGN KEY (format_id) REFERENCES format_encart (id)');
        $this->addSql('CREATE INDEX IDX_E51EA1CDC4598A51 ON encart (emplacement_id)');
        $this->addSql('CREATE INDEX IDX_E51EA1CDD629F605 ON encart (format_id)');
        $this->addSql('ALTER TABLE historique_client ADD type_historique_id INT NOT NULL, DROP type_commentaire');
        $this->addSql('ALTER TABLE historique_client ADD CONSTRAINT FK_E06A40911C5C46B FOREIGN KEY (type_historique_id) REFERENCES type_historique (id)');
        $this->addSql('CREATE INDEX IDX_E06A40911C5C46B ON historique_client (type_historique_id)');
        $this->addSql('ALTER TABLE potentialites ADD type_potentialite_id INT NOT NULL, DROP type_potentialite');
        $this->addSql('ALTER TABLE potentialites ADD CONSTRAINT FK_6FDC6A82DD8851F3 FOREIGN KEY (type_potentialite_id) REFERENCES type_potentialite (id)');
        $this->addSql('CREATE INDEX IDX_6FDC6A82DD8851F3 ON potentialites (type_potentialite_id)');
        $this->addSql('ALTER TABLE support_magazine DROP format');
        $this->addSql('ALTER TABLE support_print ADD type_print_id INT NOT NULL, DROP type_print');
        $this->addSql('ALTER TABLE support_print ADD CONSTRAINT FK_E76C6ABEBDE1450 FOREIGN KEY (type_print_id) REFERENCES type_print (id)');
        $this->addSql('CREATE INDEX IDX_E76C6ABEBDE1450 ON support_print (type_print_id)');
        $this->addSql('ALTER TABLE support_web ADD type_prestation_id INT NOT NULL, ADD type_site_id INT NOT NULL, DROP type_prestation, DROP type_site');
        $this->addSql('ALTER TABLE support_web ADD CONSTRAINT FK_E74B1F9EEA87261 FOREIGN KEY (type_prestation_id) REFERENCES type_prestation_web (id)');
        $this->addSql('ALTER TABLE support_web ADD CONSTRAINT FK_E74B1F9DE9C79B3 FOREIGN KEY (type_site_id) REFERENCES type_site_web (id)');
        $this->addSql('CREATE INDEX IDX_E74B1F9EEA87261 ON support_web (type_prestation_id)');
        $this->addSql('CREATE INDEX IDX_E74B1F9DE9C79B3 ON support_web (type_site_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF6203804');
        $this->addSql('ALTER TABLE encart DROP FOREIGN KEY FK_E51EA1CDC4598A51');
        $this->addSql('ALTER TABLE encart DROP FOREIGN KEY FK_E51EA1CDD629F605');
        $this->addSql('ALTER TABLE community_management DROP FOREIGN KEY FK_3A85E3532D69950E');
        $this->addSql('ALTER TABLE historique_client DROP FOREIGN KEY FK_E06A40911C5C46B');
        $this->addSql('ALTER TABLE potentialites DROP FOREIGN KEY FK_6FDC6A82DD8851F3');
        $this->addSql('ALTER TABLE support_web DROP FOREIGN KEY FK_E74B1F9EEA87261');
        $this->addSql('ALTER TABLE support_print DROP FOREIGN KEY FK_E76C6ABEBDE1450');
        $this->addSql('ALTER TABLE support_web DROP FOREIGN KEY FK_E74B1F9DE9C79B3');
        $this->addSql('DROP TABLE commande_status');
        $this->addSql('DROP TABLE emplacement_magazine');
        $this->addSql('DROP TABLE format_encart');
        $this->addSql('DROP TABLE reseau_social');
        $this->addSql('DROP TABLE type_historique');
        $this->addSql('DROP TABLE type_potentialite');
        $this->addSql('DROP TABLE type_prestation_web');
        $this->addSql('DROP TABLE type_print');
        $this->addSql('DROP TABLE type_site_web');
        $this->addSql('ALTER TABLE adresse CHANGE statut_adresse type_adresse TINYINT(1) NOT NULL');
        $this->addSql('DROP INDEX IDX_6EEAA67DF6203804 ON commande');
        $this->addSql('ALTER TABLE commande ADD statut TINYINT(1) NOT NULL, DROP statut_id');
        $this->addSql('DROP INDEX IDX_3A85E3532D69950E ON community_management');
        $this->addSql('ALTER TABLE community_management ADD reseau_social TINYINT(1) NOT NULL, DROP reseau_social_id');
        $this->addSql('DROP INDEX IDX_E51EA1CDC4598A51 ON encart');
        $this->addSql('DROP INDEX IDX_E51EA1CDD629F605 ON encart');
        $this->addSql('ALTER TABLE encart ADD emplacement TINYINT(1) NOT NULL, ADD format TINYINT(1) NOT NULL, DROP emplacement_id, DROP format_id');
        $this->addSql('DROP INDEX IDX_E06A40911C5C46B ON historique_client');
        $this->addSql('ALTER TABLE historique_client ADD type_commentaire TINYINT(1) NOT NULL, DROP type_historique_id');
        $this->addSql('DROP INDEX IDX_6FDC6A82DD8851F3 ON potentialites');
        $this->addSql('ALTER TABLE potentialites ADD type_potentialite TINYINT(1) NOT NULL, DROP type_potentialite_id');
        $this->addSql('ALTER TABLE support_magazine ADD format TINYINT(1) NOT NULL');
        $this->addSql('DROP INDEX IDX_E76C6ABEBDE1450 ON support_print');
        $this->addSql('ALTER TABLE support_print ADD type_print TINYINT(1) NOT NULL, DROP type_print_id');
        $this->addSql('DROP INDEX IDX_E74B1F9EEA87261 ON support_web');
        $this->addSql('DROP INDEX IDX_E74B1F9DE9C79B3 ON support_web');
        $this->addSql('ALTER TABLE support_web ADD type_prestation TINYINT(1) NOT NULL, ADD type_site TINYINT(1) DEFAULT NULL, DROP type_prestation_id, DROP type_site_id');
    }
}
