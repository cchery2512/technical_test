<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'surname'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function date(): HasOne
    {
        return $this->hasOne(Date::class, 'user_id');
    }

    public function numberJudge(): HasOne
    {
        return $this->hasOne(NumberJudge::class, 'user_id');
    }

    public function companyJournalist(): HasOne
    {
        return $this->hasOne(CompanyJournalist::class, 'user_id');
    }

    public function results(): HasMany
    {
        return $this->hasMany(ParticipantResult::class, 'participant_id', 'id');
    }

    public function company()
    {
        return $this->hasOneThrough(
            Company::class,
            CompanyJournalist::class,
            'user_id',
            'id',
            'id',
            'company_id'
        );
    }

    public function scopeTotalResult(Builder $query): Builder
    {
        return $query->withAvg('results','result');
    }
}