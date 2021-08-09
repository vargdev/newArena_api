<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210803200059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add bag, bag_item tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE bag (id INT AUTO_INCREMENT NOT NULL, hero_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_1B22684145B0BCD (hero_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bag_item (id INT AUTO_INCREMENT NOT NULL, bag_id INT DEFAULT NULL, item_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_4BC0A2046F5D8297 (bag_id), INDEX IDX_4BC0A204126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bag ADD CONSTRAINT FK_1B22684145B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id)');
        $this->addSql('ALTER TABLE bag_item ADD CONSTRAINT FK_4BC0A2046F5D8297 FOREIGN KEY (bag_id) REFERENCES bag (id)');
        $this->addSql('ALTER TABLE bag_item ADD CONSTRAINT FK_4BC0A204126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE bag_item DROP FOREIGN KEY FK_4BC0A2046F5D8297');
        $this->addSql('DROP TABLE bag');
        $this->addSql('DROP TABLE bag_item');
    }
}
