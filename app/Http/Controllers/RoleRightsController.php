<?php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Module;
use App\Models\Entity;
use App\Models\Action;
use Illuminate\Http\Request;

class RoleRightsController extends Controller
{

// index function
    public function index()
    {
        $roles = Role::with(['permissions', 'actions'])->get();
        $modules = Module::with('entities')->get();
        $entities = Entity::with('actions')->get();
        $actions = Action::all();
        return view('components.Security.role-rights.index', compact('roles', 'modules', 'entities', 'actions'));
    }

// addRole Function 
    public function addRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,RoleName',
        ]);

        try {
            Role::create(['RoleName' => $request->name]);
            return redirect()->back()->with('success', 'Role added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add role: ' . $e->getMessage());
        }
    }

// editRole Function
    public function editRole($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,RoleName,' . $id . ',RoleID',
            'permissions' => 'array',
        ]);

        try {
            $role = Role::findOrFail($id);
            $role->update(['RoleName' => $request->name]);

            $syncData = [];
            if ($request->has('permissions')) {
                foreach ($request->permissions as $entityId => $actionIds) {
                    foreach ((array)$actionIds as $actionId) {
                        $syncData[$entityId][] = ['action_id' => $actionId];
                    }
                }
            }

            // Sync الصلاحيات مع الجدول
            $role->permissions()->sync([]);
            foreach ($syncData as $entityId => $actions) {
                foreach ($actions as $action) {
                    $role->permissions()->attach($entityId, ['action_id' => $action['action_id']]);
                }
            }

            return redirect()->back()->with('success', 'Role updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update role: ' . $e->getMessage());
        }
    }

// deleteRole Function
    public function deleteRole($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->permissions()->detach();
            $role->delete();
            return redirect()->back()->with('success', 'Role deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete role: ' . $e->getMessage());
        }
    }
}