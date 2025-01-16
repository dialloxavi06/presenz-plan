<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116190504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planification ADD jour_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planification ADD employee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planification ADD departement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planification ADD CONSTRAINT FK_FFC02E1B220C6AD0 FOREIGN KEY (jour_id) REFERENCES jour (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE planification ADD CONSTRAINT FK_FFC02E1B8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE planification ADD CONSTRAINT FK_FFC02E1BCCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FFC02E1B220C6AD0 ON planification (jour_id)');
        $this->addSql('CREATE INDEX IDX_FFC02E1B8C03F15C ON planification (employee_id)');
        $this->addSql('CREATE INDEX IDX_FFC02E1BCCF9E01E ON planification (departement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE planification DROP CONSTRAINT FK_FFC02E1B220C6AD0');
        $this->addSql('ALTER TABLE planification DROP CONSTRAINT FK_FFC02E1B8C03F15C');
        $this->addSql('ALTER TABLE planification DROP CONSTRAINT FK_FFC02E1BCCF9E01E');
        $this->addSql('DROP INDEX IDX_FFC02E1B220C6AD0');
        $this->addSql('DROP INDEX IDX_FFC02E1B8C03F15C');
        $this->addSql('DROP INDEX IDX_FFC02E1BCCF9E01E');
        $this->addSql('ALTER TABLE planification DROP jour_id');
        $this->addSql('ALTER TABLE planification DROP employee_id');
        $this->addSql('ALTER TABLE planification DROP departement_id');
    }
}
