<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FitZone - Memberships</title>

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
            color: white;
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
            transition: 0.3s;
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
            font-size: 30px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #999;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        button {
            border: none;
            padding: 12px 18px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .add-btn,
        .save-btn,
        .edit-btn {
            background: #a8ff00;
            color: black;
        }

        .add-btn:hover,
        .save-btn:hover,
        .edit-btn:hover {
            background: #8bd600;
        }

        /* Messages */

        .success {
            background: #193b13;
            color: #a8ff00;
            padding: 15px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .error {
            background: #491919;
            color: #ffaaaa;
            padding: 15px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        /* Membership Cards */

        .plans {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .card {
            background: #171717;
            border: 1px solid #292929;
            border-radius: 10px;
            padding: 22px;
        }

        .card h3 {
            font-size: 21px;
            margin-bottom: 15px;
        }

        .price {
            color: #a8ff00;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .duration {
            color: #999;
            margin-bottom: 20px;
        }

        .delete-btn {
            background: #e53935;
            color: white;
        }

        /* Forms */

        .form-card {
            display: none;
            background: #171717;
            border: 1px solid #333;
            border-radius: 10px;
            padding: 25px;
            max-width: 500px;
            margin-bottom: 30px;
        }

        .form-card h2 {
            margin-bottom: 20px;
            color: #a8ff00;
        }

        label {
            display: block;
            margin: 12px 0 8px;
        }

        input {
            width: 100%;
            padding: 12px;
            background: #252525;
            color: white;
            border: 1px solid #444;
            border-radius: 6px;
        }

        input:focus {
            outline: none;
            border-color: #a8ff00;
        }

        .cancel-btn {
            background: #444;
            color: white;
            margin-top: 15px;
        }

        .edit-form {
            display: none;
            margin-top: 20px;
            border-top: 1px solid #444;
            padding-top: 20px;
        }

        .edit-form button {
            margin-top: 15px;
        }

        /* Subscriptions */

        .section {
            margin-top: 40px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 550px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #333;
        }

        th {
            color: #a8ff00;
        }

        .status {
            color: #a8ff00;
        }

        /* Responsive */

        @media(max-width: 1100px) {
            .plans {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 650px) {

            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .main {
                padding: 20px;
            }

            .plans {
                grid-template-columns: 1fr;
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

        <a href="{{ route('members.index') }}">Members</a>

        <a href="#" class="active">Memberships</a>

        <a href="#">Trainers</a>

        <a href="#">Workouts</a>

        <a href="#">Attendance</a>

         <a href="{{ route('appointments.index') }}" >
        Appointments
    </a>

        <a href="#">Payments</a>

        <a href="#">Products</a>

        <a href="#">Orders</a>

        <a href="{{ route('reports.index') }}">Reports</a>

        <a href="#">Settings</a>

    </aside>


    <!-- Main Content -->

    <main class="main">

        <div class="header">

            <h1>MEMBERSHIP PLANS</h1>

            <p class="subtitle">
                Manage membership plans and subscriptions
            </p>

        </div>


        <!-- Success Message -->

        @if(session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif


        <!-- Error Message -->

        @if($errors->any())

            <div class="error">

                @foreach($errors->all() as $error)

                    <p>{{ $error }}</p>

                @endforeach

            </div>

        @endif


        <!-- Available Plans -->

        <div class="section-header">

            <h2>Available Plans</h2>

            <button class="add-btn" onclick="showAddForm()">
                + Add Plan
            </button>

        </div>


        <!-- Add Plan Form -->

        <div class="form-card" id="addForm">

            <h2>Add New Membership Plan</h2>

            <form action="{{ route('memberships.store') }}" method="POST">

                @csrf

                <label>Plan Name</label>

                <input
                    type="text"
                    name="name"
                    placeholder="Enter plan name"
                    value="{{ old('name') }}"
                    required
                >

                <label>Price (Rs.)</label>

                <input
                    type="number"
                    name="price"
                    placeholder="Enter price"
                    min="1"
                    step="0.01"
                    value="{{ old('price') }}"
                    required
                >

                <label>Duration</label>

                <input
                    type="text"
                    name="duration"
                    placeholder="Example: 1 Month"
                    value="{{ old('duration') }}"
                    required
                >

                <button type="submit" class="save-btn">
                    Save Plan
                </button>

                <button
                    type="button"
                    class="cancel-btn"
                    onclick="hideAddForm()"
                >
                    Cancel
                </button>

            </form>

        </div>


        <!-- Plans Display -->

        <div class="plans">

            @forelse($memberships as $membership)

                <div class="card">

                    <h3>{{ $membership->name }}</h3>

                    <p class="price">
                        Rs. {{ number_format($membership->price, 2) }}
                    </p>

                    <p class="duration">
                        Duration: {{ $membership->duration }}
                    </p>


                    <!-- Edit Button -->

                    <button
                        class="edit-btn"
                        onclick="toggleEdit({{ $membership->id }})"
                    >
                        Edit
                    </button>


                    <!-- Delete Button -->

                    <form
                        action="{{ route('memberships.destroy', $membership->id) }}"
                        method="POST"
                        style="display:inline;"
                        onsubmit="return confirm('Are you sure you want to delete this plan?')"
                    >

                        @csrf

                        @method('DELETE')

                        <button type="submit" class="delete-btn">
                            Delete
                        </button>

                    </form>


                    <!-- Edit Form -->

                    <div
                        class="edit-form"
                        id="editForm{{ $membership->id }}"
                    >

                        <h3>Edit Membership</h3>

                        <form
                            action="{{ route('memberships.update', $membership->id) }}"
                            method="POST"
                        >

                            @csrf

                            @method('PUT')

                            <label>Plan Name</label>

                            <input
                                type="text"
                                name="name"
                                value="{{ $membership->name }}"
                                required
                            >

                            <label>Price</label>

                            <input
                                type="number"
                                name="price"
                                value="{{ $membership->price }}"
                                min="1"
                                step="0.01"
                                required
                            >

                            <label>Duration</label>

                            <input
                                type="text"
                                name="duration"
                                value="{{ $membership->duration }}"
                                required
                            >

                            <button type="submit" class="save-btn">
                                Update Plan
                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="card">
                    No membership plans available.
                </div>

            @endforelse

        </div>


        <!-- Member Subscriptions -->

        <div class="section">

            <div class="section-header">

                <h2>Member Subscriptions</h2>

            </div>

            <div class="card table-wrap">

                <table>

                    <thead>

                        <tr>
                            <th>Member Name</th>
                            <th>Membership</th>
                            <th>Start Date</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td colspan="5">
                                Member subscriptions will appear here.
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>


<!-- JavaScript -->

<script>

    function showAddForm() {

        document.getElementById('addForm').style.display = 'block';

    }


    function hideAddForm() {

        document.getElementById('addForm').style.display = 'none';

    }


    function toggleEdit(id) {

        let form = document.getElementById('editForm' + id);

        if (form.style.display === 'block') {

            form.style.display = 'none';

        } else {

            form.style.display = 'block';

        }

    }


    @if($errors->any())

        showAddForm();

    @endif

</script>

</body>

</html>