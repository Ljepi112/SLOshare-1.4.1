<?php

namespace App\Interfaces;

interface WishInterface
{
    public function all();

    public function findById($id);

    public function findByTitle($title);

    public function exists($uid, $id);

    public function isGranted($id);

    public function getSource($id);

    public function getUserWishes($uid);

    public function create(array $data);

    public function delete($id);
}
