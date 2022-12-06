<?php

namespace App\Repository\User;

use App\Models\User;

class UserRepo implements IUserRepo
{

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    function find(int $id)
    {
        return $this->user::find($id);
    }

    function create($data){
        return $this->user->create($data);
    }

    function all(){
        return $this->user::all();
    }

    
}
