<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = User::where('role_id', config('env.role.administrator'))
                    ->where('id', '!=', auth()->id())
                    ;
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $action = '';
                        $action .= '<button onclick="edit('.$row->id.')" class="px-4 py-2 bg-yellow-500 rounded-md font-semibold text-xs text-white uppercase mr-1">Edit</button>';
                        $action .= '<button onclick="destroy('.$row->id.')" class="px-4 py-2 bg-red-500 rounded-md font-semibold text-xs text-white uppercase ">Delete</button>';
                        return $action;
                    })
                    ->rawColumns([
                        'action'
                    ])
                    ->make(true);
        }
        return view('administrator.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validateWithBag('adminCreation', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            DB::beginTransaction();

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => config('env.role.administrator'),
            ];

            User::create($data);

            DB::commit();

            return redirect()->back()->with('success', 'Administrator created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $administrator)
    {
        return response()->json($administrator);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $administrator)
    {
        $request->validateWithBag('adminUpdation', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$administrator->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            DB::beginTransaction();

            $data = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            if($request->password){
                $data['password'] = bcrypt($request->password);
            }

            $administrator->update($data);

            DB::commit();

            return redirect()->back()->with('success', 'Administrator updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $administrator)
    {
        try {
            DB::beginTransaction();

            $administrator->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Administrator deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }
}
