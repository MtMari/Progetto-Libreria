<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251112084946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Da eliminare';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prodotti (id SERIAL NOT NULL, prezzo_listino DOUBLE PRECISION DEFAULT NULL, sconto INT DEFAULT NULL, iva INT DEFAULT NULL, descrizione VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE prodotti');
    }
}
