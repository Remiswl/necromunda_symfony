<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331073815 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gangers DROP FOREIGN KEY FK_A3F45456BB74515');
        $this->addSql('ALTER TABLE gangers DROP FOREIGN KEY FK_A3F45456EFFF5B8');
        $this->addSql('DROP INDEX IDX_A3F45456EFFF5B8 ON gangers');
        $this->addSql('DROP INDEX IDX_A3F45456BB74515 ON gangers');
        $this->addSql('ALTER TABLE gangers DROP ganger_type_id, DROP house_id');
        $this->addSql('ALTER TABLE gangs DROP FOREIGN KEY FK_CF53F7EA6BB74515');
        $this->addSql('DROP INDEX UNIQ_CF53F7EA6BB74515 ON gangs');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gangers ADD ganger_type_id INT NOT NULL, ADD house_id INT NOT NULL');
        $this->addSql('ALTER TABLE gangers ADD CONSTRAINT FK_A3F45456BB74515 FOREIGN KEY (house_id) REFERENCES houses (id)');
        $this->addSql('ALTER TABLE gangers ADD CONSTRAINT FK_A3F45456EFFF5B8 FOREIGN KEY (ganger_type_id) REFERENCES gangers_types (id)');
        $this->addSql('CREATE INDEX IDX_A3F45456EFFF5B8 ON gangers (ganger_type_id)');
        $this->addSql('CREATE INDEX IDX_A3F45456BB74515 ON gangers (house_id)');
        $this->addSql('ALTER TABLE gangs ADD CONSTRAINT FK_CF53F7EA6BB74515 FOREIGN KEY (house_id) REFERENCES houses (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CF53F7EA6BB74515 ON gangs (house_id)');
    }
}
