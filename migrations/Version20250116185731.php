<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116185731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jour ADD jour VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE planification ADD status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planification ADD CONSTRAINT FK_FFC02E1B6BF700BD FOREIGN KEY (status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FFC02E1B6BF700BD ON planification (status_id)');
        $this->addSql('ALTER TABLE status ADD statut VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE planification DROP CONSTRAINT FK_FFC02E1B6BF700BD');
        $this->addSql('DROP INDEX IDX_FFC02E1B6BF700BD');
        $this->addSql('ALTER TABLE planification DROP status_id');
        $this->addSql('ALTER TABLE jour DROP jour');
        $this->addSql('ALTER TABLE status DROP statut');
    }
}
