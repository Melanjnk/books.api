<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210117090720 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE book_translation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE book_translation (id INT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E69E0A132C2AC5D3 ON book_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX book_translation_unique_translation ON book_translation (translatable_id, locale)');
        $this->addSql('ALTER TABLE book_translation ADD CONSTRAINT FK_E69E0A132C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES books (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP INDEX name');
        $this->addSql('ALTER TABLE books DROP name');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE book_translation_id_seq CASCADE');
        $this->addSql('DROP TABLE book_translation');
        $this->addSql('ALTER TABLE books ADD name VARCHAR(255) NOT NULL');
        $this->addSql('CREATE INDEX name ON books (name)');
    }
}
