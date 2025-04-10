<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250408073712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE recipe_ingredient (recipe_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_22D1FE1359D8A214 (recipe_id), INDEX IDX_22D1FE13933FE08C (ingredient_id), PRIMARY KEY(recipe_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE recipe_category (recipe_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_70DCBC5F59D8A214 (recipe_id), INDEX IDX_70DCBC5F12469DE2 (category_id), PRIMARY KEY(recipe_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE1359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE13933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe_category ADD CONSTRAINT FK_70DCBC5F59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe_category ADD CONSTRAINT FK_70DCBC5F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD recipe_id_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT FK_9474526C69574A48 FOREIGN KEY (recipe_id_id) REFERENCES recipe (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_9474526C69574A48 ON comment (recipe_id_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorite ADD recipe_id_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED969574A48 FOREIGN KEY (recipe_id_id) REFERENCES recipe (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_68C58ED969574A48 ON favorite (recipe_id_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `like` ADD recipe_id_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B369574A48 FOREIGN KEY (recipe_id_id) REFERENCES recipe (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_AC6340B369574A48 ON `like` (recipe_id_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe ADD difficulty_id_id INT DEFAULT NULL, ADD user_id_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe ADD CONSTRAINT FK_DA88B1372C205AF3 FOREIGN KEY (difficulty_id_id) REFERENCES difficulty (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe ADD CONSTRAINT FK_DA88B1379D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_DA88B1372C205AF3 ON recipe (difficulty_id_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_DA88B1379D86650F ON recipe (user_id_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe_ingredient DROP FOREIGN KEY FK_22D1FE1359D8A214
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe_ingredient DROP FOREIGN KEY FK_22D1FE13933FE08C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe_category DROP FOREIGN KEY FK_70DCBC5F59D8A214
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe_category DROP FOREIGN KEY FK_70DCBC5F12469DE2
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE recipe_ingredient
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE recipe_category
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY FK_9474526C69574A48
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_9474526C69574A48 ON comment
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP recipe_id_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B1372C205AF3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B1379D86650F
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_DA88B1372C205AF3 ON recipe
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_DA88B1379D86650F ON recipe
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe DROP difficulty_id_id, DROP user_id_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B369574A48
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_AC6340B369574A48 ON `like`
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `like` DROP recipe_id_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED969574A48
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_68C58ED969574A48 ON favorite
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favorite DROP recipe_id_id
        SQL);
    }
}
