<header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between">

    <div>
    </div>

    <div class="flex items-center gap-4">

        <div class="text-right">
            <p class="font-semibold text-gray-800">
                {{ Auth::user()->name }}
            </p>

        </div>

        <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button class="bg-red-500 hover:bg-red-600 transition text-white px-4 py-2 rounded-xl">
                Logout
            </button>

        </form>

    </div>

</header>
