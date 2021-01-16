<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210116115700 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(150) NOT NULL, type VARCHAR(50) NOT NULL, genre VARCHAR(255) DEFAULT NULL, author VARCHAR(100) NOT NULL, rating DOUBLE PRECISION NOT NULL, cover VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chapter (id INT AUTO_INCREMENT NOT NULL, number SMALLINT NOT NULL, title VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, date_add DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD book_id INT DEFAULT NULL, ADD chapter_id INT DEFAULT NULL, ADD state INT NOT NULL, DROP is_verified, CHANGE content content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C16A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C579F4768 FOREIGN KEY (chapter_id) REFERENCES chapter (id)');
        $this->addSql('CREATE INDEX IDX_9474526C16A2B381 ON comment (book_id)');
        $this->addSql('CREATE INDEX IDX_9474526C579F4768 ON comment (chapter_id)');
        $this->addSql('ALTER TABLE user CHANGE lastname lastname VARCHAR(100) NOT NULL, CHANGE mail mail VARCHAR(100) NOT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C16A2B381');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C579F4768');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE chapter');
        $this->addSql('DROP INDEX IDX_9474526C16A2B381 ON comment');
        $this->addSql('DROP INDEX IDX_9474526C579F4768 ON comment');
        $this->addSql('ALTER TABLE comment ADD is_verified TINYINT(1) NOT NULL, DROP book_id, DROP chapter_id, DROP state, CHANGE content content VARCHAR(2000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE lastname lastname VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
