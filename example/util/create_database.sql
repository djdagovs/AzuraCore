CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE role_permissions (id INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, action_name VARCHAR(50) NOT NULL, INDEX IDX_1FBA94E6D60322AC (role_id), UNIQUE INDEX role_permission_unique_idx (role_id, action_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE settings (setting_key VARCHAR(64) NOT NULL, setting_value LONGTEXT DEFAULT NULL COMMENT '(DC2Type:json)', PRIMARY KEY(setting_key)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) DEFAULT NULL, auth_password VARCHAR(255) DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, timezone VARCHAR(100) DEFAULT NULL, locale VARCHAR(25) DEFAULT NULL, theme VARCHAR(25) DEFAULT NULL, created_at INT NOT NULL, updated_at INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE user_has_role (user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_EAB8B535A76ED395 (user_id), INDEX IDX_EAB8B535D60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE role_permissions ADD CONSTRAINT FK_1FBA94E6D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE;
ALTER TABLE user_has_role ADD CONSTRAINT FK_EAB8B535A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE;
ALTER TABLE user_has_role ADD CONSTRAINT FK_EAB8B535D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE;
