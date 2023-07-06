<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function showPages()
    {
        $menuItems = MenuItem::all();
        $roles = Role::all();
        return view('admin.pages', compact('menuItems', 'roles'));
    }
    public function assignMenuToRole(Request $request)
    {
        $role_id = $request->input('role_id');
        $menu_id = $request->menu_id;
        $role = Role::find($role_id);
        $menu_item = MenuItem::find($menu_id);

        if ($role && $menu_item) {
            if (!$role->menuItems->contains($menu_item)) {
                $role->menuItems()->attach($menu_id);
                return response()->json(['success' => true, 'message' => 'Menu item assigned to role successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Menu item is already assigned to this role']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong']);
    }

    public function removeMenuFromRole(Request $request)
    {
        $role_id = $request->role_id;
        $menu_id = $request->menu_id;
        $role = Role::find($role_id);
        $menu_item = MenuItem::find($menu_id);
        if ($role && $menu_item) {
            if (!$role->menuItems()->where('menu_item_id', $menu_id)->exists()) {
                return response()->json(['success' => false, 'message' => 'Menu item is not assigned to this role']);
            }
            $role->menuItems()->detach($menu_id);
            return response()->json(['success' => true, 'message' => 'Menu item removed from role successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong']);
    }
    public function createMenuItem(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'route'=> 'required',
            'role_id' => 'required|integer|exists:roles,id',
        ]);
        $menuItem = new MenuItem(['name' => $validatedData['name'], 'route' => $validatedData['route'], 'order' => MenuItem::count() + 1]);
        $menuItem->save();
        $role = Role::find($validatedData['role_id']);
        $role->menuItems()->attach($menuItem->id);
        return response()->json(['success' => true]);
    }
    public function getRoleSpecificMenus(Request $request)
    {
        $menuItems = $request->user()->role->menuItems;
        $user = Auth::user();
        $role = $user->role;
        if ($role->name === 'admin') {
            $menuItems = MenuItem::all();
        } else {
            $menuItems = $role->menuItems;
        }
        
        return view('partials.navbar', compact('menuItems'));
    }
}
