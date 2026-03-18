<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251117130714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ManyToMany con association class';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE autore_libro (id SERIAL NOT NULL, autore_id INT DEFAULT NULL, libro_id INT DEFAULT NULL, extra VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_60B76695BECEFFB6 ON autore_libro (autore_id)');
        $this->addSql('CREATE INDEX IDX_60B76695C0238522 ON autore_libro (libro_id)');
        $this->addSql('ALTER TABLE autore_libro ADD CONSTRAINT FK_60B76695BECEFFB6 FOREIGN KEY (autore_id) REFERENCES autore (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE autore_libro ADD CONSTRAINT FK_60B76695C0238522 FOREIGN KEY (libro_id) REFERENCES libro (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE libro_autore DROP CONSTRAINT fk_df98dd39beceffb6');
        $this->addSql('ALTER TABLE libro_autore DROP CONSTRAINT fk_df98dd39c0238522');
        $this->addSql('DROP TABLE libro_autore');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE libro_autore (libro_id INT NOT NULL, autore_id INT NOT NULL, PRIMARY KEY(libro_id, autore_id))');
        $this->addSql('CREATE INDEX idx_df98dd39beceffb6 ON libro_autore (autore_id)');
        $this->addSql('CREATE INDEX idx_df98dd39c0238522 ON libro_autore (libro_id)');
        $this->addSql('ALTER TABLE libro_autore ADD CONSTRAINT fk_df98dd39beceffb6 FOREIGN KEY (autore_id) REFERENCES autore (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE libro_autore ADD CONSTRAINT fk_df98dd39c0238522 FOREIGN KEY (libro_id) REFERENCES libro (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE autore_libro DROP CONSTRAINT FK_60B76695BECEFFB6');
        $this->addSql('ALTER TABLE autore_libro DROP CONSTRAINT FK_60B76695C0238522');
        $this->addSql('DROP TABLE autore_libro');
    }
}
