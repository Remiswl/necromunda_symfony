<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401083020 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gangers ADD CONSTRAINT FK_A3F4545C54C8C93 FOREIGN KEY (type_id) REFERENCES gangers_types (id)');
        $this->addSql('CREATE INDEX IDX_A3F4545C54C8C93 ON gangers (type_id)');
        $this->addSql('ALTER TABLE gangs CHANGE house_id house_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gangs ADD CONSTRAINT FK_CF53F7EA6BB74515 FOREIGN KEY (house_id) REFERENCES houses (id)');
        $this->addSql('CREATE INDEX IDX_CF53F7EA6BB74515 ON gangs (house_id)');
        $this->addSql('ALTER TABLE my_gangers ADD CONSTRAINT FK_80C6E9696EFFF5B8 FOREIGN KEY (ganger_type_id) REFERENCES gangers_types (id)');
        $this->addSql('ALTER TABLE my_gangers ADD CONSTRAINT FK_80C6E9699266B5E FOREIGN KEY (gang_id) REFERENCES gangs (id)');
        $this->addSql('CREATE INDEX IDX_80C6E9696EFFF5B8 ON my_gangers (ganger_type_id)');
        $this->addSql('CREATE INDEX IDX_80C6E9699266B5E ON my_gangers (gang_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gangers DROP FOREIGN KEY FK_A3F4545C54C8C93');
        $this->addSql('DROP INDEX IDX_A3F4545C54C8C93 ON gangers');
        $this->addSql('ALTER TABLE gangs DROP FOREIGN KEY FK_CF53F7EA6BB74515');
        $this->addSql('DROP INDEX IDX_CF53F7EA6BB74515 ON gangs');
        $this->addSql('ALTER TABLE gangs CHANGE house_id house_id INT NOT NULL');
        $this->addSql('ALTER TABLE my_gangers DROP FOREIGN KEY FK_80C6E9696EFFF5B8');
        $this->addSql('ALTER TABLE my_gangers DROP FOREIGN KEY FK_80C6E9699266B5E');
        $this->addSql('DROP INDEX IDX_80C6E9696EFFF5B8 ON my_gangers');
        $this->addSql('DROP INDEX IDX_80C6E9699266B5E ON my_gangers');
    }
}
