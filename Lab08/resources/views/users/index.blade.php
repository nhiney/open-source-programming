<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Danh sách users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
    <h2>Danh sách Users</h2>
    <table class="table table-bordered">
        <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Address</th><th>Phone</th></tr></thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $loop->iteration + ($users->currentPage()-1)*$users->perPage() }}</td>
                <td><a href="{{ url('/users/'.$user->id) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ optional($user->profile)->address ?? '—' }}</td>
                <td>{{ optional($user->profile)->phone ?? '—' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
</body>
</html>
