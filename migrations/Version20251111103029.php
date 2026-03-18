<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251111103029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Test Migration';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utenti (id SERIAL NOT NULL, nome VARCHAR(25) DEFAULT NULL, cognome VARCHAR(70) DEFAULT NULL, password VARCHAR(18) NOT NULL, mail VARCHAR(255) NOT NULL, cf VARCHAR(16) NOT NULL, data_nascita DATE DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE utenti');
    }
}
