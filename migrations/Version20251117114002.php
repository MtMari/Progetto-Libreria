<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251117114002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE autore_libro DROP CONSTRAINT fk_60b76695beceffb6');
        $this->addSql('ALTER TABLE autore_libro DROP CONSTRAINT fk_60b76695c0238522');
        $this->addSql('DROP TABLE autore_libro');
        $this->addSql('ALTER TABLE libro ADD autore_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE libro ADD CONSTRAINT FK_5799AD2BBECEFFB6 FOREIGN KEY (autore_id) REFERENCES autore (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5799AD2BBECEFFB6 ON libro (autore_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE autore_libro (libro_id INT NOT NULL, autore_id INT NOT NULL, PRIMARY KEY(libro_id, autore_id))');
        $this->addSql('CREATE INDEX idx_60b76695beceffb6 ON autore_libro (autore_id)');
        $this->addSql('CREATE INDEX idx_60b76695c0238522 ON autore_libro (libro_id)');
        $this->addSql('ALTER TABLE autore_libro ADD CONSTRAINT fk_60b76695beceffb6 FOREIGN KEY (autore_id) REFERENCES autore (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE autore_libro ADD CONSTRAINT fk_60b76695c0238522 FOREIGN KEY (libro_id) REFERENCES libro (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE libro DROP CONSTRAINT FK_5799AD2BBECEFFB6');
        $this->addSql('DROP INDEX IDX_5799AD2BBECEFFB6');
        $this->addSql('ALTER TABLE libro DROP autore_id');
    }
}
