<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210403090124 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE my_gangers CHANGE created_at created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE territories_gangs DROP FOREIGN KEY FK_E6C8E06033B9A304');
        $this->addSql('DROP TABLE territories');
        $this->addSql('DROP TABLE territories_gangs');
        $this->addSql('ALTER TABLE gangers DROP FOREIGN KEY FK_A3F4545C54C8C93');
        $this->addSql('DROP INDEX IDX_A3F4545C54C8C93 ON gangers');
        $this->addSql('ALTER TABLE gangs DROP reputation, DROP wealth, DROP alliance');
        $this->addSql('CREATE INDEX IDX_CF53F7EA6BB74516 ON gangs (house_id)');
        $this->addSql('ALTER TABLE my_gangers DROP FOREIGN KEY FK_80C6E9699266B5E');
        $this->addSql('DROP INDEX IDX_80C6E9699266B5E ON my_gangers');
        $this->addSql('ALTER TABLE my_gangers CHANGE created_at created_at DATE NOT NULL');
    }
}
