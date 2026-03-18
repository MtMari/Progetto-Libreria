<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251209105940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Eliminazione tabella logs';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE db_logs ALTER data_log SET NOT NULL');
        $this->addSql('DROP TABLE db_logs');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE db_logs ALTER data_log DROP NOT NULL');
    }
}
