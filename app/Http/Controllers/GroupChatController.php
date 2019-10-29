<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Http\Request;
use App\Events\GroupCreated;
use Auth;

class GroupChatController extends Controller
{
    public function index()
    {
        $users = User::all();
        $idUser = Auth::id();
        $data = [
            'users' => $users,
            'groups' => Group::with('users')->get(),
            'idUser' => $idUser
        ];
        return view('groups', $data);
    }

    public function store(Request $request)
    {
        $query = [];
        $arr_id = $request->userIds;
        $input = [
            'name' => $request->groupName
        ];
        $group = Group::create($input);

        for ($i = 0; $i < count($arr_id); $i++) {
            $query[] = ['user_id' => $arr_id[$i]];
        }
        $group->users()->attach($query);

        broadcast(new GroupCreated($group))->toOthers();

        $data = [
            'message' => 'success',
            'group' => $group,
        ];
        return response()->json($data);
    }
}
