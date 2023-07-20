<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParticipantResultRequest;
use App\Http\Resources\ParticipantResultResource;
use App\Models\ParticipantResult;
use Illuminate\Support\Facades\Auth;

class ParticipantResultsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:result.index'])->only('index');
        $this->middleware(['permission:result.store'])->only('store');
        $this->middleware(['permission:result.update'])->only('update');
    }

    public function index()
    {
        return ParticipantResultResource::collection(
            ParticipantResult::with(['participant.date', 'judge.numberJudge'])
                ->paginate()
        );
    }

    public function store(ParticipantResultRequest $request)
    {
        $data = $request->validated();

        $result = ParticipantResult::create([
            ...$data,
            'judge_id' => Auth::user()->id
        ]);

        return new ParticipantResultResource($result);
    }

    public function show(ParticipantResult $participantResult)
    {
    }

    public function update(ParticipantResultRequest $request, ParticipantResult $result)
    {
        $data = $request->validated();

        $result->update([
            ...$data
        ]);

        return new ParticipantResultResource($result);
    }

    public function destroy(ParticipantResult $participantResult)
    {
    }
}
