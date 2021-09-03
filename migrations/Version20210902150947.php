<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20210902150947 | file Version20210902150947.php
 *
 * This class is used to create 3 tables on database with DOCTRINE ORM
 * In this class, we have methods for :
 *
 * Adding a description of database modification
 * Sending SQL requests to create 3 tables on the database
 * Getting back to previous state (deleting the 3 added tables)
 * 
 */
final class Version20210902150947 extends AbstractMigration
{
    /**
     * Add a description of database modifications
     */
    public function getDescription(): string
    {
        return 'Creation of CITY, RENTAL_SPACE and RENTAL_SPACE_TYPE tables with relations';
    }

    /**
     * SQL requests to modify datatable
     * 
     * @return void
     */
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE city (
            id INT AUTO_INCREMENT NOT NULL, 
            name VARCHAR(255) NOT NULL, 
            postal_code INT NOT NULL, 
            PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental_space (
            id INT AUTO_INCREMENT NOT NULL, 
            rental_space_type_id INT DEFAULT NULL, 
            city_id INT DEFAULT NULL, 
            quantity INT DEFAULT NULL, 
            minimum_duration_rule INT DEFAULT NULL, 
            maximum_duration_rule INT DEFAULT NULL, 
            day_price INT DEFAULT NULL, 
            week_price INT DEFAULT NULL, 
            weekend_price INT DEFAULT NULL, 
            month_price INT DEFAULT NULL, 
            INDEX IDX_B2994FD51DD40CF9 (rental_space_type_id), 
            INDEX IDX_B2994FD58BAC62AF (city_id), 
            PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental_space_type (
            id INT AUTO_INCREMENT NOT NULL, 
            designation VARCHAR(255) NOT NULL, 
            PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rental_space ADD CONSTRAINT FK_B2994FD51DD40CF9 FOREIGN KEY (rental_space_type_id) REFERENCES rental_space_type (id)');
        $this->addSql('ALTER TABLE rental_space ADD CONSTRAINT FK_B2994FD58BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
    }

    /**
     * SQL requests to cancell datatable modifications
     * 
     * @return void
     */
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rental_space DROP FOREIGN KEY FK_B2994FD58BAC62AF');
        $this->addSql('ALTER TABLE rental_space DROP FOREIGN KEY FK_B2994FD51DD40CF9');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE rental_space');
        $this->addSql('DROP TABLE rental_space_type');
    }
}
