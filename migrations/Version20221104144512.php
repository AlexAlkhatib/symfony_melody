<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221104144512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, nom_genre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE morceaux (id INT AUTO_INCREMENT NOT NULL, genreid_id INT NOT NULL, nom_morceaux VARCHAR(50) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, music_name VARCHAR(255) NOT NULL, date_sortie DATE DEFAULT NULL, artiste LONGTEXT DEFAULT NULL, INDEX IDX_823125C3998C37BC (genreid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist (id INT AUTO_INCREMENT NOT NULL, userid_id INT DEFAULT NULL, nom_playlist VARCHAR(255) NOT NULL, nb_morceaux INT DEFAULT NULL, INDEX IDX_D782112D58E0A285 (userid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_morceaux (playlist_id INT NOT NULL, morceaux_id INT NOT NULL, INDEX IDX_7FECE3AE6BBD148 (playlist_id), INDEX IDX_7FECE3AE4C853D76 (morceaux_id), PRIMARY KEY(playlist_id, morceaux_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE morceaux ADD CONSTRAINT FK_823125C3998C37BC FOREIGN KEY (genreid_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D58E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE playlist_morceaux ADD CONSTRAINT FK_7FECE3AE6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlist_morceaux ADD CONSTRAINT FK_7FECE3AE4C853D76 FOREIGN KEY (morceaux_id) REFERENCES morceaux (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE morceaux DROP FOREIGN KEY FK_823125C3998C37BC');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112D58E0A285');
        $this->addSql('ALTER TABLE playlist_morceaux DROP FOREIGN KEY FK_7FECE3AE6BBD148');
        $this->addSql('ALTER TABLE playlist_morceaux DROP FOREIGN KEY FK_7FECE3AE4C853D76');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE morceaux');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('DROP TABLE playlist_morceaux');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
