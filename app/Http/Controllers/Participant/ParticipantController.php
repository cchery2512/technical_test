<?php

namespace App\Http\Controllers\Participant;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:participant.index'])->only('index');
    }


    public function index()
    {
        return UserResource::collection(
            User::role(RoleEnum::Participant->value)
                ->with(['date'])
                ->paginate()
        );
    }

    public function store(Request $request)
    {
    }

    public function show(User $participant)
    {
    }

    public function update(Request $request, User $participant)
    {
    }

    public function destroy(User $participant)
    {
    }
}
