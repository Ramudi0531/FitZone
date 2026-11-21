<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FitZone - Subscriptions</title>

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

.container {
    display: flex;
    min-height: 100vh;
}

/* Sidebar */

.sidebar {
    width: 230px;
    background: #11130e;
    padding: 25px 18px;
    flex-shrink: 0;
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
}

.sidebar a:hover,
.sidebar a.active {
    background: #a8ff00;
    color: black;
}

/* Main */

.main {
    flex: 1;
    padding: 35px;
    min-width: 0;
}

.header {
    margin-bottom: 30px;
}

.header h1 {
    font-size: 28px;
    margin-bottom: 10px;
}

.subtitle {
    color: #999;
}

/* Cards */

.card {
    background: #171717;
    padding: 25px;
    border-radius: 10px;
    border: 1px solid #292929;
    margin-bottom: 25px;
}

h2 {
    margin-bottom: 20px;
}

/* Forms */

label {
    display: block;
    margin: 15px 0 8px;
}

input, select {
    width: 100%;
    padding: 12px;
    background: #252525;
    color: white;
    border: 1px solid #444;
    border-radius: 6px;
}

input:focus, select:focus {
    outline: none;
    border-color: #a8ff00;
}

button {
    padding: 12px 18px;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    margin-top: 15px;
}

.save-btn, .search-btn {
    background: #a8ff00;
    color: black;
}

.edit-btn {
    background: #a8ff00;
    color: black;
    margin-right: 5px;
}

.delete-btn {
    background: #e53935;
    color: white;
}

.cancel-btn {
    background: #444;
    color: white;
}

/* Messages */

.success {
    background: #193b13;
    color: #a8ff00;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 6px;
}

.error {
    background: #491919;
    color: #ffaaaa;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 6px;
}

/* Search */

.search-form {
    display: flex;
    gap: 12px;
    align-items: end;
}

.search-group {
    flex: 1;
}

.search-group label {
    margin-top: 0;
}

.search-btn {
    height: 42px;
}

.reset-btn {
    background: #444;
    color: white;
    text-decoration: none;
    padding: 13px 18px;
    border-radius: 6px;
    display: inline-block;
}

/* Table */

.table-wrap {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 750px;
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #333;
}

th {
    color: #a8ff00;
}

.active-status {
    color: #a8ff00;
    font-weight: bold;
}

.expired-status {
    color: #ff5555;
    font-weight: bold;
}

/* Edit Form */

.edit-form {
    display: none;
    background: #222;
    padding: 20px;
    margin-top: 15px;
    border-radius: 8px;
}

@media(max-width: 750px) {

    .container {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
    }

    .main {
        padding: 18px;
    }

    .search-form {
        flex-direction: column;
        align-items: stretch;
    }

}

</style>

</head>

<body>

<div class="container">

<!-- Sidebar -->

<aside class="sidebar">

    <div class="logo">Fit<span>Zone</span></div>

    <a href="#">Dashboard</a>
    <a href="#">Members</a>
    <a href="{{ route('memberships.index') }}">Memberships</a>
    <a href="#">Trainers</a>
    <a href="#">Workouts</a>
    <a href="#">Attendance</a>
    <a href="#">Appointments</a>
    <a href="#">Payments</a>
    <a href="#">Products</a>
    <a href="#">Orders</a>
   <a href="{{ route('reports.index') }}">Reports</a>
    <a href="#">Settings</a>
    <a href="{{ route('subscriptions.index') }}" class="active">
        Subscriptions
    </a>

</aside>


<!-- Main Content -->

<main class="main">

    <div class="header">

        <h1>MEMBER SUBSCRIPTIONS</h1>

        <p class="subtitle">
            Manage member subscriptions and membership details
        </p>

    </div>


    <!-- Success Message -->

    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    <!-- Error Messages -->

    @if($errors->any())

        <div class="error">

            @foreach($errors->all() as $error)

                <p>{{ $error }}</p>

            @endforeach

        </div>

    @endif


    <!-- Add Subscription -->

    <div class="card">

        <h2>Add New Subscription</h2>

        <form action="{{ route('subscriptions.store') }}" method="POST">

            @csrf

            <label>Member Name</label>

            <input
                type="text"
                name="member_name"
                value="{{ old('member_name') }}"
                placeholder="Enter member name"
                required
            >

            <label>Membership Plan</label>

            <select name="membership_id" required>

                <option value="">Select Membership</option>

                @foreach($memberships as $membership)

                    <option value="{{ $membership->id }}"
                        {{ old('membership_id') == $membership->id ? 'selected' : '' }}>

                        {{ $membership->name }} - Rs. {{ $membership->price }}

                    </option>

                @endforeach

            </select>

            <label>Start Date</label>

            <input
                type="date"
                name="start_date"
                value="{{ old('start_date') }}"
                required
            >

            <label>Expiry Date</label>

            <input
                type="date"
                name="expiry_date"
                value="{{ old('expiry_date') }}"
                required
            >

            <button type="submit" class="save-btn">
                Save Subscription
            </button>

        </form>

    </div>


    <!-- Search and Filter -->

    <div class="card">

        <h2>Search Subscriptions</h2>

        <form action="{{ route('subscriptions.index') }}"
              method="GET"
              class="search-form">

            <div class="search-group">

                <label>Search Member</label>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Enter member name"
                >

            </div>

            <div class="search-group">

                <label>Membership Plan</label>

                <select name="membership_id">

                    <option value="">All Plans</option>

                    @foreach($memberships as $membership)

                        <option value="{{ $membership->id }}"
                            {{ request('membership_id') == $membership->id ? 'selected' : '' }}>

                            {{ $membership->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <button type="submit" class="search-btn">
                Search
            </button>

            <a href="{{ route('subscriptions.index') }}" class="reset-btn">
                Reset
            </a>

        </form>

    </div>


    <!-- Subscription List -->

    <div class="card">

        <h2>All Subscriptions</h2>

        <div class="table-wrap">

            <table>

                <thead>

                    <tr>
                        <th>Member Name</th>
                        <th>Membership Plan</th>
                        <th>Start Date</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($subscriptions as $subscription)

                        <tr>

                            <td>{{ $subscription->member_name }}</td>

                            <td>
                                {{ $subscription->membership->name ?? 'N/A' }}
                            </td>

                            <td>{{ $subscription->start_date }}</td>

                            <td>{{ $subscription->expiry_date }}</td>

                            <td>

                                @if($subscription->status == 'Active')

                                    <span class="active-status">Active</span>

                                @else

                                    <span class="expired-status">Expired</span>

                                @endif

                            </td>

                            <td>

                                <button
                                    type="button"
                                    class="edit-btn"
                                    onclick="toggleEdit({{ $subscription->id }})">

                                    Edit

                                </button>

                                <form
                                    action="{{ route('subscriptions.destroy', $subscription->id) }}"
                                    method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this subscription?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="delete-btn">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>


                        <!-- Edit Form -->

                        <tr>

                            <td colspan="6">

                                <div
                                    class="edit-form"
                                    id="editForm{{ $subscription->id }}">

                                    <h2>Edit Subscription</h2>

                                    <form
                                        action="{{ route('subscriptions.update', $subscription->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('PUT')

                                        <label>Member Name</label>

                                        <input
                                            type="text"
                                            name="member_name"
                                            value="{{ $subscription->member_name }}"
                                            required
                                        >

                                        <label>Membership Plan</label>

                                        <select name="membership_id" required>

                                            @foreach($memberships as $membership)

                                                <option
                                                    value="{{ $membership->id }}"
                                                    {{ $subscription->membership_id == $membership->id ? 'selected' : '' }}>

                                                    {{ $membership->name }}

                                                </option>

                                            @endforeach

                                        </select>

                                        <label>Start Date</label>

                                        <input
                                            type="date"
                                            name="start_date"
                                            value="{{ $subscription->start_date }}"
                                            required
                                        >

                                        <label>Expiry Date</label>

                                        <input
                                            type="date"
                                            name="expiry_date"
                                            value="{{ $subscription->expiry_date }}"
                                            required
                                        >

                                        <button type="submit" class="save-btn">
                                            Update Subscription
                                        </button>

                                        <button
                                            type="button"
                                            class="cancel-btn"
                                            onclick="toggleEdit({{ $subscription->id }})">

                                            Cancel

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6">
                                No subscriptions available.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</main>

</div>


<!-- JavaScript -->

<script>

function toggleEdit(id) {

    let form = document.getElementById('editForm' + id);

    if (form.style.display === 'block') {

        form.style.display = 'none';

    } else {

        form.style.display = 'block';

    }

}

</script>

</body>
</html>