<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PolicyResource;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function dashboardStaff()
    {
        $user = Auth::user();
        $policy = Policy::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return PolicyResource::collection($policy);
    }

    public function showStaff($id)
    {
        $policy = Policy::find($id);

        return new PolicyResource($policy);
    }
}
