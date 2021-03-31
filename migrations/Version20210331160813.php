<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331160813 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gangs DROP reputation, DROP wealth, DROP alliance, CHANGE house_id house_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gangs ADD CONSTRAINT FK_CF53F7EA6BB74515 FOREIGN KEY (house_id) REFERENCES houses (id)');
        $this->addSql('CREATE INDEX IDX_CF53F7EA6BB74515 ON gangs (house_id)');
        $this->addSql('ALTER TABLE my_gangers ADD CONSTRAINT FK_80C6E9696EFFF5B8 FOREIGN KEY (ganger_type_id) REFERENCES gangers_types (id)');
        $this->addSql('CREATE INDEX IDX_80C6E9696EFFF5B8 ON my_gangers (ganger_type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gangs DROP FOREIGN KEY FK_CF53F7EA6BB74515');
        $this->addSql('DROP INDEX IDX_CF53F7EA6BB74515 ON gangs');
        $this->addSql('ALTER TABLE gangs ADD reputation INT NOT NULL, ADD wealth INT NOT NULL, ADD alliance VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE house_id house_id INT NOT NULL');
        $this->addSql('ALTER TABLE my_gangers DROP FOREIGN KEY FK_80C6E9696EFFF5B8');
        $this->addSql('DROP INDEX IDX_80C6E9696EFFF5B8 ON my_gangers');
    }
}
