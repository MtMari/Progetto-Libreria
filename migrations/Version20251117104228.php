<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251117104228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE libro_autore (libro_id INT NOT NULL, autore_id INT NOT NULL, PRIMARY KEY(libro_id, autore_id))');
        $this->addSql('CREATE INDEX IDX_DF98DD39C0238522 ON libro_autore (libro_id)');
        $this->addSql('CREATE INDEX IDX_DF98DD39BECEFFB6 ON libro_autore (autore_id)');
        $this->addSql('ALTER TABLE libro_autore ADD CONSTRAINT FK_DF98DD39C0238522 FOREIGN KEY (libro_id) REFERENCES libro (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE libro_autore ADD CONSTRAINT FK_DF98DD39BECEFFB6 FOREIGN KEY (autore_id) REFERENCES autore (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE libro DROP CONSTRAINT fk_5799ad2bbeceffb6');
        $this->addSql('DROP INDEX idx_5799ad2bbeceffb6');
        $this->addSql('ALTER TABLE libro DROP autore_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE libro_autore DROP CONSTRAINT FK_DF98DD39C0238522');
        $this->addSql('ALTER TABLE libro_autore DROP CONSTRAINT FK_DF98DD39BECEFFB6');
        $this->addSql('DROP TABLE libro_autore');
        $this->addSql('ALTER TABLE libro ADD autore_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE libro ADD CONSTRAINT fk_5799ad2bbeceffb6 FOREIGN KEY (autore_id) REFERENCES autore (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_5799ad2bbeceffb6 ON libro (autore_id)');
    }
}
