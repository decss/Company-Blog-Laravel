<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\PermissionsRepository;
use App\Repositories\RolesRepository;
use Gate;

class PermissionsController extends AdminController
{
    
    protected $per_rep;
    protected $rol_rep;
    
    public function __construct(PermissionsRepository $per_rep, RolesRepository $rol_rep)
    {
        parent::__construct();

        $this->per_rep = $per_rep;
        $this->rol_rep = $rol_rep;
        
        $this->template = $this->theme.'.admin.permissions';
    }

    public function index()
    {
        $this->checkAccess('EDIT_USERS');
        
        $this->title = "Менеджер прав пользователей";
        
        $roles = $this->getRoles();
        $permissions = $this->getPermissions();
        
        $this->content = view($this->theme.'.admin.permissions_content')->with(['roles'=>$roles,'priv' => $permissions])->render();
        
        return $this->renderOutput();
    }
    
    public function getRoles()
    {
        $roles = $this->rol_rep->get();
        
        return $roles;
    }
    
    public function getPermissions()
    {
        $permissions = $this->per_rep->get();
        
        return $permissions;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->checkAccess('EDIT_USERS');

		$result = $this->per_rep->changePermissions($request);

		if(is_array($result) && !empty($result['error'])) {
			return redirect('/admin/permissions')->with($result);
		}

		return redirect('/admin/permissions')->with($result);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
