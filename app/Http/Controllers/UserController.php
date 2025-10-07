<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use app\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function edit(string $id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.users.edit', compact('user'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('modal', [
                'message' => 'Korisnik nije pronađen.',
                'type' => 'error'
            ]);
        }
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return redirect()->back()->with('modal', [
                    'message' => 'Korisnik nije pronađen.',
                    'type' => 'error'
                ]);
            }

            $data = $request->except('role');

            $user->fill($data);

            if ($request->filled('role')) {
                if ($user->id != Auth::user()->id) {
                    $user->role = $request->input('role');
                } else {
                    return redirect()->back()->with('modal', [
                        'message' => 'Ne moze se izmjeniti uloga korisnik dok je ulogovan',
                        'type' => 'error'
                    ]);
                }
            }

            $user->save();

            return redirect()->back()->with('modal', [
                'message' => 'Korisnik je uspješno ažuriran.',
                'type' => 'success'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('modal', [
                'message' => 'Korisnik nije mogao biti ažuriran.',
                'type' => 'error'
            ]);
        }
    }


    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->back()->with('modal', [
                'message' => 'Korisnik je uspjesno izbrisan.',
                'type' => 'success'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('modal', [
                'message' => 'Korisnik nije moga biti izbrisan.',
                'type' => 'error'
            ]);
        }
    }
}
