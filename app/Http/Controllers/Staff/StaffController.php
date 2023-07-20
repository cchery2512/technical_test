<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalRequest;
use App\Http\Requests\PersonalUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Facades\App\Services\Staff\Staff;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:staff.index'])->only('index');
        $this->middleware(['permission:staff.store'])->only('store');
        $this->middleware(['permission:staff.show'])->only('show');
        $this->middleware(['permission:staff.update'])->only('update');
        $this->middleware(['permission:staff.delete'])->only('delete');
    }

    public function index()
    {
        return UserResource::collection(User::with(['roles'])->paginate());
    }

    public function store(PersonalRequest $request)
    {
        $data = $request->validated();
        return new UserResource(Staff::create($data['typeOfStaff'], $request));
    }

    public function show(User $staff)
    {
        return new UserResource(Staff::show($staff));
    }

    public function update(User $staff, PersonalUpdateRequest $request)
    {
        return new UserResource(Staff::update($staff, $request));
    }

    public function delete(User $staff)
    {
        return $staff->delete();
    }
}
