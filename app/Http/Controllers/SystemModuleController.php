<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Action;
use App\Models\Entity;
use Illuminate\Http\Request;

class SystemModuleController extends Controller
{

// index function
    public function index()
    {
        $modules = Module::all();
        $actions = Action::all();
        $entities = Entity::with('module')->get();
        return view('components.Security.system-module.index', compact('modules', 'actions', 'entities'));
    }

// addModule function
    public function addModule(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:modules,ModuleName',
        ], [
            'name.unique' => 'This module name already exists, please choose a different name.',
        ]);

        try {
            Module::create(['ModuleName' => $request->name]);
            return redirect()->back()->with('success', 'Module added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding the module: ' . $e->getMessage());
        }
    }

// edit module function
    public function editModule($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:modules,ModuleName,' . $id . ',ModuleID',
        ], [
            'name.unique' => 'This module name already exists, please choose a different name.',
        ]);

        try {
            Module::find($id)->update(['ModuleName' => $request->name]);
            return redirect()->back()->with('success', 'Module updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the module: ' . $e->getMessage());
        }
    }

// delete Module function
    public function deleteModule($id)
    {
        try {
            Module::find($id)->delete();
            return redirect()->back()->with('success', 'Module and all related data deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the module: ' . $e->getMessage());
        }
    }

// add Action Function
    public function addAction(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:actions,ActionName',
        ], [
            'name.unique' => 'This action name already exists, please choose a different name.',
        ]);

        try {
            Action::create(['ActionName' => $request->name]);
            return redirect()->back()->with('success', 'Action added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding the action: ' . $e->getMessage());
        }
    }

// edit Action Function
    public function editAction($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:actions,ActionName,' . $id . ',ActionID',
        ], [
            'name.unique' => 'This action name already exists, please choose a different name.',
        ]);

        try {
            Action::find($id)->update(['ActionName' => $request->name]);
            return redirect()->back()->with('success', 'Action updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the action: ' . $e->getMessage());
        }
    }

// delete Action Function
    public function deleteAction($id)
    {
        try {
            Action::find($id)->delete();
            return redirect()->back()->with('success', 'Action deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the action: ' . $e->getMessage());
        }
    }

// add Entity Function 
    public function addEntity(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:entities,EntityName',
            'module_id' => 'required|exists:modules,ModuleID',
        ], [
            'name.unique' => 'This entity name already exists, please choose a different name.',
            'module_id.exists' => 'The selected module does not exist.',
        ]);

        try {
            Entity::create([
                'EntityName' => $request->name,
                'ModuleID' => $request->module_id
            ]);
            return redirect()->back()->with('success', 'Entity added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding the entity: ' . $e->getMessage());
        }
    }

// edit Entity Function
    public function editEntity($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:entities,EntityName,' . $id . ',EntityID',
            'module_id' => 'required|exists:modules,ModuleID',
        ], [
            'name.unique' => 'This entity name already exists, please choose a different name.',
            'module_id.exists' => 'The selected module does not exist.',
        ]);

        try {
            Entity::find($id)->update([
                'EntityName' => $request->name,
                'ModuleID' => $request->module_id
            ]);
            return redirect()->back()->with('success', 'Entity updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the entity: ' . $e->getMessage());
        }
    }

// delete Entity Function
    public function deleteEntity($id)
    {
        try {
            Entity::find($id)->delete();
            return redirect()->back()->with('success', 'Entity deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the entity: ' . $e->getMessage());
        }
    }

// Update Entity Actions
    public function updateEntityActions($id, Request $request)
    {
        try {
            $entity = Entity::find($id);
            $entity->actions()->sync($request->actions ?? []);
            return redirect()->back()->with('success', 'Entity actions updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating entity actions: ' . $e->getMessage());
        }
    }
}