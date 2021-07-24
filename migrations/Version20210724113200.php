<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210724113200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hero (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, username VARCHAR(63) NOT NULL, exp INT DEFAULT 0 NOT NULL, level INT DEFAULT 1 NOT NULL, UNIQUE INDEX UNIQ_51CE6E86A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero_stat (id INT AUTO_INCREMENT NOT NULL, hero_id INT DEFAULT NULL, strength INT DEFAULT 1 NOT NULL, agility INT DEFAULT 1 NOT NULL, stamina INT DEFAULT 1 NOT NULL, crit DOUBLE PRECISION DEFAULT \'0\' NOT NULL, UNIQUE INDEX UNIQ_A0539D6745B0BCD (hero_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, level INT NOT NULL, exp INT NOT NULL, stat INT DEFAULT 2 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E86A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE hero_stat ADD CONSTRAINT FK_A0539D6745B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hero_stat DROP FOREIGN KEY FK_A0539D6745B0BCD');
        $this->addSql('DROP TABLE hero');
        $this->addSql('DROP TABLE hero_stat');
        $this->addSql('DROP TABLE level');
    }
}
