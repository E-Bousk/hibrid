<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20210825130122 | file Version20210825130122.php
 *
 * This class is used to create USER table on database with DOCTRINE ORM
 * In this class, we have methods for :
 *
 * Adding a description of database modification
 * Sending SQL request to create USER table on the database
 * Getting back to previous state (delete added table)
 * 
 */
final class Version20210825130122 extends AbstractMigration
{
    /**
     * Add a description of database modifications
     */
    public function getDescription(): string
    {
        return 'Creation of USER table';
    }

    /**
     * SQL requests to modify datatable
     * 
     * @return void
     */
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, telephone1 INT DEFAULT NULL, telephone2 INT DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, is_verified TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    /**
     * SQL requests to cancell datatable modifications
     * 
     * @return void
     */
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
    }
}
