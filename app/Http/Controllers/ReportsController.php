<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input(
            'start_date',
            now()->startOfMonth()->format('Y-m-d')
        );

        $endDate = $request->input(
            'end_date',
            now()->format('Y-m-d')
        );

        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Revenue estimate from subscriptions
        $subscriptions = DB::table('subscriptions')
            ->join('memberships', 'subscriptions.membership_id', '=', 'memberships.id')
            ->whereBetween('subscriptions.start_date', [$startDate, $endDate])
            ->select(
                'subscriptions.*',
                'memberships.name as plan_name',
                'memberships.price'
            )
            ->get();

        $totalRevenue = $subscriptions->sum('price');

        // Active memberships
        $activeMemberships = DB::table('subscriptions')
            ->where('status', 'Active')
            ->whereDate('expiry_date', '>=', now()->toDateString())
            ->count();

        // Total members
        $totalMembers = DB::table('members')->count();

        // Membership renewals / expirations
        $renewals = DB::table('subscriptions')
            ->whereBetween('expiry_date', [$startDate, $endDate])
            ->count();

        // Appointments
        $appointments = DB::table('appointments')
    ->whereBetween('date', [$startDate, $endDate])
    ->get();

        $totalAppointments = $appointments->count();

        $completedAppointments = $appointments
            ->where('status', 'Completed')->count();

        $pendingAppointments = $appointments
            ->where('status', 'Pending')->count();

        // Trainers
        $totalTrainers = DB::table('trainers')->count();

        // Revenue chart
        $revenueChart = [];

        $period = Carbon::parse($startDate)->daysUntil(
            Carbon::parse($endDate)
        );

        foreach ($period as $date) {

            $dayRevenue = $subscriptions
                ->filter(function ($subscription) use ($date) {
                    return $subscription->start_date == $date->format('Y-m-d');
                })
                ->sum('price');

            $revenueChart[] = [
                'date' => $date->format('M d'),
                'amount' => (float) $dayRevenue
            ];
        }

        // Appointment chart
        $appointmentChart = [];

        foreach ($period as $date) {

            $count = $appointments
                ->where('date', $date->format('Y-m-d'))
                ->count();

            $appointmentChart[] = [
                'date' => $date->format('M d'),
                'count' => $count
            ];
        }

        // Membership distribution
        $distribution = DB::table('subscriptions')
            ->join('memberships', 'subscriptions.membership_id', '=', 'memberships.id')
            ->select(
                'memberships.name',
                DB::raw('COUNT(subscriptions.id) as total')
            )
            ->groupBy('memberships.name')
            ->get();

        $membershipCount = $distribution->sum('total');

        return view('reports', compact(
            'startDate',
            'endDate',
            'totalRevenue',
            'activeMemberships',
            'totalMembers',
            'renewals',
            'totalAppointments',
            'completedAppointments',
            'pendingAppointments',
            'totalTrainers',
            'revenueChart',
            'appointmentChart',
            'distribution',
            'membershipCount'
        ));
    }

    // Export CSV Report
    public function export(Request $request)
    {
        $startDate = $request->input(
            'start_date',
            now()->startOfMonth()->format('Y-m-d')
        );

        $endDate = $request->input(
            'end_date',
            now()->format('Y-m-d')
        );

        $subscriptions = DB::table('subscriptions')
            ->join('memberships', 'subscriptions.membership_id', '=', 'memberships.id')
            ->whereBetween('subscriptions.start_date', [$startDate, $endDate])
            ->select(
                'subscriptions.id',
                'subscriptions.member_name',
                'memberships.name as plan',
                'memberships.price',
                'subscriptions.start_date',
                'subscriptions.expiry_date',
                'subscriptions.status'
            )
            ->get();

        $filename = 'fitzone_report_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($subscriptions) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'ID',
                'Member',
                'Membership Plan',
                'Estimated Value (Rs.)',
                'Start Date',
                'Expiry Date',
                'Status'
            ]);

            foreach ($subscriptions as $subscription) {

                fputcsv($file, [
                    $subscription->id,
                    $subscription->member_name,
                    $subscription->plan,
                    $subscription->price,
                    $subscription->start_date,
                    $subscription->expiry_date,
                    $subscription->status
                ]);
            }

            fclose($file);

        }, $filename);
    }
}