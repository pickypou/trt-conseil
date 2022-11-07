<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221107100951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recruteurs ADD recruteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recruteurs ADD CONSTRAINT FK_FF2BD367BB0859F1 FOREIGN KEY (recruteur_id) REFERENCES `user` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FF2BD367BB0859F1 ON recruteurs (recruteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recruteurs DROP FOREIGN KEY FK_FF2BD367BB0859F1');
        $this->addSql('DROP INDEX UNIQ_FF2BD367BB0859F1 ON recruteurs');
        $this->addSql('ALTER TABLE recruteurs DROP recruteur_id');
    }
}
