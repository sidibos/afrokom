<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181005163314 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

       // $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA238248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        //$this->addSql('CREATE INDEX IDX_AC6A4CA238248176 ON shop (currency_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shop DROP FOREIGN KEY FK_AC6A4CA238248176');
        $this->addSql('DROP INDEX IDX_AC6A4CA238248176 ON shop');
    }
}
