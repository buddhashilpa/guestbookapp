<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220817213927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE guestentry (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, modified_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, image LONGTEXT DEFAULT NULL, created_on DATETIME NOT NULL, status INT NOT NULL, modified_on DATETIME DEFAULT NULL, INDEX IDX_52BEB036A76ED395 (user_id), INDEX IDX_52BEB036A50BFD10 (modified_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE guestentry ADD CONSTRAINT FK_52BEB036A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE guestentry ADD CONSTRAINT FK_52BEB036A50BFD10 FOREIGN KEY (modified_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guestentry DROP FOREIGN KEY FK_52BEB036A76ED395');
        $this->addSql('ALTER TABLE guestentry DROP FOREIGN KEY FK_52BEB036A50BFD10');
        $this->addSql('DROP TABLE guestentry');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
