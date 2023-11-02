<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = User::with('member')
                    ->where('role_id', config('env.role.member'))
                    ->where('users.id', '!=', auth()->id())
                    ;
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('member.photo', function($row){
                        return '<img src="'.asset('uploads/'.$row->member->photo).'" class="w-10 h-10 rounded-full">';
                    })
                    ->addColumn('action', function($row){
                        $action = '';
                        $action .= '<button onclick="edit('.$row->id.')" class="px-4 py-2 bg-yellow-500 rounded-md font-semibold text-xs text-white uppercase mr-1">Edit</button>';
                        $action .= '<button onclick="destroy('.$row->id.')" class="px-4 py-2 bg-red-500 rounded-md font-semibold text-xs text-white uppercase ">Delete</button>';
                        return $action;
                    })
                    ->rawColumns([
                        'action',
                        'member.photo'
                    ])
                    ->make(true);
        }
        return view('member.index');
    }

    public function store(Request $request)
    {
        $request->validateWithBag('memberCreation', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'ktp_number' => ['required', 'numeric', 'unique:members'],
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => config('env.role.member'),
                'phone_number' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'ktp_number' => $request->ktp_number,
            ];

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role_id' => $data['role_id'],
            ]);

            if($request->hasFile('photo')){
                $imageName = time().'.'.$request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('/uploads/member'), $imageName);
                $photo = 'member/'.$imageName;
            }

            $user->member()->create([
                'phone_number' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'ktp_number' => $request->ktp_number,
                'photo' => $photo ?? null,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Member created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }

    public function show(User $member)
    {
        return response()->json($member->load('member'));
    }

    public function update(Request $request, User $member)
    {
        $request->validateWithBag('memberUpdation', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'. $member->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'ktp_number' => ['required', 'numeric', 'unique:members,ktp_number,'.$member->member->id],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $data_user = [
                'name' => $request->name,
                'email' => $request->email,
            ];
            $data_member = [
                'phone_number' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'ktp_number' => $request->ktp_number,
            ];
            
            if($request->password){
                $data_user['password'] = bcrypt($request->password);
            }

            if($request->hasFile('photo')){
                $imageName = time().'.'.$request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('/uploads/member'), $imageName);
                $data_member['photo'] = 'member/'.$imageName;
            }

            $member->update($data_user);
            $member->member()->update($data_member);

            DB::commit();
            return redirect()->back()->with('success', 'Member updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }

    public function destroy(User $member)
    {
        try {
            DB::beginTransaction();

            $member->member()->first()->delete();
            $member->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Member deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }
}
