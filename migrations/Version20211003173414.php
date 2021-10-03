<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211003173414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adventure DROP FOREIGN KEY FK_9E858E0F937AB034');
        $this->addSql('ALTER TABLE adventure DROP FOREIGN KEY FK_9E858E0FE7BF9C81');
        $this->addSql('DROP INDEX UNIQ_9E858E0FE7BF9C81 ON adventure');
        $this->addSql('DROP INDEX UNIQ_9E858E0F664E4F72 ON adventure');
        $this->addSql('ALTER TABLE adventure ADD character_id INT DEFAULT NULL, DROP tile, DROP `character`');
        $this->addSql('ALTER TABLE adventure ADD CONSTRAINT FK_9E858E0F1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9E858E0F1136BE75 ON adventure (character_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adventure DROP FOREIGN KEY FK_9E858E0F1136BE75');
        $this->addSql('DROP INDEX UNIQ_9E858E0F1136BE75 ON adventure');
        $this->addSql('ALTER TABLE adventure ADD tile INT NOT NULL, ADD `character` INT NOT NULL, DROP character_id');
        $this->addSql('ALTER TABLE adventure ADD CONSTRAINT FK_9E858E0F937AB034 FOREIGN KEY (`character`) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE adventure ADD CONSTRAINT FK_9E858E0FE7BF9C81 FOREIGN KEY (tile) REFERENCES tile (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9E858E0FE7BF9C81 ON adventure (tile)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9E858E0F664E4F72 ON adventure (`character`)');
    }
}
