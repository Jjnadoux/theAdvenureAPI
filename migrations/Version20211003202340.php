<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211003202340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE log DROP FOREIGN KEY FK_8F3F68C5760E358B');
        $this->addSql('DROP INDEX UNIQ_8F3F68C5760E358B ON log');
        $this->addSql('ALTER TABLE log CHANGE id_adventure_id adventure_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE log ADD CONSTRAINT FK_8F3F68C555CF40F9 FOREIGN KEY (adventure_id) REFERENCES adventure (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F3F68C555CF40F9 ON log (adventure_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE log DROP FOREIGN KEY FK_8F3F68C555CF40F9');
        $this->addSql('DROP INDEX UNIQ_8F3F68C555CF40F9 ON log');
        $this->addSql('ALTER TABLE log CHANGE adventure_id id_adventure_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE log ADD CONSTRAINT FK_8F3F68C5760E358B FOREIGN KEY (id_adventure_id) REFERENCES adventure (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F3F68C5760E358B ON log (id_adventure_id)');
    }
}
