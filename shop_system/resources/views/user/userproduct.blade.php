<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management - Shop System</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <style>
        .role-badge {
            padding: 5px 15px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .role-admin {
            background: linear-gradient(135deg, #ffd700, #ffa500);
            color: #000;
            border: 1px solid #b8860b;
        }
        .role-user {
            background: #e2e8f0;
            color: #475569;
            border: 1px solid #cbd5e1;
        }
        .btn-cancel {
            display: inline-block;
            padding: 12px 25px;
            background: #94a3b8;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-left: 10px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-cancel:hover { background: #64748b; }
        .avatar-circle {
            width: 35px;
            height: 35px;
            background: #cbd5e1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }
        .user-stats {
            display: flex;
            gap: 20px;
            margin: 20px 0;
            padding: 20px;
            background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 100%);
            border-radius: 12px;
            border: 1px solid #d0e3ff;
        }
        .stat-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .stat-icon {
            font-size: 24px;
        }
        .stat-label {
            color: #64748b;
            font-size: 13px;
        }
        .stat-value {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }
    </style>
</head>
<body>
    @include('components.header')

    <div class="container">
        @if(session('success'))
            <div class="alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="product-card">
            <h2>{{ isset($user) ? '✏️ Edit User Details' : '👤 Add New User' }}</h2>
            
            <form action="{{ isset($user) ? route('user.update', $user->_id) : route('user.store') }}" method="POST">
                @csrf
                @if(isset($user)) @method('PUT') @endif
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">👤 Full Name</label>
                        <input type="text" id="name" name="name" value="{{ $user->name ?? '' }}" placeholder="Enter name..." required>
                    </div>
                    <div class="form-group">
                        <label for="email">📧 Email Address</label>
                        <input type="email" id="email" name="email" value="{{ $user->email ?? '' }}" placeholder="example@mail.com" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">🔒 Password</label>
                        <input type="password" id="password" name="password" 
                               placeholder="{{ isset($user) ? 'Leave blank to keep current' : 'Enter strong password' }}" 
                               {{ isset($user) ? '' : 'required' }}>
                    </div>
                    <div class="form-group">
                        <label for="role">⭐ System Role</label>
                        <select id="role" name="role" required>
                            <option value="user" {{ (isset($user) && $user->role == 'user') ? 'selected' : '' }}>👤 User</option>
                            <option value="admin" {{ (isset($user) && $user->role == 'admin') ? 'selected' : '' }}>👑 Admin</option>
                        </select>
                    </div>
                </div>
                
                <div style="margin-top: 20px;">
                    <button type="submit" class="btn-add">
                        {{ isset($user) ? 'Update User Profile' : 'Confirm Registration' }}
                    </button>
                    @if(isset($user))
                        <a href="{{ route('user.index') }}" class="btn-cancel">Cancel</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="table-card">
            <h3>📋 All Registered Users</h3>
            
            @php
                $totalUsers = $users->count();
                $adminCount = $users->where('role', 'admin')->count();
                $userCount = $users->where('role', 'user')->count();
            @endphp
            <div class="user-stats">
                <div class="stat-item">
                    <span class="stat-icon">👥</span>
                    <span class="stat-label">Total Users</span>
                    <span class="stat-value">{{ $totalUsers }}</span>
                </div>
                <div class="stat-item">
                    <span class="stat-icon">👑</span>
                    <span class="stat-label">Admins</span>
                    <span class="stat-value">{{ $adminCount }}</span>
                </div>
                <div class="stat-item">
                    <span class="stat-icon">👤</span>
                    <span class="stat-label">Users</span>
                    <span class="stat-value">{{ $userCount }}</span>
                </div>
            </div>
            
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>User Profile</th>
                            <th>Email Address</th>
                            <th>System Role</th>
                            <th style="width: 150px; text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $usr)
                            <tr>
                                <td style="font-weight: bold;">
                                    {{ $usr->role == 'admin' ? '👑' : '👤' }} {{ $usr->name }}
                                </td>
                                <td style="color: #64748b;">{{ $usr->email }}</td>
                                <td>
                                    @if($usr->role == 'admin')
                                        <span class="role-badge role-admin">Admin</span>
                                    @else
                                        <span class="role-badge role-user">User</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('user.edit', $usr->_id) }}" class="btn-action btn-edit" title="Edit">✏️</a>
                                    
                                    @if($usr->email != 'admin@gmail.com')
                                        <a href="{{ route('user.delete', $usr->_id) }}" 
                                           class="btn-action btn-delete" 
                                           onclick="return confirm('ลบผู้ใช้นี้ออกจากระบบใช่หรือไม่?')" 
                                           title="Delete">🗑️</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row">
                                <td colspan="4" style="text-align: center; padding: 50px;">
                                    <div class="empty-state">
                                        <span style="font-size: 40px;">👥</span>
                                        <p>No users found in database</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
