<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers()
    {
        return "Get All Users";
    }

    public function createUser()
    {
        return "Update User";
    }

    public function deleteUser()
    {
        return "Delete user";
    }
}
