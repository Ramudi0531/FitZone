<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;

class MembershipController extends Controller
{
    // Display all membership plans
    public function index()
    {
        $memberships = Membership::all();

        return view('memberships', compact('memberships'));
    }

    // Add new membership plan
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'duration' => 'required|string|max:255',
        ]);

        Membership::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
        ]);

        return redirect()->route('memberships.index')
            ->with('success', 'Membership plan added successfully!');
    }

    // Update membership plan
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'duration' => 'required|string|max:255',
        ]);

        $membership = Membership::findOrFail($id);

        $membership->update([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
        ]);

        return redirect()->route('memberships.index')
            ->with('success', 'Membership plan updated successfully!');
    }

    // Delete membership plan
    public function destroy($id)
    {
        $membership = Membership::findOrFail($id);

        $membership->delete();

        return redirect()->route('memberships.index')
            ->with('success', 'Membership plan deleted successfully!');
    }
}