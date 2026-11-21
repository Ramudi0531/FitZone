<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FitZone - Performance Reports</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: #0b0b0b;
    color: white;
}

/* SIDEBAR */

.sidebar {
    width: 230px;
    height: 100vh;
    background: #11130e;
    position: fixed;
    padding: 25px 18px;
    overflow-y: auto;
}

.logo {
    font-size: 27px;
    font-weight: bold;
    margin-bottom: 40px;
}

.logo span {
    color: #a8ff00;
}

.sidebar a {
    display: block;
    color: #aaa;
    text-decoration: none;
    padding: 13px;
    margin-bottom: 7px;
    border-radius: 7px;
    font-size: 14px;
    transition: .3s;
}

.sidebar a:hover {
    background: #292929;
    color: #a8ff00;
}

.sidebar a.active {
    background: #a8ff00;
    color: black;
    font-weight: bold;
}

/* MAIN */

.main {
    margin-left: 230px;
    padding: 35px;
}

h1 {
    font-size: 28px;
    margin-bottom: 8px;
}

.subtitle {
    color: #888;
    margin-bottom: 25px;
}

/* HEADER */

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 25px;
}

.header-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

/* BUTTONS */

button, .export-btn {
    background: #a8ff00;
    color: black;
    border: none;
    padding: 12px 17px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    text-decoration: none;
    font-size: 13px;
}

button:hover, .export-btn:hover {
    background: #8bd600;
}

/* DATE FILTER */

.date-filter {
    display: flex;
    gap: 8px;
    align-items: center;
    flex-wrap: wrap;
}

input[type="date"] {
    background: #191919;
    color: white;
    border: 1px solid #333;
    padding: 11px;
    border-radius: 6px;
}

/* TABS */

.tabs {
    display: flex;
    gap: 8px;
    margin-bottom: 25px;
    flex-wrap: wrap;
}

.tab {
    background: #171717;
    color: #aaa;
    padding: 11px 20px;
    border-radius: 6px;
    cursor: pointer;
    border: none;
}

.tab.active {
    background: #a8ff00;
    color: black;
}

/* STAT CARDS */

.stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 17px;
    margin-bottom: 20px;
}

.stat-card {
    background: #171717;
    border: 1px solid #292929;
    border-radius: 10px;
    padding: 20px;
}

.stat-card p {
    color: #999;
    font-size: 12px;
    margin-bottom: 10px;
}

.stat-card h2 {
    font-size: 24px;
    color: white;
}

.stat-card small {
    color: #a8ff00;
    display: block;
    margin-top: 9px;
    font-size: 11px;
}

/* CHARTS */

.charts {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    margin-bottom: 20px;
}

.chart-card {
    background: #171717;
    border: 1px solid #292929;
    border-radius: 10px;
    padding: 22px;
    min-width: 0;
}

.chart-card h3 {
    font-size: 16px;
    margin-bottom: 10px;
}

.chart-card p {
    color: #888;
    font-size: 12px;
    margin-bottom: 20px;
}

.chart-box {
    position: relative;
    height: 220px;
}

/* BOTTOM */

.bottom {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 18px;
}

.donut-card, .table-card {
    background: #171717;
    border: 1px solid #292929;
    border-radius: 10px;
    padding: 22px;
    min-width: 0;
}

.donut-box {
    position: relative;
    height: 210px;
    max-width: 260px;
    margin: auto;
}

.table-card h3, .donut-card h3 {
    margin-bottom: 20px;
    font-size: 17px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    text-align: left;
    color: #a8ff00;
    font-size: 12px;
    padding: 13px 8px;
    border-bottom: 1px solid #333;
}

td {
    color: #ccc;
    padding: 14px 8px;
    font-size: 12px;
    border-bottom: 1px solid #292929;
}

/* CONTENT TABS */

.report-section {
    display: none;
}

.report-section.show {
    display: block;
}

.note {
    color: #999;
    font-size: 12px;
    margin-top: 15px;
    line-height: 1.6;
}

/* RESPONSIVE */

@media(max-width: 1100px) {

    .stats {
        grid-template-columns: repeat(2, 1fr);
    }

    .charts {
        grid-template-columns: 1fr;
    }

}

@media(max-width: 700px) {

    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }

    .main {
        margin-left: 0;
        padding: 18px;
    }

    .stats {
        grid-template-columns: 1fr;
    }

    .bottom {
        grid-template-columns: 1fr;
    }

    .header {
        align-items: flex-start;
    }

}

</style>

</head>

<body>

<!-- SIDEBAR -->

<aside class="sidebar">

    <div class="logo">Fit<span>Zone</span></div>

    <a href="#">Dashboard</a>
<a href="{{ route('members.index') }}">Members</a>
<a href="{{ route('memberships.index') }}">Memberships</a>
<a href="#">Trainers</a>
<a href="#">Workouts</a>
<a href="#">Attendance</a>
 <a href="{{ route('appointments.index') }}" >
        Appointments
    </a>
<a href="#">Payments</a>
<a href="#">Products</a>
<a href="#">Orders</a>

<a href="{{ route('reports.index') }}" class="active">
    Reports
</a>

<a href="#">Settings</a>
 <a href="{{ route('subscriptions.index') }}" >
        Subscriptions
    </a>
</aside>


<!-- MAIN -->

<main class="main">

    <div class="header">

        <div>

            <h1>PERFORMANCE REPORTS</h1>

            <p class="subtitle">
                Turn daily operations into better gym decisions.
            </p>

        </div>

        <div class="header-actions">

            <form action="{{ route('reports.index') }}" method="GET" class="date-filter">

                <input
                    type="date"
                    name="start_date"
                    value="{{ $startDate }}"
                    required
                >

                <input
                    type="date"
                    name="end_date"
                    value="{{ $endDate }}"
                    required
                >

                <button type="submit">Apply</button>

            </form>

            <a href="{{ route('reports.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
               class="export-btn">
                ↓ Export Report
            </a>

        </div>

    </div>


    <!-- TABS -->

    <div class="tabs">

        <button class="tab active" onclick="showTab('overview', this)">
            Overview
        </button>

        <button class="tab" onclick="showTab('revenue', this)">
            Revenue
        </button>

        <button class="tab" onclick="showTab('appointments', this)">
            Appointments
        </button>

        <button class="tab" onclick="showTab('memberships', this)">
            Memberships
        </button>

    </div>


    <!-- OVERVIEW -->

    <section id="overview" class="report-section show">

        <div class="stats">

            <div class="stat-card">

                <p>Estimated Subscription Value</p>

                <h2>Rs. {{ number_format($totalRevenue) }}</h2>

                <small>Based on membership prices</small>

            </div>


            <div class="stat-card">

                <p>Active Memberships</p>

                <h2>{{ number_format($activeMemberships) }}</h2>

                <small>Currently active subscriptions</small>

            </div>


            <div class="stat-card">

                <p>Completed Appointments</p>

                <h2>{{ number_format($completedAppointments) }}</h2>

                <small>Within selected date range</small>

            </div>


            <div class="stat-card">

                <p>Membership Expirations</p>

                <h2>{{ number_format($renewals) }}</h2>

                <small>Expiring within selected period</small>

            </div>

        </div>


        <div class="charts">

            <div class="chart-card">

                <h3>Revenue Trend</h3>

                <p>Estimated subscription value - Daily</p>

                <div class="chart-box">

                    <canvas id="revenueChart"></canvas>

                </div>

            </div>


            <div class="chart-card">

                <h3>Appointment Trend</h3>

                <p>Daily appointment bookings</p>

                <div class="chart-box">

                    <canvas id="appointmentChart"></canvas>

                </div>

            </div>

        </div>


        <div class="bottom">

            <div class="donut-card">

                <h3>Membership Distribution</h3>

                <div class="donut-box">

                    <canvas id="membershipChart"></canvas>

                </div>

                <p class="note">
                    {{ $membershipCount }} total subscriptions.
                    Distribution by membership plan.
                </p>

            </div>


            <div class="table-card">

                <h3>Operations Summary</h3>

                <div style="overflow-x:auto;">

                    <table>

                        <thead>

                            <tr>

                                <th>INDICATOR</th>

                                <th>CURRENT</th>

                                <th>OBSERVATION</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>Total Members</td>

                                <td>{{ $totalMembers }}</td>

                                <td>Registered members</td>

                            </tr>

                            <tr>

                                <td>Trainer Count</td>

                                <td>{{ $totalTrainers }}</td>

                                <td>Registered trainers</td>

                            </tr>

                            <tr>

                                <td>Appointments</td>

                                <td>{{ $totalAppointments }}</td>

                                <td>Selected date range</td>

                            </tr>

                            <tr>

                                <td>Pending Appointments</td>

                                <td>{{ $pendingAppointments }}</td>

                                <td>Awaiting completion</td>

                            </tr>

                            <tr>

                                <td>Active Memberships</td>

                                <td>{{ $activeMemberships }}</td>

                                <td>Current active plans</td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>


    <!-- REVENUE -->

    <section id="revenue" class="report-section">

        <div class="chart-card">

            <h3>Revenue Overview</h3>

            <p>Estimated value of subscriptions created during selected period.</p>

            <h2 style="color:#a8ff00;margin-bottom:25px;">
                Rs. {{ number_format($totalRevenue, 2) }}
            </h2>

            <div class="chart-box">

                <canvas id="revenueChart2"></canvas>

            </div>

            <p class="note">
                This is calculated using membership plan prices,
                not confirmed payments received.
            </p>

        </div>

    </section>


    <!-- APPOINTMENTS -->

    <section id="appointments" class="report-section">

        <div class="stats">

            <div class="stat-card">

                <p>Total Appointments</p>

                <h2>{{ $totalAppointments }}</h2>

            </div>

            <div class="stat-card">

                <p>Completed</p>

                <h2>{{ $completedAppointments }}</h2>

            </div>

            <div class="stat-card">

                <p>Pending</p>

                <h2>{{ $pendingAppointments }}</h2>

            </div>

            <div class="stat-card">

                <p>Total Trainers</p>

                <h2>{{ $totalTrainers }}</h2>

            </div>

        </div>

        <div class="chart-card">

            <h3>Appointment Trend</h3>

            <div class="chart-box">

                <canvas id="appointmentChart2"></canvas>

            </div>

        </div>

        <p class="note">
            Completed appointments are not the same as verified gym attendance.
            An Attendance table is required for actual attendance reports.
        </p>

    </section>


    <!-- MEMBERSHIPS -->

    <section id="memberships" class="report-section">

        <div class="stats">

            <div class="stat-card">

                <p>Total Subscriptions</p>

                <h2>{{ $membershipCount }}</h2>

            </div>

            <div class="stat-card">

                <p>Active Memberships</p>

                <h2>{{ $activeMemberships }}</h2>

            </div>

            <div class="stat-card">

                <p>Membership Expirations</p>

                <h2>{{ $renewals }}</h2>

            </div>

            <div class="stat-card">

                <p>Total Members</p>

                <h2>{{ $totalMembers }}</h2>

            </div>

        </div>


        <div class="table-card">

            <h3>Membership Distribution</h3>

            <div style="overflow-x:auto;">

                <table>

                    <thead>

                        <tr>

                            <th>MEMBERSHIP PLAN</th>

                            <th>TOTAL SUBSCRIPTIONS</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($distribution as $item)

                            <tr>

                                <td>{{ $item->name }}</td>

                                <td>{{ $item->total }}</td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="2">No membership data available.</td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </section>


</main>


<!-- CHARTS JAVASCRIPT -->

<script>

const green = '#a8ff00';

const labels = @json(collect($revenueChart)->pluck('date'));

const revenueData = @json(collect($revenueChart)->pluck('amount'));

const appointmentData = @json(collect($appointmentChart)->pluck('count'));

const membershipLabels = @json($distribution->pluck('name'));

const membershipData = @json($distribution->pluck('total'));


function makeBarChart(id) {

    const element = document.getElementById(id);

    if (!element) return;

    return new Chart(element, {

        type: 'bar',

        data: {

            labels: labels,

            datasets: [{

                label: 'Estimated Value (Rs.)',

                data: revenueData,

                backgroundColor: green,

                borderRadius: 5

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    display: false

                }

            },

            scales: {

                x: {

                    ticks: { color: '#aaa' },

                    grid: { display: false }

                },

                y: {

                    ticks: { color: '#aaa' },

                    grid: { color: '#292929' }

                }

            }

        }

    });

}


function makeLineChart(id) {

    const element = document.getElementById(id);

    if (!element) return;

    return new Chart(element, {

        type: 'line',

        data: {

            labels: labels,

            datasets: [{

                label: 'Appointments',

                data: appointmentData,

                borderColor: green,

                backgroundColor: 'rgba(168,255,0,0.1)',

                fill: true,

                tension: 0.4,

                pointRadius: 3

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: { display: false }

            },

            scales: {

                x: {

                    ticks: { color: '#aaa' },

                    grid: { color: '#292929' }

                },

                y: {

                    beginAtZero: true,

                    ticks: {

                        color: '#aaa',

                        precision: 0

                    },

                    grid: { color: '#292929' }

                }

            }

        }

    });

}


function makeDonutChart() {

    const element = document.getElementById('membershipChart');

    if (!element) return;

    new Chart(element, {

        type: 'doughnut',

        data: {

            labels: membershipLabels,

            datasets: [{

                data: membershipData,

                backgroundColor: [

                    '#a8ff00',

                    '#70a900',

                    '#4d6630',

                    '#b6d987',

                    '#777777'

                ],

                borderWidth: 0

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    position: 'bottom',

                    labels: {

                        color: '#ccc',

                        padding: 15

                    }

                }

            },

            cutout: '65%'

        }

    });

}


makeBarChart('revenueChart');

makeBarChart('revenueChart2');

makeLineChart('appointmentChart');

makeLineChart('appointmentChart2');

makeDonutChart();


function showTab(tabName, button) {

    document.querySelectorAll('.report-section').forEach(section => {

        section.classList.remove('show');

    });

    document.getElementById(tabName).classList.add('show');


    document.querySelectorAll('.tab').forEach(tab => {

        tab.classList.remove('active');

    });

    button.classList.add('active');

}

</script>

</body>

</html>