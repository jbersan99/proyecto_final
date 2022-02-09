<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220201171838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE barco (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, matricula VARCHAR(20) NOT NULL, pasajeros_maximos INT NOT NULL, precio_con_patron INT NOT NULL, precio_sin_patron INT NOT NULL, eslora INT NOT NULL, calado INT NOT NULL, caballos INT NOT NULL, licencia VARCHAR(50) NOT NULL, latitud INT NOT NULL, longitud INT NOT NULL, patron TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva (id INT AUTO_INCREMENT NOT NULL, fecha_inicio DATE NOT NULL, fecha_fin DATE NOT NULL, precio_total INT NOT NULL, creacion_reserva DATE NOT NULL, valoracion INT NOT NULL, comentario VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE temporada (id INT AUTO_INCREMENT NOT NULL, inicio_fecha DATE NOT NULL, fin_fecha DATE NOT NULL, tipo VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE barco');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('DROP TABLE temporada');
    }
}
