<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211229195326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encart ADD edition_magazine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE encart ADD CONSTRAINT FK_E51EA1CD7BA96CC3 FOREIGN KEY (edition_magazine_id) REFERENCES edition_magazine (id)');
        $this->addSql('CREATE INDEX IDX_E51EA1CD7BA96CC3 ON encart (edition_magazine_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encart DROP FOREIGN KEY FK_E51EA1CD7BA96CC3');
        $this->addSql('DROP INDEX IDX_E51EA1CD7BA96CC3 ON encart');
        $this->addSql('ALTER TABLE encart DROP edition_magazine_id');
    }
}
