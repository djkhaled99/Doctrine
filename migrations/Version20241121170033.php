<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241121170033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Address (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, city VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, number INT NOT NULL, INDEX IDX_C2F3561DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE MyData (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, email VARCHAR(230) NOT NULL, lastName VARCHAR(125) DEFAULT NULL, phone INT NOT NULL, UNIQUE INDEX UNIQ_DA43B9EEE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Post (id INT AUTO_INCREMENT NOT NULL, photo VARCHAR(255) DEFAULT NULL, createdAt DATETIME NOT NULL, likes INT NOT NULL, User_id INT NOT NULL, INDEX IDX_FAB8C3B368D3EA09 (User_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, dateOfBirth DATE DEFAULT NULL, past VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, createdAt DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Address ADD CONSTRAINT FK_C2F3561DA76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Post ADD CONSTRAINT FK_FAB8C3B368D3EA09 FOREIGN KEY (User_id) REFERENCES User (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Address DROP FOREIGN KEY FK_C2F3561DA76ED395');
        $this->addSql('ALTER TABLE Post DROP FOREIGN KEY FK_FAB8C3B368D3EA09');
        $this->addSql('DROP TABLE Address');
        $this->addSql('DROP TABLE MyData');
        $this->addSql('DROP TABLE Post');
        $this->addSql('DROP TABLE User');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
