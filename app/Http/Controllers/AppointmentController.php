<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Member;
use App\Models\Trainer;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['member', 'trainer']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('purpose', 'like', "%{$search}%")
                  ->orWhereHas('member', function ($m) use ($search) {
                      $m->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('trainer', function ($t) use ($search) {
                      $t->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $appointments = $query->latest()->get();

        $members = Member::all();
        $trainers = Trainer::all();

        return view('appointments', compact(
            'appointments',
            'members',
            'trainers'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'trainer_id' => 'required|exists:trainers,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'purpose' => 'required|string|max:255',
            'status' => 'required|in:Pending,Confirmed,Completed,Cancelled',
        ]);

        Appointment::create($request->all());

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment booked successfully!');
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'member_id' => 'required|exists:members,id',
            'trainer_id' => 'required|exists:trainers,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'purpose' => 'required|string|max:255',
            'status' => 'required|in:Pending,Confirmed,Completed,Cancelled',
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment updated successfully!');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment deleted successfully!');
    }
}