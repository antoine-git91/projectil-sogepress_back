<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210831123703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_contact (commande_id INT NOT NULL, contact_id INT NOT NULL, INDEX IDX_BAD9949882EA2E54 (commande_id), INDEX IDX_BAD99498E7A1254A (contact_id), PRIMARY KEY(commande_id, contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE community_management (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, reseau_social TINYINT(1) NOT NULL, post_mensuel INT NOT NULL, UNIQUE INDEX UNIQ_3A85E35382EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contenu (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, type_contenu TINYINT(1) NOT NULL, feuillets INT NOT NULL, UNIQUE INDEX UNIQ_89C2003F82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE encart (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, support_magazine_id INT NOT NULL, emplacement TINYINT(1) NOT NULL, format TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_E51EA1CD82EA2E54 (commande_id), INDEX IDX_E51EA1CDEBFABF3D (support_magazine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_client (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, contact_id INT NOT NULL, user_id INT NOT NULL, commande_id INT DEFAULT NULL, type_commentaire TINYINT(1) NOT NULL, commentaire LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E06A40919EB6921 (client_id), INDEX IDX_E06A409E7A1254A (contact_id), INDEX IDX_E06A409A76ED395 (user_id), INDEX IDX_E06A40982EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE magazine (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, support_magazine_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_378C2FE419EB6921 (client_id), INDEX IDX_378C2FE4EBFABF3D (support_magazine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE naf_classes (id INT AUTO_INCREMENT NOT NULL, naf_groupe_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_6BFEDB6324A41097 (naf_groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE naf_divisions (id INT AUTO_INCREMENT NOT NULL, naf_sections_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_5F25292AB54B47D8 (naf_sections_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE naf_groupes (id INT AUTO_INCREMENT NOT NULL, naf_divisions_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_3E70C37F5CD94DF5 (naf_divisions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE naf_sections (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE naf_sous_classes (id INT AUTO_INCREMENT NOT NULL, naf_classe_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_E69484ED1BF8012 (naf_classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relance (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, commande_id INT DEFAULT NULL, type_relance TINYINT(1) NOT NULL, objet VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, date_echeance DATE NOT NULL, statut TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_50BBC12619EB6921 (client_id), INDEX IDX_50BBC12682EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE support_magazine (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, format TINYINT(1) NOT NULL, pages INT NOT NULL, quantite INT NOT NULL, edition VARCHAR(255) NOT NULL, fin_commercialisation DATE NOT NULL, UNIQUE INDEX UNIQ_833AA4DB82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE support_print (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, type_print TINYINT(1) NOT NULL, quantite INT NOT NULL, UNIQUE INDEX UNIQ_E76C6ABE82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE support_web (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, type_prestation TINYINT(1) NOT NULL, type_site TINYINT(1) DEFAULT NULL, url VARCHAR(255) NOT NULL, echeance_contrat DATE DEFAULT NULL, UNIQUE INDEX UNIQ_E74B1F982EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_contact ADD CONSTRAINT FK_BAD9949882EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_contact ADD CONSTRAINT FK_BAD99498E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE community_management ADD CONSTRAINT FK_3A85E35382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE contenu ADD CONSTRAINT FK_89C2003F82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE encart ADD CONSTRAINT FK_E51EA1CD82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE encart ADD CONSTRAINT FK_E51EA1CDEBFABF3D FOREIGN KEY (support_magazine_id) REFERENCES support_magazine (id)');
        $this->addSql('ALTER TABLE historique_client ADD CONSTRAINT FK_E06A40919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE historique_client ADD CONSTRAINT FK_E06A409E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE historique_client ADD CONSTRAINT FK_E06A409A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE historique_client ADD CONSTRAINT FK_E06A40982EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE magazine ADD CONSTRAINT FK_378C2FE419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE magazine ADD CONSTRAINT FK_378C2FE4EBFABF3D FOREIGN KEY (support_magazine_id) REFERENCES support_magazine (id)');
        $this->addSql('ALTER TABLE naf_classes ADD CONSTRAINT FK_6BFEDB6324A41097 FOREIGN KEY (naf_groupe_id) REFERENCES naf_groupes (id)');
        $this->addSql('ALTER TABLE naf_divisions ADD CONSTRAINT FK_5F25292AB54B47D8 FOREIGN KEY (naf_sections_id) REFERENCES naf_sections (id)');
        $this->addSql('ALTER TABLE naf_groupes ADD CONSTRAINT FK_3E70C37F5CD94DF5 FOREIGN KEY (naf_divisions_id) REFERENCES naf_divisions (id)');
        $this->addSql('ALTER TABLE naf_sous_classes ADD CONSTRAINT FK_E69484ED1BF8012 FOREIGN KEY (naf_classe_id) REFERENCES naf_classes (id)');
        $this->addSql('ALTER TABLE relance ADD CONSTRAINT FK_50BBC12619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE relance ADD CONSTRAINT FK_50BBC12682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE support_magazine ADD CONSTRAINT FK_833AA4DB82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE support_print ADD CONSTRAINT FK_E76C6ABE82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE support_web ADD CONSTRAINT FK_E74B1F982EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande ADD client_id INT NOT NULL, ADD user_id INT NOT NULL, ADD statut TINYINT(1) NOT NULL, ADD facturation INT NOT NULL, ADD reduction INT DEFAULT NULL, ADD debut DATE DEFAULT NULL, ADD fin DATE DEFAULT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D19EB6921 ON commande (client_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA76ED395 ON commande (user_id)');
        $this->addSql('ALTER TABLE potentialites ADD magazine_id INT DEFAULT NULL, ADD type_potentialite TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE potentialites ADD CONSTRAINT FK_6FDC6A823EB84A1D FOREIGN KEY (magazine_id) REFERENCES magazine (id)');
        $this->addSql('CREATE INDEX IDX_6FDC6A823EB84A1D ON potentialites (magazine_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE potentialites DROP FOREIGN KEY FK_6FDC6A823EB84A1D');
        $this->addSql('ALTER TABLE naf_sous_classes DROP FOREIGN KEY FK_E69484ED1BF8012');
        $this->addSql('ALTER TABLE naf_groupes DROP FOREIGN KEY FK_3E70C37F5CD94DF5');
        $this->addSql('ALTER TABLE naf_classes DROP FOREIGN KEY FK_6BFEDB6324A41097');
        $this->addSql('ALTER TABLE naf_divisions DROP FOREIGN KEY FK_5F25292AB54B47D8');
        $this->addSql('ALTER TABLE encart DROP FOREIGN KEY FK_E51EA1CDEBFABF3D');
        $this->addSql('ALTER TABLE magazine DROP FOREIGN KEY FK_378C2FE4EBFABF3D');
        $this->addSql('DROP TABLE commande_contact');
        $this->addSql('DROP TABLE community_management');
        $this->addSql('DROP TABLE contenu');
        $this->addSql('DROP TABLE encart');
        $this->addSql('DROP TABLE historique_client');
        $this->addSql('DROP TABLE magazine');
        $this->addSql('DROP TABLE naf_classes');
        $this->addSql('DROP TABLE naf_divisions');
        $this->addSql('DROP TABLE naf_groupes');
        $this->addSql('DROP TABLE naf_sections');
        $this->addSql('DROP TABLE naf_sous_classes');
        $this->addSql('DROP TABLE relance');
        $this->addSql('DROP TABLE support_magazine');
        $this->addSql('DROP TABLE support_print');
        $this->addSql('DROP TABLE support_web');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('DROP INDEX IDX_6EEAA67D19EB6921 ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DA76ED395 ON commande');
        $this->addSql('ALTER TABLE commande DROP client_id, DROP user_id, DROP statut, DROP facturation, DROP reduction, DROP debut, DROP fin, DROP created_at, DROP updated_at');
        $this->addSql('DROP INDEX IDX_6FDC6A823EB84A1D ON potentialites');
        $this->addSql('ALTER TABLE potentialites DROP magazine_id, DROP type_potentialite');
    }
}
