<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251202131811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Rinominata colonna punteggio autore';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE autore RENAME COLUMN punteggio_scrittura TO qualita_scrittura');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE autore RENAME COLUMN qualita_scrittura TO punteggio_scrittura');
    }
}
