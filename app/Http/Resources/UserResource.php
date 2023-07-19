<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'surname' => $this->surname,
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password,
            'remember_token' => $this->remember_token,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'company' => new CompanyResource($this->whenLoaded('company')),
            'companyJournalist' => new CompanyJournalistResource($this->whenLoaded('companyJournalist')),
            'date' => new DateResource($this->whenLoaded('date')),
            'numberJudge' => new NumberJudgeResource($this->whenLoaded('numberJudge')),
            'results' => ParticipantResultResource::collection($this->whenLoaded('results')),
            'roles' => RoleResource::collection($this->whenLoaded('roles'))
        ];
    }
}
