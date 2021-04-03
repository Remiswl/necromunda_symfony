<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401181913 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gangers DROP FOREIGN KEY FK_A3F4545C54C8C93');
        $this->addSql('DROP INDEX IDX_A3F4545C54C8C93 ON gangers');
        $this->addSql('ALTER TABLE my_gangers DROP FOREIGN KEY FK_80C6E9699266B5E');
        $this->addSql('DROP INDEX IDX_80C6E9699266B5E ON my_gangers');
    }
}
