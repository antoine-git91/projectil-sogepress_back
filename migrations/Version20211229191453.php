<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211229191453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encart DROP FOREIGN KEY FK_E51EA1CDEBFABF3D');
        $this->addSql('DROP INDEX IDX_E51EA1CDEBFABF3D ON encart');
        $this->addSql('ALTER TABLE encart DROP support_magazine_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encart ADD support_magazine_id INT NOT NULL');
        $this->addSql('ALTER TABLE encart ADD CONSTRAINT FK_E51EA1CDEBFABF3D FOREIGN KEY (support_magazine_id) REFERENCES support_magazine (id)');
        $this->addSql('CREATE INDEX IDX_E51EA1CDEBFABF3D ON encart (support_magazine_id)');
    }
}
