<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191230102819 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE game_data DROP CONSTRAINT fk_46e69f4f953c1c61');
        $this->addSql('DROP INDEX idx_46e69f4f953c1c61');
        $this->addSql('ALTER TABLE game_data DROP source_id');
        $this->addSql('ALTER TABLE game_buffer ADD source_id INT NOT NULL');
        $this->addSql('ALTER TABLE game_buffer ADD CONSTRAINT FK_4C6F5D3A953C1C61 FOREIGN KEY (source_id) REFERENCES source (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4C6F5D3A953C1C61 ON game_buffer (source_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE game_data ADD source_id INT NOT NULL');
        $this->addSql('ALTER TABLE game_data ADD CONSTRAINT fk_46e69f4f953c1c61 FOREIGN KEY (source_id) REFERENCES source (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_46e69f4f953c1c61 ON game_data (source_id)');
        $this->addSql('ALTER TABLE game_buffer DROP CONSTRAINT FK_4C6F5D3A953C1C61');
        $this->addSql('DROP INDEX IDX_4C6F5D3A953C1C61');
        $this->addSql('ALTER TABLE game_buffer DROP source_id');
    }
}
