<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Zonal Dashboard</title>
</head>

<body class="bg-gray-300 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
        <div
            class="w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-6 m-4 rounded-xl shadow-lg flex flex-col items-center">
            <img src="https://cdn-icons-png.flaticon.com/512/6837/6837225.png"
                class="w-24 h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto"
                    onclick="location.href='#'">
                    <img src="https://p7.hiclipart.com/preview/580/425/288/google-analytics-dashboard-business-analytics-computer-icons-business-thumbnail.jpg"
                        class="w-8 h-8 mr-2" alt="Dashboard" />
                    Dashboard
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto"
                    onclick="location.href='#'">
                    <img src="https://www.shutterstock.com/image-vector/audit-logging-monitoring-isometric-illustration-600nw-2054195399.jpg"
                        class="w-8 h-8 mr-2" alt="Audit Log" />
                    Audit Log
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto"
                    onclick="location.href='#'">
                    <img src="https://www.clipartmax.com/png/middle/184-1848296_school-building-icon-school-icon-png.png"
                        class="w-8 h-8 mr-2" alt="Manage Schools" />
                    Manage Schools
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto"
                    onclick="location.href='#'">
                    <img src="https://p7.hiclipart.com/preview/1022/170/393/users-group-computer-icons-clip-art-user-cliparts.jpg"
                        class="w-8 h-8 mr-2" alt="Manage Users" />
                    Manage Users
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto"
                    onclick="location.href='#'">
                    <img src="https://png.pngtree.com/png-vector/20221214/ourmid/pngtree-chat-notification-png-image_6523600.png"
                        class="w-8 h-8 mr-2" alt="Write Notification" />
                    Write Notification
                </li>
                <li class="mt-12 w-48 py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2 mx-auto"
                    onclick="location.href='#'">
                    <img src="https://www.freeiconspng.com/thumbs/sign-out-icon/sign-out-logout-icon-0.png"
                        class="w-8 h-8 mr-2" alt="Logout" />
                    Logout
                </li>
            </ul>
        </div>

        <div class="w-3/4 p-8 relative">
            <div class="absolute top-6 right-6 flex items-center space-x-3">
                <img src="Img/profilePic.jpg" class="h-10 w-10 rounded-full border border-gray-400" />
                <div>
                    <h3 class="font-semibold">#</h3>
                    <h3 class="text-gray-600 text-sm">Zonal Admin</h3>
                </div>
            </div>

            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-lg mt-12 mb-6">
                <p class="text-gray-700">#</p>
                <h1 class="text-2xl font-bold">Welcome back, <span>##</span></h1>
            </div>

            <div class="grid grid-cols-3 gap-6">
                <div class="bg-blue-100 p-6 rounded-lg text-center shadow-md hover:shadow-lg"
                    onclick="window.location.href='registerSchool.html'" style="cursor: pointer">
                    <p class="text-gray-700 font-semibold">Register School:</p>
                    <div class="flex justify-center mt-2">
                        <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/add-a-device-5373030-4489968.png"
                            alt="Icon" class="w-10 h-10" />
                    </div>
                </div>
                <div class="bg-blue-100 p-6 rounded-lg text-center shadow-md hover:shadow-lg"
                    onclick="window.location.href='registerSchool.html'" style="cursor: pointer">
                    <p class="text-gray-700 font-semibold">Assign Users:</p>
                    <div class="flex justify-center mt-2">
                        <img src="https://www.clipartmax.com/png/small/2-28157_clipart-user-1-png-user-clipart-png.png"
                            alt="Icon" class="w-10 h-10" />
                    </div>
                </div>
                <div class="bg-blue-100 p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <p class="text-gray-700 font-semibold">Registered Schools:</p>
                    <p class="text-3xl font-bold text-blue-600">#</p>
                </div>
                <div class="bg-blue-100 p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <p class="text-gray-700 font-semibold">Registered Users:</p>
                    <p class="text-3xl font-bold text-blue-600">#</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>