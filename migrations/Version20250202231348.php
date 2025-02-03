<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250202231348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE perfil_estilo (id INT AUTO_INCREMENT NOT NULL, perfiles_id INT NOT NULL, estilos_id INT NOT NULL, INDEX IDX_8C8A3EBEBAFA433E (perfiles_id), INDEX IDX_8C8A3EBEAF80F2E3 (estilos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE perfil_estilo ADD CONSTRAINT FK_8C8A3EBEBAFA433E FOREIGN KEY (perfiles_id) REFERENCES perfil (id)');
        $this->addSql('ALTER TABLE perfil_estilo ADD CONSTRAINT FK_8C8A3EBEAF80F2E3 FOREIGN KEY (estilos_id) REFERENCES estilo (id)');
        $this->addSql('ALTER TABLE perfil ADD usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE perfil ADD CONSTRAINT FK_96657647DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_96657647DB38439E ON perfil (usuario_id)');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D57291544');
        $this->addSql('DROP INDEX UNIQ_2265B05D57291544 ON usuario');
        $this->addSql('ALTER TABLE usuario DROP perfil_id');
        $this->addSql('ALTER TABLE usuario_playlist CHANGE usuario_id usuario_id INT NOT NULL, CHANGE playlist_id playlist_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE perfil_estilo DROP FOREIGN KEY FK_8C8A3EBEBAFA433E');
        $this->addSql('ALTER TABLE perfil_estilo DROP FOREIGN KEY FK_8C8A3EBEAF80F2E3');
        $this->addSql('DROP TABLE perfil_estilo');
        $this->addSql('ALTER TABLE usuario_playlist CHANGE usuario_id usuario_id INT DEFAULT NULL, CHANGE playlist_id playlist_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario ADD perfil_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D57291544 FOREIGN KEY (perfil_id) REFERENCES perfil (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05D57291544 ON usuario (perfil_id)');
        $this->addSql('ALTER TABLE perfil DROP FOREIGN KEY FK_96657647DB38439E');
        $this->addSql('DROP INDEX UNIQ_96657647DB38439E ON perfil');
        $this->addSql('ALTER TABLE perfil DROP usuario_id');
    }
}
