<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250210185530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cancion_playlist (cancion_id INT NOT NULL, playlist_id INT NOT NULL, INDEX IDX_553AC0559B1D840F (cancion_id), INDEX IDX_553AC0556BBD148 (playlist_id), PRIMARY KEY(cancion_id, playlist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cancion_playlist ADD CONSTRAINT FK_553AC0559B1D840F FOREIGN KEY (cancion_id) REFERENCES cancion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cancion_playlist ADD CONSTRAINT FK_553AC0556BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cancion_playlist DROP FOREIGN KEY FK_553AC0559B1D840F');
        $this->addSql('ALTER TABLE cancion_playlist DROP FOREIGN KEY FK_553AC0556BBD148');
        $this->addSql('DROP TABLE cancion_playlist');
    }
}
