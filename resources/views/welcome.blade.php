<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center p-6 text-center">
         
        <div class="max-w-2xl bg-white p-10 rounded-2xl shadow-xl">
            <div class="text-6xl mb-6 text-blue-600">🚗</div>
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
                AutoCare
            </h1>
            <p class="text-lg text-gray-600 mb-8">
                Vienkāršākais veids, kā sekot līdzi sava auto tehniskajam stāvoklim, OCTA termiņiem un eļļas maiņas intervāliem vienuviet.
            </p> 

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('home') }}" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                            Doties uz Garažu
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                            Ielogoties
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-gray-700 font-bold rounded-lg border border-gray-300 hover:bg-gray-50 transition shadow-sm">
                                Reģistrēties
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12 pt-8 border-t border-gray-100">
                <div class="text-sm">
                    <span class="block font-bold text-gray-800 italic">📅 OCTA / TA</span>
                    <span class="text-gray-500">Sekojiet termiņiem</span>
                </div>
                <div class="text-sm">
                    <span class="block font-bold text-gray-800 italic">🔧 Serviss</span>
                    <span class="text-gray-500">Eļļas maiņas kontrole</span>
                </div>
                <div class="text-sm">
                    <span class="block font-bold text-gray-800 italic">📈 Nobraukums</span>
                    <span class="text-gray-500">Vidējā patēriņa prognoze</span>
                </div>
            </div>
        </div>

        <footer class="mt-8 text-gray-400 text-sm">
            &copy; {{ date('Y') }} Auto Garaža Pro. Visas tiesības aizsargātas.
        </footer>
    </div>
</body>
</html>