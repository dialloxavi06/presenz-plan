<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116184911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE departement DROP CONSTRAINT fk_c1765b638c03f15c');
        $this->addSql('ALTER TABLE departement DROP CONSTRAINT fk_c1765b63e65142c2');
        $this->addSql('DROP INDEX idx_c1765b63e65142c2');
        $this->addSql('DROP INDEX idx_c1765b638c03f15c');
        $this->addSql('ALTER TABLE departement DROP employee_id');
        $this->addSql('ALTER TABLE departement DROP planification_id');
        $this->addSql('ALTER TABLE employee DROP CONSTRAINT fk_5d9f75a1e65142c2');
        $this->addSql('DROP INDEX idx_5d9f75a1e65142c2');
        $this->addSql('ALTER TABLE employee DROP planification_id');
        $this->addSql('ALTER TABLE jour DROP CONSTRAINT fk_da17d9c5e65142c2');
        $this->addSql('DROP INDEX idx_da17d9c5e65142c2');
        $this->addSql('ALTER TABLE jour DROP planification_id');
        $this->addSql('ALTER TABLE jour DROP jour');
        $this->addSql('ALTER TABLE planification DROP CONSTRAINT fk_ffc02e1b6bf700bd');
        $this->addSql('ALTER TABLE planification DROP CONSTRAINT fk_ffc02e1b220c6ad0');
        $this->addSql('DROP INDEX idx_ffc02e1b220c6ad0');
        $this->addSql('DROP INDEX idx_ffc02e1b6bf700bd');
        $this->addSql('ALTER TABLE planification DROP status_id');
        $this->addSql('ALTER TABLE planification DROP jour_id');
        $this->addSql('ALTER TABLE status DROP statut');
        $this->addSql('ALTER TABLE status DROP created_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE planification ADD status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planification ADD jour_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planification ADD CONSTRAINT fk_ffc02e1b6bf700bd FOREIGN KEY (status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE planification ADD CONSTRAINT fk_ffc02e1b220c6ad0 FOREIGN KEY (jour_id) REFERENCES jour (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_ffc02e1b220c6ad0 ON planification (jour_id)');
        $this->addSql('CREATE INDEX idx_ffc02e1b6bf700bd ON planification (status_id)');
        $this->addSql('ALTER TABLE employee ADD planification_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT fk_5d9f75a1e65142c2 FOREIGN KEY (planification_id) REFERENCES planification (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_5d9f75a1e65142c2 ON employee (planification_id)');
        $this->addSql('ALTER TABLE departement ADD employee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE departement ADD planification_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT fk_c1765b638c03f15c FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT fk_c1765b63e65142c2 FOREIGN KEY (planification_id) REFERENCES planification (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c1765b63e65142c2 ON departement (planification_id)');
        $this->addSql('CREATE INDEX idx_c1765b638c03f15c ON departement (employee_id)');
        $this->addSql('ALTER TABLE jour ADD planification_id INT NOT NULL');
        $this->addSql('ALTER TABLE jour ADD jour VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE jour ADD CONSTRAINT fk_da17d9c5e65142c2 FOREIGN KEY (planification_id) REFERENCES planification (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_da17d9c5e65142c2 ON jour (planification_id)');
        $this->addSql('ALTER TABLE status ADD statut VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE status ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN status.created_at IS \'(DC2Type:datetime_immutable)\'');
    }
}
