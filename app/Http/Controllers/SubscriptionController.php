<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Membership;

class SubscriptionController extends Controller
{
    // Display subscriptions
    public function index(Request $request)
    {
        // Automatically update subscription status
        Subscription::whereDate('expiry_date', '<', now()->toDateString())
            ->update(['status' => 'Expired']);

        Subscription::whereDate('expiry_date', '>=', now()->toDateString())
            ->update(['status' => 'Active']);

        $query = Subscription::with('membership');

        // Search member
        if ($request->filled('search')) {
            $query->where('member_name', 'like', '%' . $request->search . '%');
        }

        // Filter membership plan
        if ($request->filled('membership_id')) {
            $query->where('membership_id', $request->membership_id);
        }

        $subscriptions = $query->latest()->get();

        $memberships = Membership::all();

        return view('subscriptions', compact(
            'subscriptions',
            'memberships'
        ));
    }

    // Add subscription
    public function store(Request $request)
    {
        $request->validate([
            'member_name' => 'required|string|max:255',
            'membership_id' => 'required|exists:memberships,id',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date|after_or_equal:start_date',
        ]);

        $status = $request->expiry_date < now()->toDateString()
            ? 'Expired'
            : 'Active';

        Subscription::create([
            'member_name' => $request->member_name,
            'membership_id' => $request->membership_id,
            'start_date' => $request->start_date,
            'expiry_date' => $request->expiry_date,
            'status' => $status,
        ]);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription added successfully!');
    }

    // Update subscription
    public function update(Request $request, $id)
    {
        $request->validate([
            'member_name' => 'required|string|max:255',
            'membership_id' => 'required|exists:memberships,id',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date|after_or_equal:start_date',
        ]);

        $subscription = Subscription::findOrFail($id);

        $status = $request->expiry_date < now()->toDateString()
            ? 'Expired'
            : 'Active';

        $subscription->update([
            'member_name' => $request->member_name,
            'membership_id' => $request->membership_id,
            'start_date' => $request->start_date,
            'expiry_date' => $request->expiry_date,
            'status' => $status,
        ]);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription updated successfully!');
    }

    // Delete subscription
    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);

        $subscription->delete();

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription deleted successfully!');
    }
}