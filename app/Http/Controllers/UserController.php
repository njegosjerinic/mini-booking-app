<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use app\Models\User;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $user = User::find($id);

            if ($user) {
                $user->update($request->all());
                return redirect()->back()->with('success', 'Korisnik je uspjesno updejtovan.');
            } else {
                return redirect()->back()->with('error', 'Korisnik nije pronadjen.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Korisnik nije moga biti updejtovan zbog: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
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
