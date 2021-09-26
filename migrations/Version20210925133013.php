<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20210925133013 | file Version20210925133013.php
 *
 * This class is used to modify foreign key constraints on the RENTAL SPACE table on database with DOCTRINE ORM
 * In this class, we have methods for :
 *
 * Adding a description of database modification
 * Sending SQL request to modify foreign key constraints on the RENTAL SPACE table on database
 * Getting back to previous state (cancelling modification)
 * 
 */
final class Version20210925133013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Modify constraints on foreign keys (on RentalSpace entity) with « ON DELETE CASCADE »';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rental_space DROP FOREIGN KEY FK_B2994FD51DD40CF9');
        $this->addSql('ALTER TABLE rental_space DROP FOREIGN KEY FK_B2994FD58BAC62AF');
        $this->addSql('ALTER TABLE rental_space ADD CONSTRAINT FK_B2994FD51DD40CF9 FOREIGN KEY (rental_space_type_id) REFERENCES rental_space_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rental_space ADD CONSTRAINT FK_B2994FD58BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rental_space DROP FOREIGN KEY FK_B2994FD51DD40CF9');
        $this->addSql('ALTER TABLE rental_space DROP FOREIGN KEY FK_B2994FD58BAC62AF');
        $this->addSql('ALTER TABLE rental_space ADD CONSTRAINT FK_B2994FD51DD40CF9 FOREIGN KEY (rental_space_type_id) REFERENCES rental_space_type (id)');
        $this->addSql('ALTER TABLE rental_space ADD CONSTRAINT FK_B2994FD58BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
    }
}
