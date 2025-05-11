<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Principals | TLMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-300 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">

        {{-- Sidebar --}}
        <div class="w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-6 m-4 rounded-xl shadow-lg flex flex-col items-center">
            <img src="{{ asset('/storage/photos/school.png') }}" class="w-24 h-24 rounded-full border-4 border-white shadow-md mb-4" alt="School Logo" />
            <ul class="space-y-4 w-full">
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/schoolDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-8 h-8 mr-2" alt="Dashboard" /> Dashboard
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerPrincipal') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/boss.png') }}" class="w-8 h-8 mr-2" alt="Assign Principal" /> Assign Principal
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerClerk') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-8 h-8 mr-2" alt="Assign Clerk" /> Assign Clerk
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerTeacher') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/classroom.png') }}" class="w-8 h-8 mr-2" alt="Assign Teacher" /> Assign Teacher
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerSectionhead') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/teachernew.png') }}" class="w-8 h-8 mr-2" alt="Assign Section" /> Assign Sectional Head
                    </a>
                </li>
                <li class="mt-12 w-48 py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/logout.png') }}" class="w-8 h-8 mr-2" alt="Logout" /> Logout
                    </a>
                </li>
            </ul>
        </div>

        {{-- Main Content --}}
        <div class="w-3/4 p-8 overflow-y-auto">
            <a href="{{ url('/manageUsers') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded shadow mb-4">
                < Back
                    </a>

                    <h2 class="text-2xl font-bold mb-6 text-center">Manage Principals</h2>

                    @if (session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    <table class="min-w-full bg-white border rounded shadow">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="py-2 px-4 border">Name</th>
                                <th class="py-2 px-4 border">Email</th>
                                <th class="py-2 px-4 border">Status</th>
                                <th class="py-2 px-4 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($principals as $principal)
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border">{{ $principal->first_name }} {{ $principal->last_name }}</td>
                                <td class="py-2 px-4 border">{{ $principal->user_email }}</td>
                                <td class="py-2 px-4 border">{{ ucfirst($principal->status) }}</td>
                                <td class="py-2 px-4 border space-x-1">
                                    <a href="{{ route('principals.edit', $principal->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded mr-1">Edit</a>

                                    <form action="{{ route('principals.updateStatus', ['id' => $principal->id, 'status' => 'INACTIVE']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-1 px-3 rounded mr-1">Deactivate</button>
                                    </form>

                                    <form action="{{ route('principals.updateStatus', ['id' => $principal->id, 'status' => 'TRANSFERRED']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-1 px-3 rounded mr-1">Transferred</button>
                                    </form>

                                    <form action="{{ route('principals.updateStatus', ['id' => $principal->id, 'status' => 'RETIRED']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded mr-1">Retired</button>
                                    </form>

                                    @if ($principal->status !== 'ACTIVE')
                                    <form action="{{ route('principals.reactivate', $principal->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded">Reactivate</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No principals found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
        </div>
    </div>
</body>

</html>