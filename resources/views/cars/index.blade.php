<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
 
<!-- Pogu dizains -->
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: rgb(249, 250, 251);
    }
    
    .action-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 48px; 
        transition: all 0.2s;
    }
</style>

<div class="max-w-5xl mx-auto p-6 space-y-8">

    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-black text-gray-900 tracking-tight">MANA GARAŽA</h1>
            <p class="text-sm text-gray-500 font-medium">Pārvaldi savus auto un servisa termiņus</p>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit"
                class="group flex items-center gap-2 px-4 py-2 text-sm font-bold text-gray-500 hover:text-red-600 bg-white hover:bg-red-50 rounded-xl transition-all border border-gray-200 hover:border-red-200 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Iziet no sistēmas
            </button>
        </form>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl shadow-sm animate-pulse">
            <div class="flex items-center gap-3">
                <span class="text-red-500 text-xl">⚠️</span>
                <div>
                    <p class="text-sm font-bold text-red-800">Kļūda saglabājot datus:</p>
                    <ul class="text-xs text-red-700 list-disc ml-4 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-xl shadow-blue-900/5 border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-white px-8 py-5 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 flex items-center gap-3">
                <span class="flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-lg text-sm">➕</span>
                Pievienot jaunu auto
            </h2>
        </div>

        <form action="{{ route('cars.store') }}" method="POST" class="p-8 m-0">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                <div class="space-y-6">
                    <div>
                        <h3 class="text-xs font-bold uppercase text-blue-600 tracking-widest mb-4">Pamatinformācija</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-500 ml-1">Ražotājs</label>
                                <input type="text" name="razotajs" value="{{ old('razotajs') }}" placeholder="BMW"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition bg-gray-50/50"
                                    required>
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-500 ml-1">Modelis</label>
                                <input type="text" name="modelis" value="{{ old('modelis') }}" placeholder="530d"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition bg-gray-50/50"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-500 ml-1">Gads</label>
                            <input type="number" name="gads" value="{{ old('gads') }}" placeholder="2020"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition bg-gray-50/50"
                                required>
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-500 ml-1">Nobraukums (km)</label>
                            <input type="number" name="nobraukums" value="{{ old('nobraukums') }}" placeholder="185000"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition bg-gray-50/50"
                                required>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <h3 class="text-xs font-bold uppercase text-blue-600 tracking-widest mb-4">Tehniskie dati & Termiņi</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 bg-blue-50/50 rounded-2xl border border-blue-100 space-y-3">
                            <div class="flex items-center gap-2 text-blue-700 font-bold text-xs uppercase">📅 Termiņi</div>
                            <div class="space-y-2">
                                <input type="date" name="octa_beigas" id="octa_date" value="{{ old('octa_beigas') }}"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                    required>
                                <p class="text-[10px] text-gray-400 font-medium px-1 uppercase">OCTA beigas</p>
                                
                                <input type="date" name="tehniska_beigas" id="ta_date" value="{{ old('tehniska_beigas') }}"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                    required>
                                <p class="text-[10px] text-gray-400 font-medium px-1 uppercase">TA beigas</p>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <input type="number" name="pedeja_ella_km" value="{{ old('pedeja_ella_km') }}" placeholder="Pēdējā eļļa (km)"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition text-sm">
                            <div class="relative">
                                <input type="number" name="ellas_intervals_km" value="{{ old('ellas_intervals_km', 10000) }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition pl-24 text-sm font-bold text-blue-600">
                                <span class="absolute left-3 top-3.5 text-[10px] uppercase font-bold text-gray-400">Maiņa ik:</span>
                            </div>
                            <input type="number" name="videjais_menes_km" value="{{ old('videjais_menes_km') }}" placeholder="Km mēnesī"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition text-sm">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit"
                    class="w-full md:w-auto px-10 py-4 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl transition-all shadow-lg shadow-blue-200 flex items-center justify-center gap-3 active:scale-95">
                    <span>🚗</span> PIEVIENOT GARAŽAI
                </button>
            </div>
        </form>
    </div>

    <div class="space-y-4">
        <div class="flex items-center justify-between px-2">
            <h2 class="text-xl font-black text-gray-800">AKTĪVIE AUTO <span class="ml-2 text-sm font-medium text-gray-400">({{ count($cars ?? []) }})</span></h2>
        </div>

        <div class="grid grid-cols-1 gap-4">
            @forelse($cars as $car)
                <div class="group bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 hover:shadow-xl hover:shadow-blue-900/5 transition-all duration-300">
                    <div class="flex gap-5 items-center">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-4 rounded-2xl text-2xl shadow-inner group-hover:scale-110 transition-transform">🚗</div>
                        <div>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('cars.show', $car->id) }}" class="text-xl font-extrabold text-gray-900 hover:text-blue-600 transition tracking-tight">
                                    {{ $car->razotajs }} {{ $car->modelis }}
                                </a>
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-500 rounded-lg text-xs font-bold uppercase">{{ $car->gads }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 w-full md:w-auto justify-end border-t md:border-t-0 pt-4 md:pt-0">
                        
                        <a href="{{ route('cars.edit', $car->id) }}" 
                           class="action-button px-6 text-xs font-black uppercase text-blue-600 hover:bg-blue-600 hover:text-white rounded-xl border border-blue-100 tracking-widest shadow-sm">
                            Rediģēt
                        </a>

                        <form action="{{ route('cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('Vai tiešām dzēst šo auto?')" class="m-0">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                class="action-button px-6 text-xs font-black uppercase text-red-500 hover:bg-red-500 hover:text-white rounded-xl border border-red-100 tracking-widest shadow-sm">
                                DZĒST
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-3xl border-2 border-dashed border-gray-200 py-16 text-center">
                    <p class="text-gray-400 font-bold">Garaža ir tukša...</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Šodienas datums ISO formātā (YYYY-MM-DD)
        const today = new Date().toISOString().split('T')[0];
        
        const octaDate = document.getElementById('octa_date');
        const taDate = document.getElementById('ta_date');
        
        // Uzstāda minimālo datumu visiem datuma laukiem
        if (octaDate) octaDate.setAttribute('min', today);
        if (taDate) taDate.setAttribute('min', today);
    });
</script>