<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331075539 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE my_gangers DROP FOREIGN KEY FK_80C6E9696EFFF5B8');
        $this->addSql('ALTER TABLE my_gangers DROP FOREIGN KEY FK_80C6E9699266B5E');
        $this->addSql('DROP INDEX IDX_80C6E9696EFFF5B8 ON my_gangers');
        $this->addSql('DROP INDEX IDX_80C6E9699266B5E ON my_gangers');
        $this->addSql('ALTER TABLE my_gangers ADD type_id INT NOT NULL, DROP ganger_type_id, CHANGE gang_id gang_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE my_gangers ADD ganger_type_id INT DEFAULT NULL, DROP type_id, CHANGE gang_id gang_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE my_gangers ADD CONSTRAINT FK_80C6E9696EFFF5B8 FOREIGN KEY (ganger_type_id) REFERENCES gangers_types (id)');
        $this->addSql('ALTER TABLE my_gangers ADD CONSTRAINT FK_80C6E9699266B5E FOREIGN KEY (gang_id) REFERENCES gangs (id)');
        $this->addSql('CREATE INDEX IDX_80C6E9696EFFF5B8 ON my_gangers (ganger_type_id)');
        $this->addSql('CREATE INDEX IDX_80C6E9699266B5E ON my_gangers (gang_id)');
    }
}
