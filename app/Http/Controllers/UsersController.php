<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::orderBy('id','ASC')->paginate(10);
        return view('backend.users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'name'=>'string|required|max:30',
            'email'=>'string|required|unique:users',
            'password'=>'string|required',
            'role'=>'required|in:admin,user',
            'status'=>'required|in:active,inactive',
            'photo'=>'nullable|string',
        ]);
        // dd($request->all());
        $data=$request->all();
        $data['password']=Hash::make($request->password);
        // dd($data);
        $status=User::create($data);
        // dd($status);
        if($status){
            request()->session()->flash('success','User added successfully');
        }
        else{
            request()->session()->flash('error','Error occurred while adding user');
        }
        return redirect()->route('users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::findOrFail($id);
        return view('backend.users.edit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id);
        $this->validate($request,
        [
            'name'=>'string|required|max:30',
            'email'=>'string|required',
            'role'=>'required|in:admin,user',
            'status'=>'required|in:active,inactive',
            'photo'=>'nullable|string',
        ]);
        // dd($request->all());
        $data=$request->all();
        // dd($data);
        
        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated');
        }
        else{
            request()->session()->flash('error','Error occured while updating');
        }
        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=User::findorFail($id);
        $status=$delete->delete();
        if($status){
            request()->session()->flash('success','User deleted successfully');
        }
        else{
            request()->session()->flash('error','There is an error while deleting users');
        }
        return redirect()->route('users.index');
    }

    public function apiIndex()
    {
        $users = User::orderBy('id', 'ASC')->get();
        return response()->json(['users' => $users], 200);
    }

    public function apiShow($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['user' => $user], 200);
    }

    public function apiUpdate(Request $request, $id)
{
    // Cari user berdasarkan ID
    $user = User::findOrFail($id);

    // Validasi data yang masuk
    $this->validate($request, [
        'name' => 'string|required|max:30',
        'email' => 'string|required|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8',
        'role' => 'required|in:admin,user',
        'status' => 'required|in:active,inactive',
        'photo' => 'nullable|string',
    ]);

    $data = $request->all();

    // Hash password hanya jika diberikan
    if (isset($data['password']) && !empty($data['password'])) {
        $data['password'] = Hash::make($data['password']);
    } else {
        unset($data['password']);
    }

    // Perbarui data pengguna
    $status = $user->update($data);

    if ($status) {
        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    } else {
        return response()->json(['message' => 'Error occurred while updating user'], 500);
    }
}



    public function apiStore(Request $request)
{
    $this->validate($request, [
        'name' => 'string|required|max:30',
        'email' => 'string|required|unique:users',
        'password' => 'string|required|min:8', // Tambahkan validasi minimum panjang password
        'role' => 'required|in:admin,user',
        'status' => 'required|in:active,inactive',
        'photo' => 'nullable|string',
    ]);

    $data = $request->all();
    $data['password'] = Hash::make($request->password); // Hash password sebelum menyimpan

    $user = User::create($data);

    if ($user) {
        return response()->json(['message' => 'User added successfully'], 201);
    } else {
        return response()->json(['message' => 'Error occurred while adding user'], 500);
    }
}


    public function apiDestroy($id)
    {
        $user = User::findOrFail($id);

        $deleted = $user->delete();

        if ($deleted) {
            return response()->json(['message' => 'User deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Error occurred while deleting user'], 500);
        }
    }



}
