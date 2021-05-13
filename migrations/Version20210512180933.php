<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210512180933 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE territories CHANGE description description TEXT NOT NULL');
        $this->addSql('ALTER TABLE weapons ADD availability INT NOT NULL, ADD short_range INT DEFAULT NULL, ADD long_range INT DEFAULT NULL, ADD short_accuracy INT DEFAULT NULL, ADD long_accuracy INT DEFAULT NULL, ADD strength INT DEFAULT NULL, ADD armour_piercing INT DEFAULT NULL, ADD damage INT DEFAULT NULL, ADD ammo INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE territories CHANGE description description TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE weapons DROP availability, DROP short_range, DROP long_range, DROP short_accuracy, DROP long_accuracy, DROP strength, DROP armour_piercing, DROP damage, DROP ammo');
    }
}
