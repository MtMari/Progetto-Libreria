<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251114104001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Fix relazioni';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE libro ADD autore_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE libro DROP autore');
        $this->addSql('ALTER TABLE libro ADD CONSTRAINT FK_5799AD2BBECEFFB6 FOREIGN KEY (autore_id) REFERENCES autore (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5799AD2BBECEFFB6 ON libro (autore_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE libro DROP CONSTRAINT FK_5799AD2BBECEFFB6');
        $this->addSql('DROP INDEX IDX_5799AD2BBECEFFB6');
        $this->addSql('ALTER TABLE libro ADD autore VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE libro DROP autore_id');
    }
}
