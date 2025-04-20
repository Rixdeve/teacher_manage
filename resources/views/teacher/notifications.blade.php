<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Notifications</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($notifications->isEmpty())
            <p class="text-gray-600">No notifications found.</p>
        @else
            <ul class="space-y-4">
                @foreach ($notifications as $notification)
                    <li class="bg-white p-4 rounded shadow {{ $notification->read ? 'opacity-75' : 'font-bold' }}">
                        <h3 class="text-lg">{{ $notification->title }}</h3>
                        <p>{{ $notification->message }}</p>
                        <p class="text-sm text-gray-500">{{ $notification->created_at->format('d M Y, H:i') }}</p>
                        @if (!$notification->read)
                            <form action="{{ route('notifications.mark_as_read', $notification->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-blue-500 hover:underline text-sm">Mark as Read</button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>