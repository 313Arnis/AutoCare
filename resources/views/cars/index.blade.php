<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-4xl mx-auto p-6 space-y-6">
    
    <div class="flex justify-end items-center pt-2">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="group flex items-center gap-2 px-4 py-2 text-sm font-bold text-gray-500 hover:text-red-600 bg-white hover:bg-red-50 rounded-xl transition-all border border-gray-100 hover:border-red-100 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Iziet no sistēmas
            </button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <span class="text-blue-600">➕</span> Pievienot jaunu auto
            </h2>
        </div>

        <form action="{{ route('cars.store') }}" method="POST" class="p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="space-y-4">
                    <h3 class="text-xs font-bold uppercase text-gray-400 tracking-wider">Pamatinformācija</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <input type="text" name="razotajs" placeholder="Ražotājs" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                        <input type="text" name="modelis" placeholder="Modelis" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <input type="number" name="gads" placeholder="Gads" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                        <input type="number" name="nobraukums" placeholder="Nobraukums (km)" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xs font-bold uppercase text-gray-400 tracking-wider">Termiņi & Serviss</h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <label class="text-xs font-medium text-gray-600 w-24">OCTA līdz:</label>
                            <input type="date" name="octa_beigas" class="flex-1 px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                        </div>
                        <div class="flex items-center gap-3">
                            <label class="text-xs font-medium text-gray-600 w-24">TA līdz:</label>
                            <input type="date" name="tehniska_beigas" class="flex-1 px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t border-gray-50">
                    <input type="number" name="pedeja_ella_km" placeholder="Eļļas maiņa (km)" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                    <div class="relative">
                        <input type="number" name="ellas_intervals_km" value="10000" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition pl-24" required>
                        <span class="absolute left-3 top-2.5 text-xs text-gray-400">Intervāls:</span>
                    </div>
                    <input type="number" name="videjais_menes_km" placeholder="Vidēji km/mēnesī" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full md:w-auto px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-all shadow-md shadow-blue-100 flex items-center justify-center gap-2">
                    <span>🚗</span> Pievienot auto garažai
                </button>
            </div>
        </form>
    </div>

    <div class="space-y-4">
        <h2 class="text-xl font-bold text-gray-800 px-1">Mana Garaža</h2>
        
        <div class="grid grid-cols-1 gap-4">
            @forelse($cars as $car)
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="flex gap-4 items-center">
                        <div class="bg-blue-50 p-3 rounded-full text-2xl">🚗</div>
                        <div>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('cars.show', $car->id) }}" class="text-lg font-bold text-gray-800 hover:text-blue-600 transition">
                                    {{ $car->razotajs }} {{ $car->modelis }}
                                </a>
                                <span class="text-[10px] px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full font-bold uppercase tracking-tight">
                                    {{ $car->gads }}. gads
                                </span>

                                @php
                                    $ellas_limits = $car->pedeja_ella_km + $car->ellas_intervals_km;
                                    $prognoze = $car->nobraukums + $car->videjais_menes_km;
                                    $jamaina_somenes = ($car->nobraukums < $ellas_limits && $prognoze >= $ellas_limits);
                                @endphp
                                @if($jamaina_somenes)
                                    <span class="animate-pulse bg-red-100 text-red-600 text-[10px] px-2 py-0.5 rounded-full font-bold">⚠️ EĻĻA ŠOMĒNES</span>
                                @endif
                            </div>
                            
                            <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1">
                                <p class="text-gray-500 text-sm">
                                    <span class="text-gray-400 italic">Nobraukums:</span> <span class="font-semibold text-gray-700">{{ number_format($car->nobraukums, 0, ',', ' ') }} km</span>
                                </p>
                                <p class="text-gray-500 text-sm">
                                    <span class="text-gray-400 italic">TA:</span> <span class="font-semibold {{ \Carbon\Carbon::parse($car->tehniska_beigas)->isPast() ? 'text-red-500' : 'text-green-600' }}">{{ \Carbon\Carbon::parse($car->tehniska_beigas)->format('d.m.Y') }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 w-full md:w-auto justify-end border-t md:border-t-0 pt-3 md:pt-0 mt-2 md:mt-0">
                        <form action="{{ route('cars.check-service', $car->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-2.5 text-gray-600 hover:bg-yellow-50 hover:text-yellow-600 rounded-lg border border-gray-100 transition shadow-sm" title="Pārbaudīt servisu">
                                🔧
                            </button>
                        </form>

                        <form action="{{ route('cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('Vai tiešām dzēst šo auto?')">
                            @csrf 
                            @method('DELETE')
                            <button class="px-4 py-2 text-xs font-bold uppercase text-red-500 hover:bg-red-50 rounded-lg border border-red-50 transition tracking-wider">
                                Dzēst
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 py-12 text-center text-gray-400">
                    <p class="text-3xl mb-2">🏘️</p>
                    <p class="italic">Garaža šobrīd ir tukša...</p>
                </div>
            @endforelse
        </div>
    </div>
</div>