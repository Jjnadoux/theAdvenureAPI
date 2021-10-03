<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211001234840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adventure ADD CONSTRAINT FK_9E858E0F937AB034 FOREIGN KEY (`character`) REFERENCES `character` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9E858E0F937AB034 ON adventure (`character`)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adventure DROP FOREIGN KEY FK_9E858E0F937AB034');
        $this->addSql('DROP INDEX UNIQ_9E858E0F937AB034 ON adventure');
    }
}
