<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
  public function run()
  {
    $everybody = Role::ROLE_ALIASES;
    $admins = Role::ADMINS_ROLE_ALIASES;

    $admin = Role::ADMIN_ROLE_ALIAS;
    $client = Role::CLIENT_ROLE_ALIAS;

    $permissions = [

      ...self::createPermissions('otp', ['can_use' => "Pouvoir utiliser la connexion OTP"], $everybody),
      ...self::createPermissions('password', ['can_change' => "Pouvoir changer son mot de passe"], $everybody),

      ...self::createPermissions('app_configuration', ['create', 'edit', 'delete', 'access'], $admins),
      ...self::createPermissions('app_configuration', ['show'], $everybody),

      ...self::createPermissions('permission', ['create', 'edit', 'delete', 'manage'], $admins),
      ...self::createPermissions('permission', ['show', 'access'], $everybody),

      ...self::createPermissions('role', ['create', 'edit', 'delete', 'manage'], $admins),
      ...self::createPermissions('role', ['show', 'access'], $everybody),

      ...self::createPermissions('user', ['create', 'edit', 'delete'], $everybody),
      ...self::createPermissions('user', ['show', 'access'], $everybody),

      ...self::createPermissions('product', ['show', 'access', 'create', 'edit', 'delete'], $everybody),
    ];

    Permission::insert($permissions);
  }

  public static function createPermissions($resource, $permissions, $default_roles = [], $module = null)
  {
    $result = array_map(function ($permission, $description) use (&$resource, &$default_roles, &$module) {
      if(gettype($permission) == "integer")
      {
        $permission = $description;
        $description = null;
      }
      $item = [
        "title" => $resource . '_' . $permission,
        "resource" => $resource,
        "module" => $module,
        "description" => $description,
        "action" => $permission,
        "default_roles" => json_encode($default_roles)
      ];
      return $item;
    }, array_keys($permissions),   $permissions);

    return $result;
  }
}
