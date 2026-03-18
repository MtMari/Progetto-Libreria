<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251202103129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Aggiunte colonne dei punteggi';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE autore ADD punteggio_scrittura INT DEFAULT NULL');
        $this->addSql('ALTER TABLE libro ADD pagine INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE libro DROP pagine');
        $this->addSql('ALTER TABLE autore DROP punteggio_scrittura');
    }
}
