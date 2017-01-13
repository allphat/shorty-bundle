<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170113114346 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS shorturl
        ( id INTEGER PRIMARY KEY ASC AUTOINCREMENT, url TEXT NOT NULL, code VARBINARY(6) NOT NULL, created_at INTEGER UNSIGNED NOT NULL, counter INTEGER UNSIGNED NOT NULL DEFAULT 0)');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE shorturl');

    }
}
