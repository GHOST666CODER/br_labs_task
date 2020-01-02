<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191230081337 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE greeting_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE league_aliases_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sport_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sport_aliases_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE league_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE source_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_aliases_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_data_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_buffer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE league_aliases (id INT NOT NULL, league_id INT NOT NULL, alias VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E6BBA24858AFC4DE ON league_aliases (league_id)');
        $this->addSql('CREATE TABLE sport (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sport_aliases (id INT NOT NULL, sport_id INT NOT NULL, alias VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FEA7F793AC78BCF8 ON sport_aliases (sport_id)');
        $this->addSql('CREATE TABLE league (id INT NOT NULL, sport_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3EB4C318AC78BCF8 ON league (sport_id)');
        $this->addSql('CREATE TABLE source (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE game (id INT NOT NULL, start_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE team_aliases (id INT NOT NULL, team_id INT NOT NULL, alias VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A06BCA0E296CD8AE ON team_aliases (team_id)');
        $this->addSql('CREATE TABLE team (id INT NOT NULL, sport_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C4E0A61FAC78BCF8 ON team (sport_id)');
        $this->addSql('CREATE TABLE game_data (id INT NOT NULL, sport_id INT NOT NULL, league_id INT NOT NULL, team1_id INT NOT NULL, team2_id INT NOT NULL, game_id INT DEFAULT NULL, source_id INT NOT NULL, start_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_46E69F4FAC78BCF8 ON game_data (sport_id)');
        $this->addSql('CREATE INDEX IDX_46E69F4F58AFC4DE ON game_data (league_id)');
        $this->addSql('CREATE INDEX IDX_46E69F4FE72BCFA4 ON game_data (team1_id)');
        $this->addSql('CREATE INDEX IDX_46E69F4FF59E604A ON game_data (team2_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_46E69F4FE48FD905 ON game_data (game_id)');
        $this->addSql('CREATE INDEX IDX_46E69F4F953C1C61 ON game_data (source_id)');
        $this->addSql('CREATE TABLE game_buffer (id INT NOT NULL, game_data_id INT NOT NULL, start_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4C6F5D3AA237DE13 ON game_buffer (game_data_id)');
        $this->addSql('ALTER TABLE league_aliases ADD CONSTRAINT FK_E6BBA24858AFC4DE FOREIGN KEY (league_id) REFERENCES league (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sport_aliases ADD CONSTRAINT FK_FEA7F793AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE league ADD CONSTRAINT FK_3EB4C318AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_aliases ADD CONSTRAINT FK_A06BCA0E296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_data ADD CONSTRAINT FK_46E69F4FAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_data ADD CONSTRAINT FK_46E69F4F58AFC4DE FOREIGN KEY (league_id) REFERENCES league (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_data ADD CONSTRAINT FK_46E69F4FE72BCFA4 FOREIGN KEY (team1_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_data ADD CONSTRAINT FK_46E69F4FF59E604A FOREIGN KEY (team2_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_data ADD CONSTRAINT FK_46E69F4FE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_data ADD CONSTRAINT FK_46E69F4F953C1C61 FOREIGN KEY (source_id) REFERENCES source (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_buffer ADD CONSTRAINT FK_4C6F5D3AA237DE13 FOREIGN KEY (game_data_id) REFERENCES game_data (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE greeting');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sport_aliases DROP CONSTRAINT FK_FEA7F793AC78BCF8');
        $this->addSql('ALTER TABLE league DROP CONSTRAINT FK_3EB4C318AC78BCF8');
        $this->addSql('ALTER TABLE team DROP CONSTRAINT FK_C4E0A61FAC78BCF8');
        $this->addSql('ALTER TABLE game_data DROP CONSTRAINT FK_46E69F4FAC78BCF8');
        $this->addSql('ALTER TABLE league_aliases DROP CONSTRAINT FK_E6BBA24858AFC4DE');
        $this->addSql('ALTER TABLE game_data DROP CONSTRAINT FK_46E69F4F58AFC4DE');
        $this->addSql('ALTER TABLE game_data DROP CONSTRAINT FK_46E69F4F953C1C61');
        $this->addSql('ALTER TABLE game_data DROP CONSTRAINT FK_46E69F4FE48FD905');
        $this->addSql('ALTER TABLE team_aliases DROP CONSTRAINT FK_A06BCA0E296CD8AE');
        $this->addSql('ALTER TABLE game_data DROP CONSTRAINT FK_46E69F4FE72BCFA4');
        $this->addSql('ALTER TABLE game_data DROP CONSTRAINT FK_46E69F4FF59E604A');
        $this->addSql('ALTER TABLE game_buffer DROP CONSTRAINT FK_4C6F5D3AA237DE13');
        $this->addSql('DROP SEQUENCE league_aliases_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sport_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sport_aliases_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE league_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE source_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE team_aliases_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE team_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_data_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_buffer_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE greeting_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE greeting (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE league_aliases');
        $this->addSql('DROP TABLE sport');
        $this->addSql('DROP TABLE sport_aliases');
        $this->addSql('DROP TABLE league');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE team_aliases');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE game_data');
        $this->addSql('DROP TABLE game_buffer');
    }
}
