<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use app\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }


    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return redirect()->back()->with('error', 'Korisnik nije pronađen.');
            }

            $data = $request->except('role');

            $user->fill($data);

            if ($request->filled('role')) {
                if($user->id != Auth::user()->id){
                    $user->role = $request->input('role');
                }else{
                    return redirect()->back()->with('error', 'Ne moze se izmjeniti uloga korisnik dok je ulogovan');
                }
            }

            $user->save();

            return redirect()->back()->with('success', 'Korisnik je uspješno ažuriran.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Korisnik nije mogao biti ažuriran zbog: ' . $e->getMessage());
        }
    }


    public function destroy(string $id)
    {
        try {
            $user = User::find($id);

            if ($user) {
                $user->delete();
                return redirect()->back()->with('success', 'Korisnik je uspjesno izbrisan.');
            } else {
                return redirect()->back()->with('error', 'Korisnik nije pronadjen.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Korisnik nije moga biti izbrisan zbog: ' . $e->getMessage());
        }
    }
}
