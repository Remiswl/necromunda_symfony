<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210411094106 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE skills ADD category_id INT NOT NULL');
        //$this->addSql('ALTER TABLE skills ADD CONSTRAINT FK_D531167012469DE2 FOREIGN KEY (category_id) REFERENCES skills_categories (id)');
       // $this->addSql('CREATE INDEX IDX_D531167012469DE2 ON skills (category_id)');
        //$this->addSql('ALTER TABLE territories CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE weapons ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE weapons ADD CONSTRAINT FK_520EBBE112469DE2 FOREIGN KEY (category_id) REFERENCES weapons_categories (id)');
        $this->addSql('CREATE INDEX IDX_520EBBE112469DE2 ON weapons (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skills DROP FOREIGN KEY FK_D531167012469DE2');
        $this->addSql('DROP INDEX IDX_D531167012469DE2 ON skills');
        $this->addSql('ALTER TABLE skills DROP category_id');
        $this->addSql('ALTER TABLE territories CHANGE description description TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE weapons DROP FOREIGN KEY FK_520EBBE112469DE2');
        $this->addSql('DROP INDEX IDX_520EBBE112469DE2 ON weapons');
        $this->addSql('ALTER TABLE weapons DROP category_id');
    }
}
