<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210117092254 extends AbstractMigration
{
    const TOTAL_CNT_BOOKS = 10000;

    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        for ($i = 1; $i <= self::TOTAL_CNT_BOOKS; $i++) {
            $bookNameEn = 'book ' . $i;
            $bookNameRu = 'Книга ' . $i;

            $this->addName($i, $i, $bookNameEn, 'en');
            $this->addName($i + self::TOTAL_CNT_BOOKS, $i, $bookNameRu, 'ru');
        }
    }

    private function addName($id, $translatableId, $name, $locale)
    {
        $this->addSql('INSERT INTO book_translation (id, translatable_id, name, locale) VALUES (:id, :translatable_id, :book, :locale)', [
            'id' => $id,
            'translatable_id' => $translatableId,
            'book' => $name,
            'locale' => $locale
        ]);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE book_translation CASCADE;');
    }
}
