<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Migration to create relation between contact_form and department
 */
final class Version20220223185747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_form ADD department_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_form DROP department');
        $this->addSql('ALTER TABLE contact_form ADD CONSTRAINT FK_7A777FB0AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7A777FB0AE80F5DF ON contact_form (department_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE contact_form DROP CONSTRAINT FK_7A777FB0AE80F5DF');
        $this->addSql('DROP INDEX IDX_7A777FB0AE80F5DF');
        $this->addSql('ALTER TABLE contact_form ADD department INT NOT NULL');
        $this->addSql('ALTER TABLE contact_form DROP department_id');
    }
}
