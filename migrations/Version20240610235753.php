<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240610235753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, INDEX IDX_5FB6DEC71E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFB1E27F6BF');
        $this->addSql('DROP TABLE response');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E4584665A');
        $this->addSql('DROP INDEX IDX_B6F7494E4584665A ON question');
        $this->addSql('ALTER TABLE question DROP product_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE response (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, content VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_3E7B0BFB1E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFB1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC71E27F6BF');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('ALTER TABLE question ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B6F7494E4584665A ON question (product_id)');
    }
}
