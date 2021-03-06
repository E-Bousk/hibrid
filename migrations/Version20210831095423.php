<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20210831095423 | file Version20210831095423.php
 *
 * This class is used to modify USER table on database with DOCTRINE ORM
 * In this class, we have methods for :
 *
 * Adding a description of database modification
 * Sending SQL request to modify the USER table on database
 * Getting back to previous state (cancelling modification)
 * 
 */
final class Version20210831095423 extends AbstractMigration
{
    /**
     * Add a description of database modifications
     */
    public function getDescription(): string
    {
        return 'Modification of IS_VERIFIED row on table USER';
    }

    /**
     * SQL requests to modify datatable
     * 
     * @return void
     */
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE is_verified is_verified TINYINT(1) NOT NULL');
    }

    /**
     * SQL requests to cancell datatable modifications
     * 
     * @return void
     */
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE is_verified is_verified TINYINT(1) DEFAULT NULL');
    }
}
