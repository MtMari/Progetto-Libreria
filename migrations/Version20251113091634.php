<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251113091634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Aggiunta Libro';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE libro (id SERIAL NOT NULL, titolo VARCHAR(20) NOT NULL, autore VARCHAR(20) DEFAULT NULL, descrizione VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE TABLE products (id SERIAL NOT NULL, taglia VARCHAR(5) NOT NULL, prezzo DOUBLE PRECISION DEFAULT NULL, descrizione VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE prodotti ALTER descrizione TYPE VARCHAR(100)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE libro');
        $this->addSql('DROP TABLE products');
        $this->addSql('ALTER TABLE prodotti ALTER descrizione TYPE VARCHAR(255)');
    }
}
