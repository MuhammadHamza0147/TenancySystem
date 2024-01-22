<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('domains')->get();
        return view('tenant.tenancy.index' , compact('tenants'));
    }

    public function create()
    {
        return view('tenant.tenancy.create');
    }

    function store(Request $request)
    {
        $validateData = $request->validate([
            'name' =>'required|string|max:255',
            'email' =>'required|email|max:255',
            'password' =>'required|min:6',
            'code' =>'required|string|max:255|unique:domains,domain',
        ]);

        if($validateData){
            $tenantStore = Tenant::create([
                'id' => $request->code,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $tenantStore->domains()->create([
                'domain' => $validateData['code'] . '.' . config('app.domain'),
            ]);
        }

        return redirect()->route('tenant.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $tenantEdit = Tenant::find($id);
        return view('tenant.tenancy.create' , compact('tenantEdit'));
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
