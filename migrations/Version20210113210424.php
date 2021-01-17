<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210113210424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        for ($i = 1; $i <= 10000; $i++) {
            for ($j = 1; $j < 3; $j++) {
                if ($i + $j > 10000) {
                    $this->addSql('INSERT INTO book_author (book_id, author_id) VALUES (:bookId, :authorId) ON CONFLICT DO NOTHING', ['bookId' => $i, 'authorId' => 10000]);
                    continue;
                }
                $authorId = rand($i, $i + $j);
                $this->addSql('INSERT INTO book_author (book_id, author_id) VALUES (:bookId, :authorId) ON CONFLICT DO NOTHING', ['bookId' => $i, 'authorId' => $authorId]);
            }
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
