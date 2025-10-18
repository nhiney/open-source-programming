<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>User detail</title></head>
<body>
    <h2>User: {{ $user->name }}</h2>
    <p>Email: {{ $user->email }}</p>

    @if($user->profile)
        <h3>Profile</h3>
        <p>Address: {{ $user->profile->address }}</p>
        <p>Phone: {{ $user->profile->phone }}</p>
        <p>Birthday: {{ $user->profile->birthday }}</p>
        <p>Bio: {{ $user->profile->bio }}</p>
    @else
        <p>User chưa có profile.</p>
    @endif
</body>
</html>
