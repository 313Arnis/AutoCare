<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Inter', sans-serif; background-color: rgb(249, 250, 251); }
    .action-button { display: inline-flex; align-items: center; justify-content: center; height: 48px; transition: all 0.2s; }
    input:invalid { border-color: #ef4444; }
</style>

<div class="max-w-5xl mx-auto p-6 space-y-8">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-black text-gray-900 tracking-tight">MANA GARAŽA</h1>
            <p class="text-sm text-gray-500 font-medium">Pārvaldi savus auto un servisa termiņus</p>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="group flex items-center gap-2 px-4 py-2 text-sm font-bold text-gray-500 hover:text-red-600 bg-white hover:bg-red-50 rounded-xl transition-all border border-gray-200 hover:border-red-200 shadow-sm">
                Iziet no sistēmas
            </button>
        </form>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl shadow-sm">
            <p class="text-sm font-bold text-red-800">Sistēmas validācijas kļūda:</p>
            <ul class="text-xs text-red-700 list-disc ml-4 mt-1">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-white px-8 py-5 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 flex items-center gap-3">Pievienot jaunu auto</h2>
        </div>

        <form action="{{ route('cars.store') }}" method="POST" class="p-8 m-0" id="carCreateForm">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div class="space-y-6">
                    <h3 class="text-xs font-bold uppercase text-blue-600 tracking-widest">Pamatinformācija</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-500 ml-1">Ražotājs</label>
                            <input type="text" name="razotajs" value="{{ old('razotajs') }}" placeholder="Piem. BMW" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none transition bg-gray-50/50 focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-500 ml-1">Modelis</label>
                            <input type="text" name="modelis" value="{{ old('modelis') }}" placeholder="Piem. 530d" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none transition bg-gray-50/50 focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-500 ml-1">Gads</label>
                            <input type="number" name="gads" value="{{ old('gads') }}" min="1900" max="{{ date('Y') + 1 }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none transition bg-gray-50/50 focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-500 ml-1">Pašreizējais nobraukums (km)</label>
                            <input type="number" name="nobraukums" id="nobraukums" value="{{ old('nobraukums') }}" min="0" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none transition bg-gray-50/50 focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <h3 class="text-xs font-bold uppercase text-blue-600 tracking-widest">Termiņi & Serviss</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 bg-blue-50/50 rounded-2xl border border-blue-100 space-y-3">
                            <input type="date" name="octa_beigas" class="date-limit w-full px-3 py-2 rounded-lg border border-gray-200 text-sm" required>
                            <p class="text-[10px] text-gray-400 font-bold uppercase px-1">OCTA beigas</p>
                            <input type="date" name="tehniska_beigas" class="date-limit w-full px-3 py-2 rounded-lg border border-gray-200 text-sm" required>
                            <p class="text-[10px] text-gray-400 font-bold uppercase px-1">TA beigas</p>
                        </div>
                        <div class="space-y-3">
                            <input type="number" name="pedeja_ella_km" id="pedeja_ella" placeholder="Pēdējā eļļa (km)" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm" min="0">
                            <input type="number" name="ellas_intervals_km" value="10000" min="1000" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm">
                            <input type="number" name="videjais_menes_km" placeholder="Km mēnesī" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm" min="0">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="w-full md:w-auto px-10 py-4 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl transition-all shadow-lg shadow-blue-200 active:scale-95">
                    🚗 PIEVIENOT GARAŽAI
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 gap-4">
        @forelse($cars as $car)
            <div class="group bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center hover:shadow-xl transition-all">
                <div class="flex gap-5 items-center">
                    <div class="bg-blue-500 p-4 rounded-2xl text-white">🚗</div>
                    <div>
                        <a href="{{ route('cars.show', $car->id) }}" class="text-xl font-extrabold text-gray-900 hover:text-blue-600">
                            {{ $car->razotajs }} {{ $car->modelis }}
                        </a>
                        <p class="text-xs text-gray-400 font-bold uppercase">{{ $car->gads }} | {{ number_format($car->nobraukums, 0, '.', ' ') }} km</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('cars.edit', $car->id) }}" class="action-button px-6 text-xs font-black text-blue-600 border border-blue-100 rounded-xl hover:bg-blue-600 hover:text-white uppercase tracking-widest">Rediģēt</a>
                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('Dzēst?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="action-button px-6 text-xs font-black text-red-500 border border-red-100 rounded-xl hover:bg-red-500 hover:text-white uppercase tracking-widest">Dzēst</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        
        // Uzstāda minimālo datumu (šodienu) visiem datuma laukiem
        document.querySelectorAll('.date-limit').forEach(el => {
            el.setAttribute('min', today);
        });

        // Validācija nobraukumam pret eļļas maiņu
        const form = document.getElementById('carCreateForm');
        const kmInput = document.getElementById('nobraukums');
        const oilInput = document.getElementById('pedeja_ella');

        function checkOilMileage() {
            if (parseInt(oilInput.value) > parseInt(kmInput.value)) {
                oilInput.setCustomValidity('Eļļas maiņas nobraukums nevar būt lielāks par auto nobraukumu!');
            } else {
                oilInput.setCustomValidity('');
            }
        }

        oilInput.addEventListener('input', checkOilMileage);
        kmInput.addEventListener('input', checkOilMileage);
    });
</script>