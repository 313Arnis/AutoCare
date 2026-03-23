<!DOCTYPE html>
<html lang="lv" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reģistrēties - Mana Garaža</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full">

<div class="min-h-screen flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8">
    
    <div class="sm:mx-auto sm:w-full sm:max-w-md mb-4">
        <a href="/" class="text-sm font-semibold text-gray-500 hover:text-blue-600 flex items-center gap-2 transition">
            ← Atpakaļ uz sākumu
        </a>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="flex justify-center text-5xl mb-4 drop-shadow-sm">🛠️</div>
        <h2 class="text-center text-3xl font-extrabold text-gray-900 tracking-tight">
            Izveidot kontu
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Pievienojies un nekad neaizmirsti par eļļas maiņu!
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-6 shadow-xl shadow-blue-900/5 border border-gray-100 rounded-3xl sm:px-10">
            
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 ml-1">Vārds</label>
                    <div class="mt-1.5 relative">
                        <input id="name" name="name" type="text" required autofocus
                            value="{{ old('name') }}"
                            class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-2xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-gray-50/50 focus:bg-white"
                            placeholder="Jānis Bērziņš">
                    </div>
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-600 font-medium ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 ml-1">E-pasta adrese</label>
                    <div class="mt-1.5">
                        <input id="email" name="email" type="email" required
                            value="{{ old('email') }}"
                            class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-2xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-gray-50/50 focus:bg-white"
                            placeholder="janis@piemers.lv">
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600 font-medium ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 ml-1">Parole</label>
                        <div class="mt-1.5">
                            <input id="password" name="password" type="password" required
                                class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-2xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-gray-50/50 focus:bg-white"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 ml-1">Atkārtoti</label>
                        <div class="mt-1.5">
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-2xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-gray-50/50 focus:bg-white"
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>
                @error('password')
                    <p class="mt-1 text-xs text-red-600 font-medium ml-1">{{ $message }}</p>
                @enderror

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full flex justify-center py-4 px-4 border border-transparent rounded-2xl shadow-lg shadow-blue-200 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all active:scale-[0.97] transform">
                        Izveidot profilu
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center border-t border-gray-50 pt-6">
                <p class="text-sm text-gray-500">
                    Jau esi biedrs? 
                    <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-500 transition underline underline-offset-4">
                        Pieslēdzies šeit
                    </a>
                </p>
            </div>

        </div>
    </div>
</div>

</body>
</html>