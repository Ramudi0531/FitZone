<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FITZONE - Gym Management System</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    body {
      background-color: #0d1117;
      color: #ffffff;
      display: flex;
      height: 100vh;
      overflow: hidden;
    }
    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color: #121820;
      display: flex;
      flex-direction: column;
      padding: 20px;
      border-right: 1px solid #222b35;
    }
    .brand {
      font-size: 24px;
      font-weight: bold;
      color: #a3e635;
      margin-bottom: 30px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .nav-links {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 8px;
      flex: 1;
      overflow-y: auto;
    }
    .nav-item {
      padding: 12px 16px;
      border-radius: 8px;
      color: #94a3b8;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 14px;
      transition: all 0.2s;
    }
    .nav-item:hover, .nav-item.active {
      background-color: #a3e635;
      color: #000000;
      font-weight: bold;
    }
    /* Main Content */
    .main-content {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow-y: auto;
    }
    .topbar {
      height: 60px;
      background-color: #121820;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 30px;
      border-bottom: 1px solid #222b35;
    }
    .search-box {
      background-color: #1e2630;
      border: 1px solid #334155;
      padding: 8px 16px;
      border-radius: 20px;
      color: #fff;
      width: 300px;
    }
    .user-profile {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .content-area {
      padding: 25px;
    }
    /* Cards & Grid */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 15px;
      margin-bottom: 25px;
    }
    .stat-card {
      background-color: #161e27;
      padding: 20px;
      border-radius: 12px;
      border: 1px solid #222b35;
    }
    .stat-title {
      color: #94a3b8;
      font-size: 13px;
      margin-bottom: 8px;
    }
    .stat-value {
      font-size: 24px;
      font-weight: bold;
      color: #ffffff;
    }
    .stat-badge {
      color: #a3e635;
      font-size: 12px;
      margin-top: 5px;
    }
    /* Table */
    .data-card {
      background-color: #161e27;
      border-radius: 12px;
      padding: 20px;
      border: 1px solid #222b35;
      margin-bottom: 25px;
    }
    .card-title {
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 15px;
      color: #a3e635;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
      font-size: 14px;
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #222b35;
    }
    th {
      color: #94a3b8;
    }
    .status-badge {
      background-color: rgba(163, 230, 53, 0.2);
      color: #a3e635;
      padding: 4px 10px;
      border-radius: 12px;
      font-size: 12px;
    }
    /* Page Views */
    .page {
      display: none;
    }
    .page.active {
      display: block;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="brand">🏋️ FITZONE</div>
    <ul class="nav-links">
      <li class="nav-item active" onclick="showPage('dashboard', this)">Dashboard</li>
      <li class="nav-item" onclick="showPage('members', this)">Members</li>
      <li class="nav-item" onclick="showPage('memberships', this)">Memberships</li>
      <li class="nav-item" onclick="showPage('trainers', this)">Trainers</li>
      <li class="nav-item" onclick="showPage('workout', this)">Workout Plans</li>
      <li class="nav-item" onclick="showPage('attendance', this)">Attendance</li>
      <li class="nav-item" onclick="showPage('appointments', this)">Appointments</li>
      <li class="nav-item" onclick="showPage('payments', this)">Payments</li>
      <li class="nav-item" onclick="showPage('reports', this)">Reports</li>
      <li class="nav-item" onclick="showPage('messages', this)">Messages</li>
      <li class="nav-item" onclick="showPage('settings', this)">Settings</li>
    </ul>
  </div>

  <!-- Main Area -->
  <div class="main-content">
    <div class="topbar">
      <input type="text" class="search-box" placeholder="Search member, trainer...">
      <div class="user-profile">
        <span>Admin</span>
      </div>
    </div>

    <div class="content-area">
      <!-- DASHBOARD PAGE -->
      <div id="dashboard" class="page active">
        <h2 style="margin-bottom: 20px;">Welcome Back, Admin 👋</h2>
        
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-title">Total Members</div>
            <div class="stat-value">420</div>
            <div class="stat-badge">↑ +12%</div>
          </div>
          <div class="stat-card">
            <div class="stat-title">Total Trainers</div>
            <div class="stat-value">12</div>
            <div class="stat-badge">↑ +0%</div>
          </div>
          <div class="stat-card">
            <div class="stat-title">Active Memberships</div>
            <div class="stat-value">365</div>
            <div class="stat-badge">↑ +8%</div>
          </div>
          <div class="stat-card">
            <div class="stat-title">Today's Attendance</div>
            <div class="stat-value">87</div>
            <div class="stat-badge">↑ +15%</div>
          </div>
          <div class="stat-card">
            <div class="stat-title">Monthly Revenue</div>
            <div class="stat-value">Rs. 845,000</div>
            <div class="stat-badge">↑ +18%</div>
          </div>
        </div>

        <div class="data-card">
          <div class="card-title">Recent Members</div>
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>Membership</th>
                <th>Join Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Kasun Perera</td>
                <td>077 123 4567</td>
                <td>Monthly</td>
                <td>2026-09-01</td>
                <td><span class="status-badge">Active</span></td>
              </tr>
              <tr>
                <td>Nimali Silva</td>
                <td>071 987 6543</td>
                <td>3 Months</td>
                <td>2026-08-28</td>
                <td><span class="status-badge">Active</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- MEMBERS PAGE -->
      <div id="members" class="page">
        <h2>Members Management</h2>
        <p style="color: #94a3b8; margin-top: 10px;">View and manage gym members list.</p>
      </div>

      <!-- MEMBERSHIPS PAGE -->
      <div id="memberships" class="page">
        <h2>Membership Plans</h2>
        <p style="color: #94a3b8; margin-top: 10px;">Monthly, 3 Months, 6 Months, Yearly Plans.</p>
      </div>

      <!-- TRAINERS PAGE -->
      <div id="trainers" class="page">
        <h2>Trainers Directory</h2>
        <p style="color: #94a3b8; margin-top: 10px;">Manage gym trainers profiles.</p>
      </div>

      <!-- WORKOUT PLANS PAGE -->
      <div id="workout" class="page">
        <h2>Workout Plans</h2>
        <p style="color: #94a3b8; margin-top: 10px;">Create and assign workout schedules.</p>
      </div>

      <!-- OTHER PAGES -->
      <div id="attendance" class="page"><h2>Attendance Log</h2></div>
      <div id="appointments" class="page"><h2>Appointments</h2></div>
      <div id="payments" class="page"><h2>Payments & Invoices</h2></div>
      <div id="reports" class="page"><h2>Reports & Analytics</h2></div>
      <div id="messages" class="page"><h2>Messages & Notifications</h2></div>
      <div id="settings" class="page"><h2>Settings</h2></div>

    </div>
  </div>

  <script>
    function showPage(pageId, element) {
      // Hide all pages
      document.querySelectorAll('.page').forEach(page => {
        page.classList.remove('active');
      });
      // Deactivate all nav items
      document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
      });
      // Show selected page
      document.getElementById(pageId).classList.add('active');
      // Highlight selected nav item
      element.classList.add('active');
    }
  </script>
</body>
</html>