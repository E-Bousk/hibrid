<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20210903104314 | file Version20210903104314.php
 *
 * This class is used to modify TELEPHONE tables on database with DOCTRINE ORM
 * In this class, we have methods for :
 *
 * Adding a description of database modification
 * Sending SQL request to modify the TELEPHONE tables on database
 * Getting back to previous state (cancelling modification)
 * 
 */
final class Version20210903104314 extends AbstractMigration
{
    /**
     * Add a description of database modifications
     */
    public function getDescription(): string
    {
        return 'Modification on TELEPHONE rows on table USER';
    }

    /**
     * SQL requests to modify datatable
     * 
     * @return void
     */
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE telephone1 telephone1 VARCHAR(255) DEFAULT NULL, CHANGE telephone2 telephone2 VARCHAR(255) DEFAULT NULL');
    }

    /**
     * SQL requests to cancell datatable modifications
     * 
     * @return void
     */
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE telephone1 telephone1 INT DEFAULT NULL, CHANGE telephone2 telephone2 INT DEFAULT NULL');
    }
}
