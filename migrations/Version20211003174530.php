<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211003174530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adventure ADD tile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adventure ADD CONSTRAINT FK_9E858E0F638AF48B FOREIGN KEY (tile_id) REFERENCES tile (id)');
        $this->addSql('CREATE INDEX IDX_9E858E0F638AF48B ON adventure (tile_id)');
        $this->addSql('ALTER TABLE monster ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE monster ADD CONSTRAINT FK_245EC6F4C54C8C93 FOREIGN KEY (type_id) REFERENCES monster_type (id)');
        $this->addSql('CREATE INDEX IDX_245EC6F4C54C8C93 ON monster (type_id)');
        $this->addSql('ALTER TABLE tile DROP FOREIGN KEY FK_768FA9048CDE5729');
        $this->addSql('DROP INDEX UNIQ_768FA9048CDE5729 ON tile');
        $this->addSql('ALTER TABLE tile ADD type_id INT DEFAULT NULL, ADD monster_id INT DEFAULT NULL, DROP type');
        $this->addSql('ALTER TABLE tile ADD CONSTRAINT FK_768FA904C54C8C93 FOREIGN KEY (type_id) REFERENCES tile_type (id)');
        $this->addSql('ALTER TABLE tile ADD CONSTRAINT FK_768FA904C5FF1223 FOREIGN KEY (monster_id) REFERENCES monster (id)');
        $this->addSql('CREATE INDEX IDX_768FA904C54C8C93 ON tile (type_id)');
        $this->addSql('CREATE INDEX IDX_768FA904C5FF1223 ON tile (monster_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adventure DROP FOREIGN KEY FK_9E858E0F638AF48B');
        $this->addSql('DROP INDEX IDX_9E858E0F638AF48B ON adventure');
        $this->addSql('ALTER TABLE adventure DROP tile_id');
        $this->addSql('ALTER TABLE monster DROP FOREIGN KEY FK_245EC6F4C54C8C93');
        $this->addSql('DROP INDEX IDX_245EC6F4C54C8C93 ON monster');
        $this->addSql('ALTER TABLE monster DROP type_id');
        $this->addSql('ALTER TABLE tile DROP FOREIGN KEY FK_768FA904C54C8C93');
        $this->addSql('ALTER TABLE tile DROP FOREIGN KEY FK_768FA904C5FF1223');
        $this->addSql('DROP INDEX IDX_768FA904C54C8C93 ON tile');
        $this->addSql('DROP INDEX IDX_768FA904C5FF1223 ON tile');
        $this->addSql('ALTER TABLE tile ADD type INT NOT NULL, DROP type_id, DROP monster_id');
        $this->addSql('ALTER TABLE tile ADD CONSTRAINT FK_768FA9048CDE5729 FOREIGN KEY (type) REFERENCES tile_type (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_768FA9048CDE5729 ON tile (type)');
    }
}
