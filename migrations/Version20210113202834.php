<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

ini_set('memory_limit', '-1');

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210113202834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        for ($i = 1; $i <= 10000; $i++) {
            $bookName = 'book ' . $i;
            $authorName = 'author ' . $i;
            $this->addSql('INSERT INTO books (id, name) VALUES (:id, :book)', ['id'=>$i, 'book' => $bookName]);
            $this->addSql('INSERT INTO authors (id, name) VALUES (:id, :author)', ['id'=>$i, 'author' => $authorName]);
        }
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE books CASCADE;');
        $this->addSql('TRUNCATE author CASCADE;');
        // this down() migration is auto-generated, please modify it to your needs

    }
}
