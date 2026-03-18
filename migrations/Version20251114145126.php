<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251114145126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ON DELETE CASCADE';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE libro DROP CONSTRAINT FK_5799AD2BBECEFFB6');
        $this->addSql('ALTER TABLE libro ADD CONSTRAINT FK_5799AD2BBECEFFB6 FOREIGN KEY (autore_id) REFERENCES autore (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE libro DROP CONSTRAINT fk_5799ad2bbeceffb6');
        $this->addSql('ALTER TABLE libro ADD CONSTRAINT fk_5799ad2bbeceffb6 FOREIGN KEY (autore_id) REFERENCES autore (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
