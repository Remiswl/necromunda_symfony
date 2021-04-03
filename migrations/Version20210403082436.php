<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210403082436 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE territories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, income VARCHAR(255) NOT NULL, d66roll INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE territories_gangs (territories_id INT NOT NULL, gangs_id INT NOT NULL, INDEX IDX_E6C8E06033B9A304 (territories_id), INDEX IDX_E6C8E0606BABE7BD (gangs_id), PRIMARY KEY(territories_id, gangs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE territories_gangs ADD CONSTRAINT FK_E6C8E06033B9A304 FOREIGN KEY (territories_id) REFERENCES territories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE territories_gangs ADD CONSTRAINT FK_E6C8E0606BABE7BD FOREIGN KEY (gangs_id) REFERENCES gangs (id) ON DELETE CASCADE');
        //$this->addSql('ALTER TABLE gangers ADD CONSTRAINT FK_A3F4545C54C8C93 FOREIGN KEY (type_id) REFERENCES gangers_types (id)');
        //$this->addSql('CREATE INDEX IDX_A3F4545C54C8C93 ON gangers (type_id)');
        $this->addSql('ALTER TABLE my_gangers CHANGE created_at created_at DATETIME NOT NULL');
        //$this->addSql('ALTER TABLE my_gangers ADD CONSTRAINT FK_80C6E9699266B5E FOREIGN KEY (gang_id) REFERENCES gangs (id)');
        //$this->addSql('CREATE INDEX IDX_80C6E9699266B5E ON my_gangers (gang_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE territories_gangs DROP FOREIGN KEY FK_E6C8E06033B9A304');
        $this->addSql('DROP TABLE territories');
        $this->addSql('DROP TABLE territories_gangs');
        $this->addSql('ALTER TABLE gangers DROP FOREIGN KEY FK_A3F4545C54C8C93');
        $this->addSql('DROP INDEX IDX_A3F4545C54C8C93 ON gangers');
        $this->addSql('ALTER TABLE my_gangers DROP FOREIGN KEY FK_80C6E9699266B5E');
        $this->addSql('DROP INDEX IDX_80C6E9699266B5E ON my_gangers');
        $this->addSql('ALTER TABLE my_gangers CHANGE created_at created_at DATE NOT NULL');
    }
}
