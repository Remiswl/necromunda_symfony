<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210423184759 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('CREATE TABLE injuries_my_gangers (injuries_id INT NOT NULL, my_gangers_id INT NOT NULL, INDEX IDX_31847BEF4799CDA1 (injuries_id), INDEX IDX_31847BEFDCFC1A3F (my_gangers_id), PRIMARY KEY(injuries_id, my_gangers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('CREATE TABLE skills_my_gangers (skills_id INT NOT NULL, my_gangers_id INT NOT NULL, INDEX IDX_40A816A47FF61858 (skills_id), INDEX IDX_40A816A4DCFC1A3F (my_gangers_id), PRIMARY KEY(skills_id, my_gangers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('CREATE TABLE weapons_my_gangers (weapons_id INT NOT NULL, my_gangers_id INT NOT NULL, INDEX IDX_ACE13A912EE82581 (weapons_id), INDEX IDX_ACE13A91DCFC1A3F (my_gangers_id), PRIMARY KEY(weapons_id, my_gangers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE injuries_my_gangers ADD CONSTRAINT FK_31847BEF4799CDA1 FOREIGN KEY (injuries_id) REFERENCES injuries (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE injuries_my_gangers ADD CONSTRAINT FK_31847BEFDCFC1A3F FOREIGN KEY (my_gangers_id) REFERENCES my_gangers (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE skills_my_gangers ADD CONSTRAINT FK_40A816A47FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE skills_my_gangers ADD CONSTRAINT FK_40A816A4DCFC1A3F FOREIGN KEY (my_gangers_id) REFERENCES my_gangers (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE weapons_my_gangers ADD CONSTRAINT FK_ACE13A912EE82581 FOREIGN KEY (weapons_id) REFERENCES weapons (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE weapons_my_gangers ADD CONSTRAINT FK_ACE13A91DCFC1A3F FOREIGN KEY (my_gangers_id) REFERENCES my_gangers (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE territories CHANGE description description VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE injuries_my_gangers');
        $this->addSql('DROP TABLE skills_my_gangers');
        $this->addSql('DROP TABLE weapons_my_gangers');
        $this->addSql('ALTER TABLE territories CHANGE description description TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
