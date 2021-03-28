<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210328143349 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gangers (id INT AUTO_INCREMENT NOT NULL, ganger_type_id INT NOT NULL, house_id INT NOT NULL, credits INT NOT NULL, move INT NOT NULL, weapon_skill INT NOT NULL, ballistic_skill INT NOT NULL, strength INT NOT NULL, toughness INT NOT NULL, wounds INT NOT NULL, initiative INT NOT NULL, attacks INT NOT NULL, leadership INT NOT NULL, cool INT NOT NULL, willpower INT NOT NULL, intelligence INT NOT NULL, cost INT NOT NULL, adv INT NOT NULL, xp INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gangers_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE my_gangers (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type_id INT NOT NULL, gang_id INT NOT NULL, credits INT NOT NULL, move INT NOT NULL, weapon_skill INT NOT NULL, ballistic_skill INT NOT NULL, strength INT NOT NULL, toughness INT NOT NULL, wounds INT NOT NULL, initiative INT NOT NULL, attacks INT NOT NULL, leadership INT NOT NULL, cool INT NOT NULL, willpower INT NOT NULL, intelligence INT NOT NULL, cost INT NOT NULL, adv INT NOT NULL, xp INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gang_type ADD image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE gangers');
        $this->addSql('DROP TABLE gangers_types');
        $this->addSql('DROP TABLE my_gangers');
        $this->addSql('ALTER TABLE gang_type DROP image');
    }
}
