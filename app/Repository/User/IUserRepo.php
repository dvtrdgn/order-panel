<?php

namespace App\Repository\User;

use App\Models\User;

interface IUserRepo {

    function find(int $id);
    function create($data);
    function all();
}