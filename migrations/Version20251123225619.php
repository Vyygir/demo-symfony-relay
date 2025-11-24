<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251123225619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lead (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, forename VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, phone VARCHAR(50) NOT NULL, existing_customer BOOLEAN NOT NULL, company VARCHAR(100) NOT NULL, role VARCHAR(50) DEFAULT NULL, country VARCHAR(50) NOT NULL, employees VARCHAR(50) DEFAULT NULL, comments CLOB DEFAULT NULL, location_connectivity_status VARCHAR(255) DEFAULT NULL, location_address VARCHAR(255) DEFAULT NULL, location_city VARCHAR(255) DEFAULT NULL, location_postcode VARCHAR(255) DEFAULT NULL, location_country VARCHAR(255) DEFAULT NULL, location_latitude DOUBLE PRECISION DEFAULT NULL, location_longitude DOUBLE PRECISION DEFAULT NULL, products_items CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE lead');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
