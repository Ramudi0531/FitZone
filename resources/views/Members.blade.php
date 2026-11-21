<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FitZone - Members</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #0b0b0b;
            color: #ffffff;
        }

        /* SIDEBAR */

        .sidebar {
            width: 230px;
            height: 100vh;
            background: #11130e;
            position: fixed;
            top: 0;
            left: 0;
            padding: 25px 18px;
            overflow-y: auto;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: white;
            margin-bottom: 35px;
        }

        .logo span {
            color: #a8ff00;
        }

        .sidebar a {
            display: block;
            color: #aaa;
            text-decoration: none;
            padding: 13px 15px;
            margin-bottom: 7px;
            border-radius: 7px;
            font-size: 14px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #292929;
            color: #a8ff00;
        }

        .sidebar a.active {
            background: #a8ff00;
            color: #000;
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
            font-size: 20px;
            margin-bottom: 22px;
            color: #a8ff00;
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
            outline: none;
            margin-bottom: 12px;
        }

        input:focus, select:focus {
            border-color: #a8ff00;
        }

        input::placeholder {
            color: #999;
        }

        /* BUTTONS */

        button {
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            background: #a8ff00;
            color: #000;
            transition: 0.3s;
        }

        button:hover {
            background: #8bd600;
        }

        .edit-btn {
            background: #a8ff00;
            color: #000;
        }

        .delete-btn {
            background: #e53935;
            color: white;
        }

        .delete-btn:hover {
            background: #c62828;
        }

        .reset-btn {
            background: #444;
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 6px;
        }

        /* SEARCH */

        .search-box {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .search-box input {
            flex: 1;
            margin-bottom: 0;
        }

        /* TABLE */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        th {
            color: #a8ff00;
            font-size: 14px;
            text-align: left;
            padding: 16px;
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

        .actions {
            display: flex;
            gap: 8px;
        }

        /* EDIT FORM */

        .edit-form {
            display: none;
            background: #202020;
        }

        .edit-form td {
            padding: 20px;
        }

        .edit-form h3 {
            color: #a8ff00;
            margin-bottom: 18px;
        }

        /* SUCCESS AND ERRORS */

        .success {
            background: #193b13;
            color: #a8ff00;
            padding: 14px;
            margin-bottom: 20px;
            border-radius: 7px;
            border: 1px solid #315c20;
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

        <a href="{{ route('members.index') }}" class="active">
            Members
        </a>

        <a href="{{ route('memberships.index') }}">
            Memberships
        </a>

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

        <a href="{{ route('subscriptions.index') }}">
            Subscriptions
        </a>

    </div>


    <!-- MAIN CONTENT -->

    <div class="main">

        <h1>Members Management</h1>

        <p class="subtitle">
            Manage all registered FitZone members.
        </p>


        <!-- SUCCESS MESSAGE -->

        @if(session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif


        <!-- VALIDATION ERRORS -->

        @if($errors->any())

            <div class="error-box">

                @foreach($errors->all() as $error)

                    <p>{{ $error }}</p>

                @endforeach

            </div>

        @endif


        <!-- ADD MEMBER -->

        <div class="card">

            <h2>Add New Member</h2>

            <form action="{{ route('members.store') }}" method="POST">

                @csrf

                <div class="form-grid">

                    <input
                        type="text"
                        name="name"
                        placeholder="Full Name"
                        value="{{ old('name') }}"
                        required
                    >

                    <input
                        type="email"
                        name="email"
                        placeholder="Email Address"
                        value="{{ old('email') }}"
                        required
                    >

                    <input
                        type="text"
                        name="phone"
                        placeholder="Phone Number"
                        value="{{ old('phone') }}"
                        required
                    >

                    <select name="gender" required>

                        <option value="">Select Gender</option>

                        <option value="Male">Male</option>

                        <option value="Female">Female</option>

                        <option value="Other">Other</option>

                    </select>

                    <input
                        type="date"
                        name="date_of_birth"
                        value="{{ old('date_of_birth') }}"
                    >

                    <input
                        type="text"
                        name="address"
                        placeholder="Address"
                        value="{{ old('address') }}"
                    >

                </div>

                <button type="submit">
                    + Add Member
                </button>

            </form>

        </div>


        <!-- SEARCH MEMBERS -->

        <div class="card">

            <h2>Search Members</h2>

            <form
                action="{{ route('members.index') }}"
                method="GET"
                class="search-box"
            >

                <input
                    type="text"
                    name="search"
                    placeholder="Search by name, email or phone..."
                    value="{{ $search ?? '' }}"
                >

                <button type="submit">
                    Search
                </button>

                <a href="{{ route('members.index') }}" class="reset-btn">
                    Reset
                </a>

            </form>

        </div>


        <!-- MEMBERS TABLE -->

        <div class="card">

            <h2>All Members</h2>

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($members as $member)

                            <tr>

                                <td>{{ $member->id }}</td>

                                <td>{{ $member->name }}</td>

                                <td>{{ $member->email }}</td>

                                <td>{{ $member->phone }}</td>

                                <td>{{ $member->gender }}</td>

                                <td>

                                    <div class="actions">

                                        <button
                                            type="button"
                                            class="edit-btn"
                                            onclick="toggleEdit({{ $member->id }})"
                                        >
                                            Edit
                                        </button>

                                        <form
                                            action="{{ route('members.destroy', $member->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this member?')"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="delete-btn"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                            <!-- EDIT MEMBER FORM -->

                            <tr
                                id="edit-{{ $member->id }}"
                                class="edit-form"
                            >

                                <td colspan="6">

                                    <h3>Edit Member Details</h3>

                                    <form
                                        action="{{ route('members.update', $member->id) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('PUT')

                                        <div class="form-grid">

                                            <input
                                                type="text"
                                                name="name"
                                                value="{{ $member->name }}"
                                                required
                                            >

                                            <input
                                                type="email"
                                                name="email"
                                                value="{{ $member->email }}"
                                                required
                                            >

                                            <input
                                                type="text"
                                                name="phone"
                                                value="{{ $member->phone }}"
                                                required
                                            >

                                            <select name="gender" required>

                                                <option value="Male" {{ $member->gender == 'Male' ? 'selected' : '' }}>
                                                    Male
                                                </option>

                                                <option value="Female" {{ $member->gender == 'Female' ? 'selected' : '' }}>
                                                    Female
                                                </option>

                                                <option value="Other" {{ $member->gender == 'Other' ? 'selected' : '' }}>
                                                    Other
                                                </option>

                                            </select>

                                            <input
                                                type="date"
                                                name="date_of_birth"
                                                value="{{ $member->date_of_birth }}"
                                            >

                                            <input
                                                type="text"
                                                name="address"
                                                value="{{ $member->address }}"
                                                placeholder="Address"
                                            >

                                        </div>

                                        <button type="submit">
                                            Update Member
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" style="text-align:center;">
                                    No members found.
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