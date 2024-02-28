<?php

require_once "app/models/gallery.php";

class galleryStoreController
{
    public function index() {
        if (!array_key_exists("user", $_SESSION)) {
            header('Location: /?route=login');
            exit();
        }

        $gallery = new Gallery(unserialize($_SESSION["user"]));

        include "app/views/galleryStore.php";
    }

    public function add() {
        if (!isset($_FILES['img'])) {
            header('Location: /?route=gallery');
            exit();
        }

        if (!array_key_exists("user", $_SESSION)) {
            header('Location: /?route=login');
            exit();
        }

        $user = unserialize($_SESSION["user"]);

        $img = base64_encode(file_get_contents($_FILES['img']['tmp_name']));
        $title = $_POST['title'];
        $alt = $_POST['alt'];
        
        $gallery = new Gallery($user);
        $gallery->add($user->username(), $img, $title, $alt);

        header('Location: /?route=gallery');
    }

    public function remove() {
        if (!array_key_exists("user", $_SESSION)) {
            header('Location: /?route=login');
            exit();
        }
        
        $user = unserialize($_SESSION["user"]);

        $gallery = new Gallery($user);
        $id = $_POST['image_id'];
        $gallery->remove($id, $user->username());

        header('Location: /?route=gallery');
    }
}