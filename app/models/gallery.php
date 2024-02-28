<?php

require_once 'app/models/user.php';

class Gallery {
    private string $filename = "bd/sql.db";
    public array $inner = array();

    public function __construct(UserModel $user) {

        $sql = new SQLite3($this->filename);

        $sql->exec("CREATE TABLE IF NOT EXISTS Gallery (id INTEGER PRIMARY KEY AUTOINCREMENT, user varchar(12), img BLOB, title varchar(12), alt varchar(30), favorite int default 0);");

        $result = $sql->query("SELECT id, img, favorite, title, alt from Gallery where user = '{$user->username()}';");

        while ($row = $result->fetchArray()) {
            $this->inner[] = new Image($row["id"], $row["img"], $row["favorite"] == "1", $row["title"], $row["alt"]);
        }

        $sql->close();
    }

    public function add(string $user, string $img, string $title, string $alt) {
        $sql = new SQLite3($this->filename);

        $stmt = $sql->prepare("INSERT INTO Gallery (user, img, title, alt) VALUES ('{$user}', :img, '{$title}', '{$alt}');");
        $stmt->bindValue(':img', $img, SQLITE3_TEXT);
        $stmt->execute();

        $sql->close();
    }

    public function remove(int $id, string $username) {
        $sql = new SQLite3($this->filename);

        $sql->exec("DELETE FROM Gallery WHERE id = '{$id}' and user = '{$username}';");

        $sql->close();
    }
}

class Image {
    public string $id;
    public string $img;
    public string $favorite;
    public string $title;
    public string $alt;

    public function __construct(int $id, string $img, string $favorite, string $title, string $alt) {
        $this->id = $id;
        $this->img = $img;
        $this->favorite = $favorite;
        $this->title = $title;
        $this->alt = $alt;
    }
}