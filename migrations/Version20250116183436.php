<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116183436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jour ALTER planification_id SET NOT NULL');
        $this->addSql('ALTER TABLE planification ADD status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planification ADD jour_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planification ADD CONSTRAINT FK_FFC02E1B6BF700BD FOREIGN KEY (status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE planification ADD CONSTRAINT FK_FFC02E1B220C6AD0 FOREIGN KEY (jour_id) REFERENCES jour (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FFC02E1B6BF700BD ON planification (status_id)');
        $this->addSql('CREATE INDEX IDX_FFC02E1B220C6AD0 ON planification (jour_id)');
        $this->addSql('ALTER TABLE status ALTER planification_id SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE planification DROP CONSTRAINT FK_FFC02E1B6BF700BD');
        $this->addSql('ALTER TABLE planification DROP CONSTRAINT FK_FFC02E1B220C6AD0');
        $this->addSql('DROP INDEX IDX_FFC02E1B6BF700BD');
        $this->addSql('DROP INDEX IDX_FFC02E1B220C6AD0');
        $this->addSql('ALTER TABLE planification DROP status_id');
        $this->addSql('ALTER TABLE planification DROP jour_id');
        $this->addSql('ALTER TABLE jour ALTER planification_id DROP NOT NULL');
        $this->addSql('ALTER TABLE status ALTER planification_id DROP NOT NULL');
    }
}
