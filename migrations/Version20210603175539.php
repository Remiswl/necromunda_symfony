<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210603175539 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gang_territory (id INT AUTO_INCREMENT NOT NULL, gang_id INT NOT NULL, territory_id INT NOT NULL, count INT NOT NULL, INDEX IDX_142093559266B5E (gang_id), INDEX IDX_1420935573F74AD4 (territory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gang_territory ADD CONSTRAINT FK_142093559266B5E FOREIGN KEY (gang_id) REFERENCES gangs (id)');
        $this->addSql('ALTER TABLE gang_territory ADD CONSTRAINT FK_1420935573F74AD4 FOREIGN KEY (territory_id) REFERENCES territories (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE gang_territory');
    }
}
