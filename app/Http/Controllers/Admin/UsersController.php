<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Users\User;

class UsersController extends Controller {

	public function index()
    {
        $users = User::all();
        return $this->layout->content = view('admin.users.index')->withUsers($users);
    }

}
