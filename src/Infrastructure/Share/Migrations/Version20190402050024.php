<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190402050024 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE answer (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', parent_item BINARY(16) NOT NULL COMMENT \'(DC2Type:userId)\', author_id BINARY(16) NOT NULL COMMENT \'(DC2Type:userId)\', downvote_count INT DEFAULT NULL, upvote_count INT DEFAULT NULL, text LONGTEXT DEFAULT NULL, date_created DATETIME DEFAULT NULL, INDEX IDX_DADD4A2522F813AA (parent_item), INDEX IDX_DADD4A25F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:userId)\', address_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, additional_name LONGTEXT DEFAULT NULL, birth_date DATE DEFAULT NULL, family_name LONGTEXT DEFAULT NULL, gender LONGTEXT DEFAULT NULL, nationality LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F5B7AF75 (address_id), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE postal_address (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', address_country LONGTEXT DEFAULT NULL, address_locality LONGTEXT DEFAULT NULL, address_region LONGTEXT DEFAULT NULL, post_office_box_number LONGTEXT DEFAULT NULL, postal_code LONGTEXT DEFAULT NULL, street_address LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:userId)\', author_id BINARY(16) NOT NULL COMMENT \'(DC2Type:userId)\', accepted_answer_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', suggested_answer_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name LONGTEXT DEFAULT NULL, upvote_count INT DEFAULT NULL, text LONGTEXT DEFAULT NULL, date_created DATETIME DEFAULT NULL, answer_count INT DEFAULT NULL, INDEX IDX_B6F7494EF675F31B (author_id), UNIQUE INDEX UNIQ_B6F7494EEA36A5F2 (accepted_answer_id), INDEX IDX_B6F7494E72EE41C2 (suggested_answer_id), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A2522F813AA FOREIGN KEY (parent_item) REFERENCES question (uuid)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25F675F31B FOREIGN KEY (author_id) REFERENCES user (uuid)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES postal_address (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EF675F31B FOREIGN KEY (author_id) REFERENCES user (uuid)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EEA36A5F2 FOREIGN KEY (accepted_answer_id) REFERENCES answer (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E72EE41C2 FOREIGN KEY (suggested_answer_id) REFERENCES answer (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EEA36A5F2');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E72EE41C2');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25F675F31B');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EF675F31B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F5B7AF75');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A2522F813AA');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE postal_address');
        $this->addSql('DROP TABLE question');
    }
}
