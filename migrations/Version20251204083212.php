<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251204083212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Pagine e qualita_scrittura NOT NULL';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE autore ALTER qualita_scrittura SET NOT NULL');
        $this->addSql('ALTER TABLE libro ALTER pagine SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE libro ALTER pagine DROP NOT NULL');
        $this->addSql('ALTER TABLE autore ALTER qualita_scrittura DROP NOT NULL');
    }
}
