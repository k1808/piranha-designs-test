<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    public function index()
    {
       return UserResource::collection(User::paginate(10));
    }
}
