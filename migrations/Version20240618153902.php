<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240618153902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE games (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, developer_studio VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genres_to_games (genre_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_3ADD2EF14296D31F (genre_id), INDEX IDX_3ADD2EF1E48FD905 (game_id), PRIMARY KEY(genre_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE genres_to_games ADD CONSTRAINT FK_3ADD2EF14296D31F FOREIGN KEY (genre_id) REFERENCES games (id)');
        $this->addSql('ALTER TABLE genres_to_games ADD CONSTRAINT FK_3ADD2EF1E48FD905 FOREIGN KEY (game_id) REFERENCES genre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE genres_to_games DROP FOREIGN KEY FK_3ADD2EF14296D31F');
        $this->addSql('ALTER TABLE genres_to_games DROP FOREIGN KEY FK_3ADD2EF1E48FD905');
        $this->addSql('DROP TABLE games');
        $this->addSql('DROP TABLE genres_to_games');
        $this->addSql('DROP TABLE genre');
    }
}
