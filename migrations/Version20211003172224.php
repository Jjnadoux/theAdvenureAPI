<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211003172224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adventure ADD nb_tile INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adventure ADD CONSTRAINT FK_9E858E0FE7BF9C81 FOREIGN KEY (`tile`) REFERENCES tile (`id`)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9E858E0FE7BF9C81 ON adventure (`tile`)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adventure DROP FOREIGN KEY FK_9E858E0FE7BF9C81');
        $this->addSql('DROP INDEX UNIQ_9E858E0FE7BF9C81 ON adventure');
        $this->addSql('ALTER TABLE adventure DROP nb_tile');
    }
}
