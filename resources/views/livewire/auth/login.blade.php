<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="flex justify-center text-5xl mb-4">🚗</div>
        <h2 class="text-center text-3xl font-extrabold text-gray-900">
            Ieiet Garažā
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Vai arī 
            <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500 transition">
                reģistrē jaunu kontu
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow-sm border border-gray-100 sm:rounded-2xl sm:px-10">
            
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 text-center bg-green-50 py-2 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 underline-offset-4">
                        E-pasta adrese
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required autofocus
                            value="{{ old('email') }}"
                            class="appearance-none block w-full px-3 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="vards@piemers.lv">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Parole
                        </label>
                        @if (Route::has('password.request'))
                            <div class="text-sm">
                                <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                    Aizmirsi paroli?
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="appearance-none block w-full px-3 py-3 border border-gray-100 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Atcerēties mani
                    </label>
                </div>

                <div>
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all active:scale-[0.98]">
                        Pieslēgties
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>