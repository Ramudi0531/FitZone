<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    // Display members
    public function index(Request $request)
    {
        $search = $request->search;

        $members = Member::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
        })->latest()->get();

        return view('members', compact('members', 'search'));
    }

    // Add member
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:255',
        ]);

        Member::create($request->only([
            'name',
            'email',
            'phone',
            'gender',
            'date_of_birth',
            'address',
        ]));

        return redirect()->route('members.index')
            ->with('success', 'Member added successfully!');
    }

    // Update member
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('members', 'email')->ignore($member->id),
            ],
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:255',
        ]);

        $member->update($request->only([
            'name',
            'email',
            'phone',
            'gender',
            'date_of_birth',
            'address',
        ]));

        return redirect()->route('members.index')
            ->with('success', 'Member updated successfully!');
    }

    // Delete member
    public function destroy($id)
    {
        $member = Member::findOrFail($id);

        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Member deleted successfully!');
    }
}