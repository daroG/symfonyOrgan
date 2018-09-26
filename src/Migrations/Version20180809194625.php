<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180809194625 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE played_songs DROP FOREIGN KEY FK_1906329A76ED395');
        $this->addSql('ALTER TABLE played_songs DROP FOREIGN KEY FK_1906329EA5DA7EB');
        $this->addSql('DROP INDEX UNIQ_1906329EA5DA7EB ON played_songs');
        $this->addSql('DROP INDEX UNIQ_1906329A76ED395 ON played_songs');
        $this->addSql('ALTER TABLE played_songs DROP mass_id, DROP user_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE played_songs ADD mass_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE played_songs ADD CONSTRAINT FK_1906329A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE played_songs ADD CONSTRAINT FK_1906329EA5DA7EB FOREIGN KEY (mass_id) REFERENCES mass (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1906329EA5DA7EB ON played_songs (mass_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1906329A76ED395 ON played_songs (user_id)');
    }
}
