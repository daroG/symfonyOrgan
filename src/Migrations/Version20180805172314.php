<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180805172314 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE playedsongs_song (id INT AUTO_INCREMENT NOT NULL, song_id INT NOT NULL, played_songs_id INT NOT NULL, type INT NOT NULL, INDEX IDX_78D1541EA0BDB2F3 (song_id), INDEX IDX_78D1541EEF02137E (played_songs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE playedsongs_song ADD CONSTRAINT FK_78D1541EA0BDB2F3 FOREIGN KEY (song_id) REFERENCES song (id)');
        $this->addSql('ALTER TABLE playedsongs_song ADD CONSTRAINT FK_78D1541EEF02137E FOREIGN KEY (played_songs_id) REFERENCES played_songs (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE playedsongs_song');
    }
}
