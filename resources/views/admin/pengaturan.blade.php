<x-layoutAdmin title="Pengaturan Admin">
    <!-- PAGE CONTENT -->
    <main class="main">
        <h2>Pengaturan Admin</h2>

        <!-- DATA AKUN ADMIN -->
        <div class="setting-section">
            <h3>Data Akun</h3>
            <table class="setting-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->address }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </main>
</x-layoutAdmin>
