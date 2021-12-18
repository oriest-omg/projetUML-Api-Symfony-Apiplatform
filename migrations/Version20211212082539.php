<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211212082539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant ADD sexe VARCHAR(255) DEFAULT NULL, ADD date_naissance DATE DEFAULT NULL, ADD lieu_naissance VARCHAR(255) DEFAULT NULL, ADD tel_etudiant VARCHAR(255) DEFAULT NULL, ADD tel_parent VARCHAR(255) DEFAULT NULL, ADD cni VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP sexe, DROP date_naissance, DROP lieu_naissance, DROP tel_etudiant, DROP tel_parent, DROP cni');
    }
}
