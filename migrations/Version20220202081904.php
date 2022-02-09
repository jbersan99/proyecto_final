<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220202081904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE imagenes ADD barco_imagen_id INT NOT NULL');
        $this->addSql('ALTER TABLE imagenes ADD CONSTRAINT FK_376A6001B2DBCFCF FOREIGN KEY (barco_imagen_id) REFERENCES barco (id)');
        $this->addSql('CREATE INDEX IDX_376A6001B2DBCFCF ON imagenes (barco_imagen_id)');
        $this->addSql('ALTER TABLE reserva ADD barco_reserva_id INT NOT NULL, ADD usuario_reserva_id INT NOT NULL');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B95DC37C7 FOREIGN KEY (barco_reserva_id) REFERENCES barco (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B2541734A FOREIGN KEY (usuario_reserva_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_188D2E3B95DC37C7 ON reserva (barco_reserva_id)');
        $this->addSql('CREATE INDEX IDX_188D2E3B2541734A ON reserva (usuario_reserva_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE barco CHANGE nombre nombre VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE matricula matricula VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE licencia licencia VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE imagenes DROP FOREIGN KEY FK_376A6001B2DBCFCF');
        $this->addSql('DROP INDEX IDX_376A6001B2DBCFCF ON imagenes');
        $this->addSql('ALTER TABLE imagenes DROP barco_imagen_id');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B95DC37C7');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B2541734A');
        $this->addSql('DROP INDEX IDX_188D2E3B95DC37C7 ON reserva');
        $this->addSql('DROP INDEX IDX_188D2E3B2541734A ON reserva');
        $this->addSql('ALTER TABLE reserva DROP barco_reserva_id, DROP usuario_reserva_id, CHANGE comentario comentario VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE temporada CHANGE tipo tipo VARCHAR(20) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
