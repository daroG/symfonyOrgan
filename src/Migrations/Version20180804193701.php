<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180804193701 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mass (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE played_songs (id INT AUTO_INCREMENT NOT NULL, mass_id INT DEFAULT NULL, added_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_1906329EA5DA7EB (mass_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playedsongs_song (playedsongs_id INT NOT NULL, song_id INT NOT NULL, INDEX IDX_78D1541E90386F2 (playedsongs_id), INDEX IDX_78D1541EA0BDB2F3 (song_id), PRIMARY KEY(playedsongs_id, song_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE song (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, added_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE song_tag (song_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_4C49C104A0BDB2F3 (song_id), INDEX IDX_4C49C104BAD26311 (tag_id), PRIMARY KEY(song_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE played_songs ADD CONSTRAINT FK_1906329EA5DA7EB FOREIGN KEY (mass_id) REFERENCES mass (id)');
        $this->addSql('ALTER TABLE playedsongs_song ADD CONSTRAINT FK_78D1541E90386F2 FOREIGN KEY (playedsongs_id) REFERENCES played_songs (id)');
        $this->addSql('ALTER TABLE playedsongs_song ADD CONSTRAINT FK_78D1541EA0BDB2F3 FOREIGN KEY (song_id) REFERENCES song (id)');
        $this->addSql('ALTER TABLE song_tag ADD CONSTRAINT FK_4C49C104A0BDB2F3 FOREIGN KEY (song_id) REFERENCES song (id)');
        $this->addSql('ALTER TABLE song_tag ADD CONSTRAINT FK_4C49C104BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE played_songs DROP FOREIGN KEY FK_1906329EA5DA7EB');
        $this->addSql('ALTER TABLE playedsongs_song DROP FOREIGN KEY FK_78D1541E90386F2');
        $this->addSql('ALTER TABLE playedsongs_song DROP FOREIGN KEY FK_78D1541EA0BDB2F3');
        $this->addSql('ALTER TABLE song_tag DROP FOREIGN KEY FK_4C49C104A0BDB2F3');
        $this->addSql('ALTER TABLE song_tag DROP FOREIGN KEY FK_4C49C104BAD26311');
        $this->addSql('DROP TABLE mass');
        $this->addSql('DROP TABLE played_songs');
        $this->addSql('DROP TABLE playedsongs_song');
        $this->addSql('DROP TABLE song');
        $this->addSql('DROP TABLE song_tag');
        $this->addSql('DROP TABLE tag');
    }
}
