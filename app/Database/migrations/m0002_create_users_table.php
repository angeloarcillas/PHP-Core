<?php

use Zeretei\PHPCore\Application;

class CreateUsersTable
{
    public function up()
    {
        $sql = "CREATE TABLE heroes (
                id int(55) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name varchar(55),
                email varchar(55) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
        Application::get('database')->execute($sql);
    }

    public function down()
    {
        $sql = "DROP TABLE heroes";
        Application::get('database')->execute($sql);
    }
}
