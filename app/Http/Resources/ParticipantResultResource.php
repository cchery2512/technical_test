<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\ParticipantResult */
class ParticipantResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'result' => $this->result,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'judge_id' => $this->judge_id,
            'participant_id' => $this->participant_id,

            'judge' => new UserResource($this->whenLoaded('judge')),
            'participant' => new UserResource($this->whenLoaded('participant')),
        ];
    }
}
