<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116174705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE departement (id SERIAL NOT NULL, employee_id INT DEFAULT NULL, planification_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, ref VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C1765B638C03F15C ON departement (employee_id)');
        $this->addSql('CREATE INDEX IDX_C1765B63E65142C2 ON departement (planification_id)');
        $this->addSql('CREATE TABLE employee (id SERIAL NOT NULL, planification_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5D9F75A1E65142C2 ON employee (planification_id)');
        $this->addSql('CREATE TABLE jour (id SERIAL NOT NULL, planification_id INT DEFAULT NULL, jour VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DA17D9C5E65142C2 ON jour (planification_id)');
        $this->addSql('CREATE TABLE planification (id SERIAL NOT NULL, start_datum DATE DEFAULT NULL, end_date DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE status (id SERIAL NOT NULL, planification_id INT DEFAULT NULL, statut VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7B00651CE65142C2 ON status (planification_id)');
        $this->addSql('COMMENT ON COLUMN status.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B638C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B63E65142C2 FOREIGN KEY (planification_id) REFERENCES planification (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1E65142C2 FOREIGN KEY (planification_id) REFERENCES planification (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE jour ADD CONSTRAINT FK_DA17D9C5E65142C2 FOREIGN KEY (planification_id) REFERENCES planification (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651CE65142C2 FOREIGN KEY (planification_id) REFERENCES planification (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE departement DROP CONSTRAINT FK_C1765B638C03F15C');
        $this->addSql('ALTER TABLE departement DROP CONSTRAINT FK_C1765B63E65142C2');
        $this->addSql('ALTER TABLE employee DROP CONSTRAINT FK_5D9F75A1E65142C2');
        $this->addSql('ALTER TABLE jour DROP CONSTRAINT FK_DA17D9C5E65142C2');
        $this->addSql('ALTER TABLE status DROP CONSTRAINT FK_7B00651CE65142C2');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE jour');
        $this->addSql('DROP TABLE planification');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
