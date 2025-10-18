<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <h2 class="mb-4 text-center">Danh sách sinh viên và các môn học đã đăng ký</h2>

    <table class="table table-bordered table-hover">
        <tr class="table-success">
            <th>STT</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Môn học</th>
        </tr>
        @foreach($students as $s)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $s->name }}</td>
            <td>{{ $s->email }}</td>
            <td>
                @foreach($s->courses as $c)
                    <span class="badge text-bg-info">{{ $c->title }}</span>
                @endforeach
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
