<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\UserRolesEnum;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required'],
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('users.create', ['roles' => UserRolesEnum::cases()]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'username'=> ['required','unique:users,username'],
            'email'=> ['required','unique:users,email'],
            'password' => 'required',
            'role' => ['required', new Enum(UserRolesEnum::class)]
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'organization_id' => auth()->user()->organization_id,
            'role_id' => $data['role'],
        ]);

        

        return redirect('settings/' . auth()->user()->organization_id);
    }

    /**
     * Edit a merchant's profile
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Request $request)
    {
        
        $user = User::find(request('id'));
        //only allow user to edit his/her own organization profile
        $this->authorize('update',$user);  

        return view('users.edit', [
            'user' => $user,
            'roles' => UserRolesEnum::cases(),
            // 'selectedRole' => $user->role->value
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {
        $user = User::find(request('id'));

        //only allow user to edit his/her own profile
        $this->authorize('update', $user);  

        $data = $request->validate([
            'name'=>'required',
            'username'=> 'required',
            'email'=> 'required',
        ]);
        // if($request->image){  
        //     $request->validate([
        //         'image'=>['image'],
        //     ]);
            
        //     //remove old file
        //     if($merchantProfile->image != ''  && $merchantProfile->image != null){
        //         $file_old = 'storage/' . $merchantProfile->image;
        //         unlink($file_old);
        //     }

        //     //upload new file
        //     $data['image'] = request('image')->store('uploads', 'public');

        // }

        //update database
        $user->update($data);
       
        return redirect('settings/' . auth()->user()->organization_id);
    }

    /**
     * Deletes a user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Request $request)
    {
        $user = User::find(request('id'));

        //only allow user to view his/her own profile
        $this->authorize('delete', $user);  

        //remove database entry
        User::destroy(request('id'));
        
        return back();
    }
}