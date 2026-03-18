<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251113093201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE utenti_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE products_id_seq CASCADE');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE utenti');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE utenti_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE products_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE products (id SERIAL NOT NULL, taglia VARCHAR(5) NOT NULL, prezzo DOUBLE PRECISION DEFAULT NULL, descrizione VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE utenti (id SERIAL NOT NULL, nome VARCHAR(25) DEFAULT NULL, cognome VARCHAR(70) DEFAULT NULL, password VARCHAR(18) NOT NULL, mail VARCHAR(55) NOT NULL, cf VARCHAR(16) NOT NULL, data_nascita DATE DEFAULT NULL, PRIMARY KEY(id))');
    }
}
