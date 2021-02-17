<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217142022 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, base_price DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_configuration (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, depth DOUBLE PRECISION NOT NULL, d_b1 DOUBLE PRECISION NOT NULL, d_b2 DOUBLE PRECISION NOT NULL, d_b5 DOUBLE PRECISION NOT NULL, d_b10 DOUBLE PRECISION NOT NULL, INDEX IDX_7F0FB9254584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_configuration ADD CONSTRAINT FK_7F0FB9254584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_configuration DROP FOREIGN KEY FK_7F0FB9254584665A');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_configuration');
    }
}
