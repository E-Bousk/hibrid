<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20210923084907 | file Version20210923084907.php
 *
 * This class is used to modify TELEPHONE tables on database with DOCTRINE ORM
 * and to create RESET PASSWORD REQUEST table on database
 * In this class, we have methods for :
 *
 * Adding a description of database modification
 * Sending SQL request to modify the TELEPHONE tables on database
 * Sending SQL request to create RESET PASSWORD REQUEST table on the database
 * Getting back to previous state (cancelling modification)
 * 
 */
final class Version20210923084907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creation of RESET_PASSWORD_REQUEST table and modification of TELEPHONE 1&2 size of VARCHAR';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user CHANGE telephone1 telephone1 VARCHAR(25) DEFAULT NULL, CHANGE telephone2 telephone2 VARCHAR(25) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE user CHANGE telephone1 telephone1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE telephone2 telephone2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
