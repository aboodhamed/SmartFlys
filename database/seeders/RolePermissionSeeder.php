<?php
namespace Database\Seeders;

use App\Models\Action;
use App\Models\Entity;
use App\Models\Role;
use App\Models\RolesRight;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // $permissions = [
        //     'admin' => [
        //         // databank
        //         'country' => ['create', 'show', 'edit', 'delete'],
        //         'province' => ['create', 'show', 'edit', 'delete'],
        //         'city' => ['create', 'show', 'edit', 'delete'],
        //         'category' => ['create', 'show', 'edit', 'delete'],
        //         'sukuk-type' => ['create', 'show', 'edit', 'delete'],
        //         'evaluation-authority' => ['create', 'show', 'edit', 'delete'],
        //         // User 
        //         'account' => ['show', 'edit', 'delete'],
        //         // dashboard
        //         'dashboard' => ['show'],
        //         // sukuk
        //         'sukuk' => ['create','show', 'edit', 'delete','evaluate','import', 'export'],
        //         'evaluations' => ['create','edit', 'delete', 'evaluate','import','export'],
        //         //security
        //         'system-module' => ['show'],
        //         'role-rights' => ['show'],
        //         'users' => ['show','approve','reject'], 
        //         'sessions' => ['show'],
        //         'security' => ['show'],
        //     ],
        //     'user' => [
        //         // databank
        //         'country' => ['create', 'show', 'edit', 'delete'],
        //         'province' => ['create', 'show', 'edit', 'delete'],
        //         'city' => ['create', 'show', 'edit', 'delete'],
        //         'category' => ['create', 'show', 'edit', 'delete'],
        //         'sukuk-type' => ['create', 'show', 'edit', 'delete'],
        //         'evaluation-authority' => ['create', 'show', 'edit', 'delete'],
        //         // User 
        //         'account' => ['show', 'edit', 'delete'],
        //         // dashboard
        //         'dashboard' => ['show'],
        //         // sukuk
        //         'sukuk' => ['create','show', 'edit', 'delete','evaluate','import', 'export'],
        //         'evaluations' => ['create','edit', 'delete', 'evaluate','import','export'],
        //     ],
        // ];

        // foreach ($permissions as $roleName => $entities) {
        //     $role = Role::where('RoleName', $roleName)->first();
        //     foreach ($entities as $entityName => $actions) {
        //         $entity = Entity::where('EntityName', $entityName)->first();
        //         foreach ($actions as $actionName) {
        //             $action = Action::where('ActionName', $actionName)->first();
        //             RolesRight::create([
        //                 'role_id' => $role->RoleID,
        //                 'entity_id' => $entity->EntityID,
        //                 'action_id' => $action->ActionID,
        //             ]);
        //         }
        //     }
        // }
    }
}
