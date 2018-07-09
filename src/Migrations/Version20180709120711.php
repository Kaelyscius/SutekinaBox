<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180709120711 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contact_information (id INT AUTO_INCREMENT NOT NULL, userid_id INT NOT NULL, name VARCHAR(70) NOT NULL, adress VARCHAR(255) NOT NULL, address_cpl VARCHAR(100) NOT NULL, postal_code VARCHAR(10) NOT NULL, city VARCHAR(60) NOT NULL, country VARCHAR(60) NOT NULL, phone VARCHAR(20) NOT NULL, mobile VARCHAR(20) NOT NULL, INDEX IDX_47D5A73D58E0A285 (userid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marketing (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, mess_from_id INT NOT NULL, title VARCHAR(255) NOT NULL, conten LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B6BD307F515FB767 (mess_from_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, supplier_id_id INT DEFAULT NULL, name VARCHAR(80) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_D34A04ADA65F9C7D (supplier_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE purchase (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(10) NOT NULL, city VARCHAR(80) NOT NULL, country VARCHAR(80) NOT NULL, email VARCHAR(100) NOT NULL, contact_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sutekina_box (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, budget DOUBLE PRECISION NOT NULL, products LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', creation_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, message_recived_id INT DEFAULT NULL, firstname VARCHAR(60) NOT NULL, lastname VARCHAR(80) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(64) NOT NULL, registration_date DATETIME NOT NULL, last_connexion_date DATETIME NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_8D93D64929B5115E (message_recived_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_information ADD CONSTRAINT FK_47D5A73D58E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F515FB767 FOREIGN KEY (mess_from_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA65F9C7D FOREIGN KEY (supplier_id_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64929B5115E FOREIGN KEY (message_recived_id) REFERENCES message (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64929B5115E');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA65F9C7D');
        $this->addSql('ALTER TABLE contact_information DROP FOREIGN KEY FK_47D5A73D58E0A285');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F515FB767');
        $this->addSql('DROP TABLE contact_information');
        $this->addSql('DROP TABLE marketing');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE purchase');
        $this->addSql('DROP TABLE supplier');
        $this->addSql('DROP TABLE sutekina_box');
        $this->addSql('DROP TABLE user');
    }
}
