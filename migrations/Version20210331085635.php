<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331085635 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gangers_types ADD gangers_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gangers_types ADD CONSTRAINT FK_B951446B2B781C6C FOREIGN KEY (gangers_id) REFERENCES my_gangers (id)');
        $this->addSql('CREATE INDEX IDX_B951446B2B781C6C ON gangers_types (gangers_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gangers_types DROP FOREIGN KEY FK_B951446B2B781C6C');
        $this->addSql('DROP INDEX IDX_B951446B2B781C6C ON gangers_types');
        $this->addSql('ALTER TABLE gangers_types DROP gangers_id');
    }
}
