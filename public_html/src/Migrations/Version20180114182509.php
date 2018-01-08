<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180114182509 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(10, 0) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_images (product INT NOT NULL, image_id INT NOT NULL, INDEX IDX_8263FFCED34A04AD (product), INDEX IDX_8263FFCE3DA5256D (image_id), PRIMARY KEY(product, image_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C53D045FB548B0F (path), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_images ADD CONSTRAINT FK_8263FFCED34A04AD FOREIGN KEY (product) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_images ADD CONSTRAINT FK_8263FFCE3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_images DROP FOREIGN KEY FK_8263FFCED34A04AD');
        $this->addSql('ALTER TABLE product_images DROP FOREIGN KEY FK_8263FFCE3DA5256D');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_images');
        $this->addSql('DROP TABLE image');
    }
}
