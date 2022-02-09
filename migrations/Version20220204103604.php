<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204103604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE imagenes DROP FOREIGN KEY FK_376A6001B2DBCFCF');
        $this->addSql('DROP INDEX IDX_376A6001B2DBCFCF ON imagenes');
        $this->addSql('ALTER TABLE imagenes DROP barco_imagen_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE barco CHANGE nombre nombre VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE matricula matricula VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE licencia licencia VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE imagenes ADD barco_imagen_id INT NOT NULL');
        $this->addSql('ALTER TABLE imagenes ADD CONSTRAINT FK_376A6001B2DBCFCF FOREIGN KEY (barco_imagen_id) REFERENCES barco (id)');
        $this->addSql('CREATE INDEX IDX_376A6001B2DBCFCF ON imagenes (barco_imagen_id)');
        $this->addSql('ALTER TABLE reserva CHANGE comentario comentario VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE temporada CHANGE tipo tipo VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nombre nombre VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE apellidos apellidos VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tipo_licencia tipo_licencia VARCHAR(50) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
