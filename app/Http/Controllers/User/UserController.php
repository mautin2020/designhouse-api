<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\Contracts\IUser;
use App\Repositories\Eloquent\Criteria\Eagerload;

class UserController extends Controller
{

    protected $users;

    public function __construct(IUser $users)
    {
        $this->users = $users;
    }
    public function index()
    {
        $users = $this->users->withCriteria([
            new Eagerload(['designs'])
        ])->all();
        return UserResource::collection($users);
    }

    public function search(Request $request)
    {
        $designers = $this->users->search($request);
        return UserResource::collection($designers);
    }
}
