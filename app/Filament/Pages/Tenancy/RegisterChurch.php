<?php

namespace App\Filament\Pages\Tenancy;

use App\Models\Church;
use App\Models\Company;
use App\Models\Role;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class RegisterChurch extends RegisterTenant
{

    public static function getLabel(): string
    {
        return 'Create a Church';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
            ]);
    }

    protected function handleRegistration(array $data): Church
    {
        return DB::transaction(function ()  use ($data) {
            
            $data['slug'] = base64_encode(Str::ulid());
            $church = Church::create($data);
            setPermissionsTeamId($church->id);
    
            // create roles
            $permissions = Permission::all();
            $ownerRole = Role::firstOrCreate([
                'name' => "owner",
                "guard_name" => 'web',
                // "church_id" => $church->id
            ]);
            $ownerRole->syncPermissions($permissions);
    
            // assign the owner role to the owner
            $user = auth()->user();
            $user->assignRole($ownerRole);
    
            $church->members()->attach(auth()->user());
            return $church;
        });

    }
}
