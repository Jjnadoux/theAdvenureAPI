<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211004102717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adventure (id INT AUTO_INCREMENT NOT NULL, tile_id INT DEFAULT NULL, character_id INT DEFAULT NULL, score INT DEFAULT NULL, nb_tile INT DEFAULT NULL, INDEX IDX_9E858E0F638AF48B (tile_id), UNIQUE INDEX UNIQ_9E858E0F1136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, life INT NOT NULL, nb_dice INT NOT NULL, nb_face INT NOT NULL, armor INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE log (id INT AUTO_INCREMENT NOT NULL, adventure_id INT DEFAULT NULL, message VARCHAR(255) NOT NULL, INDEX IDX_8F3F68C555CF40F9 (adventure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monster (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, life INT NOT NULL, INDEX IDX_245EC6F4C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monster_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, life INT NOT NULL, nb_dice INT NOT NULL, nb_face INT NOT NULL, malus INT NOT NULL, armor INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tile (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, monster_id INT DEFAULT NULL, INDEX IDX_768FA904C54C8C93 (type_id), INDEX IDX_768FA904C5FF1223 (monster_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tile_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, bonus INT NOT NULL, monster_affect VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adventure ADD CONSTRAINT FK_9E858E0F638AF48B FOREIGN KEY (tile_id) REFERENCES tile (id)');
        $this->addSql('ALTER TABLE adventure ADD CONSTRAINT FK_9E858E0F1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE log ADD CONSTRAINT FK_8F3F68C555CF40F9 FOREIGN KEY (adventure_id) REFERENCES adventure (id)');
        $this->addSql('ALTER TABLE monster ADD CONSTRAINT FK_245EC6F4C54C8C93 FOREIGN KEY (type_id) REFERENCES monster_type (id)');
        $this->addSql('ALTER TABLE tile ADD CONSTRAINT FK_768FA904C54C8C93 FOREIGN KEY (type_id) REFERENCES tile_type (id)');
        $this->addSql('ALTER TABLE tile ADD CONSTRAINT FK_768FA904C5FF1223 FOREIGN KEY (monster_id) REFERENCES monster (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE log DROP FOREIGN KEY FK_8F3F68C555CF40F9');
        $this->addSql('ALTER TABLE adventure DROP FOREIGN KEY FK_9E858E0F1136BE75');
        $this->addSql('ALTER TABLE tile DROP FOREIGN KEY FK_768FA904C5FF1223');
        $this->addSql('ALTER TABLE monster DROP FOREIGN KEY FK_245EC6F4C54C8C93');
        $this->addSql('ALTER TABLE adventure DROP FOREIGN KEY FK_9E858E0F638AF48B');
        $this->addSql('ALTER TABLE tile DROP FOREIGN KEY FK_768FA904C54C8C93');
        $this->addSql('DROP TABLE adventure');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE log');
        $this->addSql('DROP TABLE monster');
        $this->addSql('DROP TABLE monster_type');
        $this->addSql('DROP TABLE tile');
        $this->addSql('DROP TABLE tile_type');
    }
}
