<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210117101648 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('CREATE INDEX book_name ON book_translation (name)');
        $this->addSql('CREATE INDEX book_search_idx ON book_translation (translatable_id, name)');
        $this->addSql('CREATE INDEX book_view_idx ON book_translation (locale, translatable_id, name)');
        $this->addSql('ALTER INDEX book_name RENAME TO book_name_idx');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX book_name');
        $this->addSql('DROP INDEX book_search_idx');
        $this->addSql('DROP INDEX book_view_idx');
        $this->addSql('ALTER INDEX book_name_idx RENAME TO book_name');
    }
}
