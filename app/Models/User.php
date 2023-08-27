<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    //custom function use for group permissions checked in blade file with database conditionally
    public static function roleHasPermissionsGroup( $role, $all_permissions ) {

        $hasPermissionChecked = true;
        foreach ( $all_permissions as $permit ) {
            //hasPermissionTo is a spatie default function to check is this permission existed for this role
            if ( !$role->hasPermissionTo( $permit->name ) ) {
                $hasPermissionChecked = false;
                return $hasPermissionChecked;
            }
        }
        return $hasPermissionChecked;
    }

    //custom function use for all permissions checked in blade file with database conditionally
    public static function roleHasPermissionsAll( $role, $permissions ) {

        $hasPermissionChecked = true;
        foreach ( $permissions as $permissionGrp => $permission ) {
            foreach ( $permission as $permit ) {

                //hasPermissionTo is a spatie default function to check is this permission existed for this role
                if ( !$role->hasPermissionTo( $permit->name ) ) {
                    $hasPermissionChecked = false;
                    return $hasPermissionChecked;
                }
            }
        }
        return $hasPermissionChecked;
    }
}
