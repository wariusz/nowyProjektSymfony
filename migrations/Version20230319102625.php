<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230319102625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, vat SMALLINT NOT NULL, volume INT NOT NULL, unit VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items_stocks (id INT AUTO_INCREMENT NOT NULL, item_id INT DEFAULT NULL, is_actually TINYINT(1) NOT NULL, created_date DATETIME NOT NULL, INDEX IDX_A402ECB126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items_stocks_stock (items_stocks_id INT NOT NULL, stock_id INT NOT NULL, INDEX IDX_525318058660F427 (items_stocks_id), INDEX IDX_52531805DCD6110 (stock_id), PRIMARY KEY(items_stocks_id, stock_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_stocks (id INT AUTO_INCREMENT NOT NULL, is_actually TINYINT(1) NOT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_stocks_user (users_stocks_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_CB7D431C9CB61AC1 (users_stocks_id), INDEX IDX_CB7D431CA76ED395 (user_id), PRIMARY KEY(users_stocks_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_stocks_stock (users_stocks_id INT NOT NULL, stock_id INT NOT NULL, INDEX IDX_50711D8E9CB61AC1 (users_stocks_id), INDEX IDX_50711D8EDCD6110 (stock_id), PRIMARY KEY(users_stocks_id, stock_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE items_stocks ADD CONSTRAINT FK_A402ECB126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE items_stocks_stock ADD CONSTRAINT FK_525318058660F427 FOREIGN KEY (items_stocks_id) REFERENCES items_stocks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE items_stocks_stock ADD CONSTRAINT FK_52531805DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_stocks_user ADD CONSTRAINT FK_CB7D431C9CB61AC1 FOREIGN KEY (users_stocks_id) REFERENCES users_stocks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_stocks_user ADD CONSTRAINT FK_CB7D431CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_stocks_stock ADD CONSTRAINT FK_50711D8E9CB61AC1 FOREIGN KEY (users_stocks_id) REFERENCES users_stocks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_stocks_stock ADD CONSTRAINT FK_50711D8EDCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items_stocks DROP FOREIGN KEY FK_A402ECB126F525E');
        $this->addSql('ALTER TABLE items_stocks_stock DROP FOREIGN KEY FK_525318058660F427');
        $this->addSql('ALTER TABLE items_stocks_stock DROP FOREIGN KEY FK_52531805DCD6110');
        $this->addSql('ALTER TABLE users_stocks_user DROP FOREIGN KEY FK_CB7D431C9CB61AC1');
        $this->addSql('ALTER TABLE users_stocks_user DROP FOREIGN KEY FK_CB7D431CA76ED395');
        $this->addSql('ALTER TABLE users_stocks_stock DROP FOREIGN KEY FK_50711D8E9CB61AC1');
        $this->addSql('ALTER TABLE users_stocks_stock DROP FOREIGN KEY FK_50711D8EDCD6110');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE items_stocks');
        $this->addSql('DROP TABLE items_stocks_stock');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE users_stocks');
        $this->addSql('DROP TABLE users_stocks_user');
        $this->addSql('DROP TABLE users_stocks_stock');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
