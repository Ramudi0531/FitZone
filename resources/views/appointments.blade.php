<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FitZone - Appointments</title>

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
    margin-bottom: 35px;
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
    font-size: 30px;
    margin-bottom: 10px;
}

.subtitle {
    color: #999;
    margin-bottom: 30px;
}

h2 {
    color: #a8ff00;
    margin-bottom: 22px;
    font-size: 20px;
}

/* CARDS */

.card {
    background: #171717;
    border: 1px solid #292929;
    padding: 25px;
    border-radius: 10px;
    margin-bottom: 25px;
}

/* FORM */

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

input, select {
    width: 100%;
    padding: 13px;
    background: #252525;
    border: 1px solid #444;
    border-radius: 7px;
    color: white;
    margin-bottom: 12px;
    outline: none;
}

input:focus, select:focus {
    border-color: #a8ff00;
}

/* BUTTONS */

button {
    padding: 12px 18px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    background: #a8ff00;
    color: black;
}

button:hover {
    background: #8bd600;
}

.delete-btn {
    background: #e53935;
    color: white;
}

.edit-btn {
    background: #a8ff00;
    color: black;
}

/* SEARCH */

.search-box {
    display: flex;
    gap: 12px;
}

.search-box input {
    flex: 1;
}

/* TABLE */

.table-wrapper {
    overflow-x: auto;
}

table {
    width: 100%;
    min-width: 850px;
    border-collapse: collapse;
}

th {
    color: #a8ff00;
    text-align: left;
    padding: 15px;
    border-bottom: 1px solid #444;
}

td {
    padding: 15px;
    border-bottom: 1px solid #292929;
    color: #ddd;
}

tbody tr:hover {
    background: #202020;
}

/* STATUS */

.status {
    padding: 6px 10px;
    border-radius: 5px;
    font-size: 12px;
    font-weight: bold;
}

.Pending {
    background: #594916;
    color: #ffd966;
}

.Confirmed {
    background: #173e25;
    color: #7cff9a;
}

.Completed {
    background: #193b13;
    color: #a8ff00;
}

.Cancelled {
    background: #4a1c1c;
    color: #ff8585;
}

/* ACTIONS */

.actions {
    display: flex;
    gap: 7px;
}

/* EDIT */

.edit-form {
    display: none;
    background: #202020;
}

.edit-form td {
    padding: 20px;
}

.edit-form h3 {
    color: #a8ff00;
    margin-bottom: 15px;
}

/* MESSAGES */

.success {
    background: #193b13;
    color: #a8ff00;
    padding: 14px;
    margin-bottom: 20px;
    border-radius: 7px;
}

.error-box {
    background: #451b1b;
    color: #ff9999;
    padding: 14px;
    margin-bottom: 20px;
    border-radius: 7px;
}

/* RESPONSIVE */

@media(max-width: 900px) {

    .sidebar {
        width: 190px;
    }

    .main {
        margin-left: 190px;
        padding: 20px;
    }

    .form-grid {
        grid-template-columns: 1fr;
    }
}

@media(max-width: 650px) {

    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }

    .main {
        margin-left: 0;
    }

    .search-box {
        flex-wrap: wrap;
    }
}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <div class="logo">Fit<span>Zone</span></div>

    <a href="#">Dashboard</a>

    <a href="{{ route('members.index') }}">Members</a>

    <a href="{{ route('memberships.index') }}">Memberships</a>

    <a href="#">Trainers</a>

    <a href="#">Workouts</a>

    <a href="#">Attendance</a>

    <a href="{{ route('appointments.index') }}" class="active">
        Appointments
    </a>

    <a href="#">Payments</a>

    <a href="#">Products</a>

    <a href="#">Orders</a>

    <a href="{{ route('reports.index') }}">Reports</a>

    <a href="#">Settings</a>

    <a href="{{ route('subscriptions.index') }}">Subscriptions</a>

</div>


<!-- MAIN CONTENT -->

<div class="main">

    <h1>APPOINTMENTS</h1>

    <p class="subtitle">
        Manage trainer appointments and member bookings.
    </p>


    <!-- SUCCESS -->

    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    <!-- ERRORS -->

    @if($errors->any())

        <div class="error-box">

            @foreach($errors->all() as $error)

                <p>{{ $error }}</p>

            @endforeach

        </div>

    @endif


    <!-- BOOK APPOINTMENT -->

    <div class="card">

        <h2>+ Book New Appointment</h2>

        <form action="{{ route('appointments.store') }}" method="POST">

            @csrf

            <div class="form-grid">

                <select name="member_id" required>

                    <option value="">Select Member</option>

                    @foreach($members as $member)

                        <option value="{{ $member->id }}">
                            {{ $member->name }}
                        </option>

                    @endforeach

                </select>


                <select name="trainer_id" required>

                    <option value="">Select Trainer</option>

                    @foreach($trainers as $trainer)

                        <option value="{{ $trainer->id }}">
                            {{ $trainer->name }}
                        </option>

                    @endforeach

                </select>


                <input
                    type="date"
                    name="appointment_date"
                    min="{{ date('Y-m-d') }}"
                    required
                >


                <input
                    type="time"
                    name="appointment_time"
                    required
                >


                <input
                    type="text"
                    name="purpose"
                    placeholder="Appointment Purpose"
                    required
                >


                <select name="status" required>

                    <option value="Pending">Pending</option>

                    <option value="Confirmed">Confirmed</option>

                    <option value="Completed">Completed</option>

                    <option value="Cancelled">Cancelled</option>

                </select>

            </div>

            <button type="submit">
                Book Appointment
            </button>

        </form>

    </div>


    <!-- SEARCH -->

    <div class="card">

        <h2>Search Appointments</h2>

        <form action="{{ route('appointments.index') }}" method="GET">

            <div class="search-box">

                <input
                    type="text"
                    name="search"
                    placeholder="Search member, trainer or purpose..."
                    value="{{ request('search') }}"
                >

                <select name="status">

                    <option value="">All Status</option>

                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>
                        Confirmed
                    </option>

                    <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>
                        Completed
                    </option>

                    <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>
                        Cancelled
                    </option>

                </select>

                <button type="submit">Search</button>

                <a href="{{ route('appointments.index') }}"
                   style="background:#444;color:white;padding:12px;border-radius:6px;text-decoration:none;">
                    Reset
                </a>

            </div>

        </form>

    </div>


    <!-- APPOINTMENTS TABLE -->

    <div class="card">

        <h2>All Appointments</h2>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Member</th>
                        <th>Trainer</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Actions</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($appointments as $appointment)

                        <tr>

                            <td>{{ $appointment->id }}</td>

                            <td>{{ $appointment->member->name }}</td>

                            <td>{{ $appointment->trainer->name }}</td>

                            <td>{{ $appointment->appointment_date }}</td>

                            <td>{{ $appointment->appointment_time }}</td>

                            <td>{{ $appointment->purpose }}</td>

                            <td>

                                <span class="status {{ $appointment->status }}">
                                    {{ $appointment->status }}
                                </span>

                            </td>

                            <td>

                                <div class="actions">

                                    <button
                                        type="button"
                                        class="edit-btn"
                                        onclick="toggleEdit({{ $appointment->id }})"
                                    >
                                        Edit
                                    </button>


                                    <form
                                        action="{{ route('appointments.destroy', $appointment->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this appointment?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit" class="delete-btn">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                        <!-- EDIT FORM -->

                        <tr
                            id="edit-{{ $appointment->id }}"
                            class="edit-form"
                        >

                            <td colspan="8">

                                <h3>Edit Appointment</h3>

                                <form
                                    action="{{ route('appointments.update', $appointment->id) }}"
                                    method="POST"
                                >

                                    @csrf

                                    @method('PUT')

                                    <div class="form-grid">


                                        <select name="member_id" required>

                                            @foreach($members as $member)

                                                <option
                                                    value="{{ $member->id }}"
                                                    {{ $appointment->member_id == $member->id ? 'selected' : '' }}
                                                >
                                                    {{ $member->name }}
                                                </option>

                                            @endforeach

                                        </select>


                                        <select name="trainer_id" required>

                                            @foreach($trainers as $trainer)

                                                <option
                                                    value="{{ $trainer->id }}"
                                                    {{ $appointment->trainer_id == $trainer->id ? 'selected' : '' }}
                                                >
                                                    {{ $trainer->name }}
                                                </option>

                                            @endforeach

                                        </select>


                                        <input
                                            type="date"
                                            name="appointment_date"
                                            value="{{ $appointment->appointment_date }}"
                                            required
                                        >


                                        <input
                                            type="time"
                                            name="appointment_time"
                                            value="{{ substr($appointment->appointment_time, 0, 5) }}"
                                            required
                                        >


                                        <input
                                            type="text"
                                            name="purpose"
                                            value="{{ $appointment->purpose }}"
                                            required
                                        >


                                        <select name="status" required>

                                            <option value="Pending" {{ $appointment->status == 'Pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option value="Confirmed" {{ $appointment->status == 'Confirmed' ? 'selected' : '' }}>
                                                Confirmed
                                            </option>

                                            <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>

                                            <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>

                                        </select>

                                    </div>

                                    <button type="submit">
                                        Update Appointment
                                    </button>

                                </form>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="8" style="text-align:center;">
                                No appointments found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- JAVASCRIPT -->

<script>

function toggleEdit(id) {

    let form = document.getElementById('edit-' + id);

    if (form.style.display === 'table-row') {

        form.style.display = 'none';

    } else {

        form.style.display = 'table-row';

    }

}

</script>

</body>

</html>