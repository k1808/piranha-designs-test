<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminDashboardResource;
use App\Http\Resources\PolicyResource;
use App\Models\Policy;
use App\Models\User;
use Illuminate\Http\Request;

class AdminOperationController extends Controller
{
    public function allStaff()
    {
        $users =  User::where('role_id', '<>', 1)->with('policies')->get();
        return AdminDashboardResource::collection($users);
    }

    public function changeLogin(Request $request)
    {
        $data = $request->validate([
            'id' => ['integer'],
            'name' => ['string'],
        ]);
        $user = User::find($data['id']);
        $user->update(['name'=>$data['name']]);
        return new AdminDashboardResource($user);
    }

    public function editStaff($id)
    {
        $users =  User::where('role_id', '<>', 1)->where(['id'=>$id])->with('policies')->first();
        return new AdminDashboardResource($users);
    }

    public function freePolicy($user)
    {
        $user = User::where(['id'=>$user])->with('policies')->first();

        $otherPolicies = \App\Models\Policy::whereDoesntHave('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        return PolicyResource::collection($otherPolicies);
    }
    public function addPolicyForUser(Request $request)
    {
        $data = $request->validate([
            'id' => ['integer'],
            'polices' => ['array'],
        ]);

        $user = User::find($data['id']);
        $policy = Policy::find($data['polices']);
        $user->policies()->attach($policy);

        $otherPolicies = Policy::whereDoesntHave('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        return response()->json([
            'editStaff' => new AdminDashboardResource($user),
            'freePolicy' => PolicyResource::collection($otherPolicies)
        ]);
    }

    public function removePolicyForUser(Request $request)
    {
        $data = $request->validate([
            'id' => ['integer'],
            'policy' => ['integer'],
        ]);
        $user = User::find($data['id']);
        $policy = Policy::find($data['policy']);
        $user->policies()->detach($policy);

        $otherPolicies = Policy::whereDoesntHave('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        return response()->json([
            'editStaff' => new AdminDashboardResource($user),
            'freePolicy' => PolicyResource::collection($otherPolicies)
        ]);
    }

    public function removeAllPolicyForUser(Request $request)
    {
        $data = $request->validate([
            'id' => ['integer'],
        ]);
        $user = User::find($data['id']);
        $policy = Policy::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        $user->policies()->detach($policy);

        $otherPolicies = Policy::whereDoesntHave('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        return response()->json([
            'editStaff' => new AdminDashboardResource($user),
            'freePolicy' => PolicyResource::collection($otherPolicies)
        ]);
    }
}
