<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250203150027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cancion DROP FOREIGN KEY FK_E4620FA0BCE7B795');
        $this->addSql('ALTER TABLE cancion ADD CONSTRAINT FK_E4620FA0BCE7B795 FOREIGN KEY (genero_id) REFERENCES estilo (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112D53C8D32C');
        $this->addSql('ALTER TABLE playlist CHANGE propietario_id propietario_id INT NOT NULL');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D53C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlist_cancion DROP FOREIGN KEY FK_5B5D18BA6BBD148');
        $this->addSql('ALTER TABLE playlist_cancion DROP FOREIGN KEY FK_5B5D18BA9B1D840F');
        $this->addSql('ALTER TABLE playlist_cancion CHANGE playlist_id playlist_id INT NOT NULL, CHANGE cancion_id cancion_id INT NOT NULL');
        $this->addSql('ALTER TABLE playlist_cancion ADD CONSTRAINT FK_5B5D18BA6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlist_cancion ADD CONSTRAINT FK_5B5D18BA9B1D840F FOREIGN KEY (cancion_id) REFERENCES cancion (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cancion DROP FOREIGN KEY FK_E4620FA0BCE7B795');
        $this->addSql('ALTER TABLE cancion ADD CONSTRAINT FK_E4620FA0BCE7B795 FOREIGN KEY (genero_id) REFERENCES estilo (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE playlist_cancion DROP FOREIGN KEY FK_5B5D18BA6BBD148');
        $this->addSql('ALTER TABLE playlist_cancion DROP FOREIGN KEY FK_5B5D18BA9B1D840F');
        $this->addSql('ALTER TABLE playlist_cancion CHANGE playlist_id playlist_id INT DEFAULT NULL, CHANGE cancion_id cancion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE playlist_cancion ADD CONSTRAINT FK_5B5D18BA6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE playlist_cancion ADD CONSTRAINT FK_5B5D18BA9B1D840F FOREIGN KEY (cancion_id) REFERENCES cancion (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112D53C8D32C');
        $this->addSql('ALTER TABLE playlist CHANGE propietario_id propietario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D53C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
