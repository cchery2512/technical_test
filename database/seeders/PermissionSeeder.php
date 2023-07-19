<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $staffPermission = [
            'staff.index',
            'staff.store',
            'staff.show',
            'staff.update',
            'staff.delete'
        ];

        $participantPermission = [
            'participant.index'
        ];

        $resultPermission = [
          'result.index',
          'result.store'
        ];

        $accountPermission = [
            'account.show',
            'account.update'
        ];

        $arrayOfPermissionNames = [
            ...$staffPermission,
            ...$participantPermission,
            ...$accountPermission,
            ...$resultPermission
        ];
        collect($arrayOfPermissionNames)->each(function ($permission) {
            Permission::findOrCreate($permission);
        });

        $Administrator = Role::findOrCreate(RoleEnum::Administrator->value);
        $Administrator->syncPermissions([
            ...$staffPermission,
            ...$participantPermission,
            ...$accountPermission
        ]);

        $Judge = Role::findOrCreate(RoleEnum::Judge->value);
        $Judge->syncPermissions([
            ...$resultPermission,
            ...$participantPermission,
            ...$accountPermission
        ]);

        $Journalist = Role::findOrCreate(RoleEnum::Journalist->value);
        $Journalist->syncPermissions([
            ...$accountPermission
        ]);
    }
}
