<?php

class UserModel {
    private string $user;
    private string $pass;
    private bool $admin;

    public function __construct(string $user, string $pass, bool $admin) {
        $this->user = $user;
        $this->pass = $pass;
        $this->admin = $admin;
    }

    public function authenticate(string $username, string $password) : bool {
        return $username === $this->user && $password === $this->pass ? true : false;
    }

    public function username() : string {
        return $this->user;
    }

    public function is_admin() : bool {
        return $this->admin;
    }
}

class Users {
    private string $filename = "bd/sql.db";

    public function __construct() {
        $sql = new SQLite3($this->filename);

        $sql->exec("CREATE TABLE IF NOT EXISTS Users (user varchar(12), pass varchar(64), privilege int default 0);");

        $result = $sql->query("SELECT user from Users;");
        
        $hasAdmin = false;
        foreach (@$result->fetchArray() as $user)
            if ($user == "admin") {
                $hasAdmin = true;
                break;
            }

        if (!$hasAdmin) {
            $pass = hash('sha256', "admin");
            $sql->exec("INSERT INTO Users (user, pass, privilege) VALUES ('admin', '{$pass}', 1);");
        }

        $sql->close();
    }

    public function authenticate(string $username, string $password) : UserModel|false {
        $sql = new SQLite3($this->filename);

        $pass = hash('sha256', $password);
        $result = $sql->query("SELECT user, pass, privilege from Users where user = '{$username}' and pass = '{$pass}';");

        $row = $result->fetchArray(SQLITE3_ASSOC);

        if (!$row)
            return false;

        $user = new UserModel($row["user"], $row["pass"], $row["privilege"] == "1");

        $sql->close();
        
        return $user;
    }

    function save(): int|false {
        
    }

    function add(string $username, string $password, bool $admin) {
        
    }

    function remove(int $key) {
        
    }
}