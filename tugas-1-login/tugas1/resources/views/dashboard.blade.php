<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body style="font-family: sans-serif; padding: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ccc; padding-bottom: 1rem;">
        <h2>Dashboard</h2>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">[ Logout ]</button>
        </form>
    </div>

    <div style="margin-top: 1.5rem;">
        <p>Selamat datang, {{ auth()->user()->nama_lengkap }}!</p>
        <p>Halaman ini hanya bisa dibuka setelah login.</p>
        <p>Username: {{ auth()->user()->username }}</p>
    </div>
    <hr>
    <h3>Informasi Akun Saat Ini</h3>
    <p>Role Anda: <strong>{{ auth()->user()->role }}</strong></p>

    @if (session('status'))
        <p style="color: green; font-weight: bold;">{{ session('status') }}</p>
    @endif

    @error('role')
        <p style="color: red; font-weight: bold;">Error: {{ $message }}</p>
    @enderror

    @can('manage-roles')
        <h3>Manajemen Role Pengguna (Khusus Admin)</h3>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Role Saat Ini</th>
                    <th>Ubah Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $u)
                    <tr>
                        <td>{{ $u->getKey() }}</td>
                        <td>{{ $u->username }}</td>
                        <td>{{ $u->nama_lengkap }}</td>
                        <td><strong>{{ $u->role }}</strong></td>
                        <td>
                            <form action="{{ route('admin.users.role.update', $u) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="role">
                                    <option value="customer" @selected($u->role === 'customer')>customer</option>
                                    <option value="staff" @selected($u->role === 'staff')>staff</option>
                                </select>
                                <button type="submit">Update Role</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endcan
</body>
</html>