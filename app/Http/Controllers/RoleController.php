<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class RoleController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('role/Index');
    }

    public function create(): Response
    {
        $access_control_list = Role::getAccessControlList();
        return Inertia::render('role/Create', [
            'access_control_list' => $access_control_list
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'role_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'code')->whereNull('deleted_at'),
            ],
            'access_control_list' => 'required',
        ]);

        $code = $request->role_code;
        $name = $request->role_name;
        $access_control = $request->access_control_list;
        $access_control_list = [];
        foreach ($access_control as $key => $value) {
            $access_control_list[] = $value;
        }

        $model = new Role();

        $model->name = $name;
        $model->code = $code;
        $model->access_control = json_encode($access_control_list);
        if ($model->save()) {
            return redirect(route('role.index'))->with('success', 'Role created successfully');
        }
        return redirect(route('role.index'))->with('error', 'Failed to save role.');
    }

    public function search()
    {
        $query = Role::query();
        $current_user = Auth::user();

        $role_list_count = $query->count();

        $role_list = $query
            ->get();

        $data = array();

        foreach ($role_list as $key => $value) {

            $subAction = "";
            if (Auth::user()->checkAccess(Role::ACCESS_ROLE_DETAIL)) {
                $subAction = $subAction . '' . '<li class="ml-10 bg-blue-700 rounded-md text-white px-4 py-2"><a class="dropdown-item" href="' . route('role.detail', $value->id) . '">Detail</a></li>';
            }

            // if(Auth::user()->checkAccess(Role::ACCESS_ROLE_EDIT)) {
            $subAction = $subAction . '' . '<li class="ml-10 bg-green-700 rounded-md text-white px-4 py-2"><a class="dropdown-item" href="' . route('role.edit', $value->id) . '">Edit</a></li>';
            // }

            if (Auth::user()->checkAccess(Role::ACCESS_ROLE_DELETE)) {
                $subAction = $subAction . '' . '<li class="p-button p-component ml-10 p-button-danger btn-delete" type="button" aria-label="Delete" data-id="' . $value->id . '" data-pc-name="button" data-p-disabled="false" pc41="" data-pc-section="root"><span class="p-button-label" data-pc-section="label">Delete</span></li>';
            }
            $action = "";
            if ($subAction != "") {
                $action =
                    '
                <div class="dropdown">
                    <ul class="dropdown-menu flex">
                    ' . $subAction . '                    
                    </ul>
                </div>
                ';
            }
            array_push($data, array(
                'name' => $value->name,
                'code' => $value->code,
                'action' => $action
            ));
        }

        return response()->json($data);
    }

    public function detail($id): Response
    {
        $access_control_list = Role::getAccessControlList();
        $item = Role::find($id);
        return Inertia::render('role/Detail', [
            'item' => $item,
            'access_control_list' => $access_control_list,
        ]);
    }

    public function delete($id)
    {
        $item = Role::find($id);
        if ($item->delete()) {
            return redirect(route('role.index'))->with('success', 'Role deleted successfully');
        }

        return redirect(route('role.index'))->with('error', 'Role failed to delete');
    }

    public function edit($id): Response
    {
        $access_control_list = Role::getAccessControlList();
        $item = Role::find($id);
        return Inertia::render('role/Edit', [
            'item' => $item,
            'access_control_list' => $access_control_list,
        ]);
    }


    public function update($id, Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'role_code' => ['required', 'string', 'max:255', Rule::unique('roles', 'code')->ignore($id)],
            'access_control_list' => 'required',
        ]);


        $code = $request->role_code;
        $name = $request->role_name;
        $access_control = $request->access_control_list;
        $access_control_list = [];
        foreach ($access_control as $key => $value) {
            $access_control_list[] = $value;
        }

        $model = Role::find($id);

        $model->name = $name;
        $model->code = $code;
        $model->access_control = json_encode($access_control_list);
        if ($model->save()) {
            return redirect(route('role.index'))->with('success', 'Role updated successfully');
        }
        return redirect(route('role.index'))->with('error', 'Failed to save role.');
    }
}
