<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-4xl mx-auto p-6 space-y-8">
    <div class="flex justify-between items-center">
        <a href="{{ route('cars.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2 transition text-sm font-bold">← Atpakaļ uz garažu</a>
        <h1 class="text-2xl font-extrabold text-gray-800">Rediģēt auto</h1>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">📝 {{ $car->razotajs }} {{ $car->modelis }}</h2>
            <span class="text-xs font-bold text-gray-400">ID: #{{ $car->id }}</span>
        </div>

        <form action="{{ route('cars.update', $car->id) }}" method="POST" class="p-8" id="carEditForm">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-5">
                    <h3 class="text-xs font-bold uppercase text-gray-400">Pamatinformācija</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="razotajs" value="{{ old('razotajs', $car->razotajs) }}" class="w-full px-4 py-2.5 rounded-lg border focus:ring-2 focus:ring-blue-500" required>
                        <input type="text" name="modelis" value="{{ old('modelis', $car->modelis) }}" class="w-full px-4 py-2.5 rounded-lg border focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <input type="number" name="gads" value="{{ old('gads', $car->gads) }}" min="1900" max="{{ date('Y')+1 }}" class="w-full px-4 py-2.5 rounded-lg border focus:ring-2 focus:ring-blue-500" required>
                        <input type="number" name="nobraukums" id="edit_nobraukums" value="{{ old('nobraukums', $car->nobraukums) }}" min="0" class="w-full px-4 py-2.5 rounded-lg border focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                <div class="space-y-5">
                    <h3 class="text-xs font-bold uppercase text-gray-400">Termiņi</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1">OCTA beigas</label>
                            <input type="date" name="octa_beigas" class="date-limit w-full px-4 py-2.5 rounded-lg border" value="{{ $car->octa_beigas->format('Y-m-d') }}" required>
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1">TA beigas</label>
                            <input type="date" name="tehniska_beigas" class="date-limit w-full px-4 py-2.5 rounded-lg border" value="{{ $car->tehniska_beigas->format('Y-m-d') }}" required>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 pt-6 border-t">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <input type="number" name="pedeja_ella_km" id="edit_pedeja_ella" value="{{ old('pedeja_ella_km', $car->pedeja_ella_km) }}" class="w-full px-4 py-2.5 rounded-lg border" placeholder="Pēdējā eļļa">
                        <input type="number" name="ellas_intervals_km" value="{{ old('ellas_intervals_km', $car->ellas_intervals_km) }}" class="w-full px-4 py-2.5 rounded-lg border" placeholder="Intervāls">
                        <input type="number" name="videjais_menes_km" value="{{ old('videjais_menes_km', $car->videjais_menes_km) }}" class="w-full px-4 py-2.5 rounded-lg border" placeholder="Vidēji mēnesī">
                    </div>
                </div>
            </div>

            <div class="mt-10 flex gap-4">
                <button type="submit" class="px-12 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md">Saglabāt izmaiņas</button>
                <a href="{{ route('cars.index') }}" class="px-8 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold rounded-lg">Atcelt</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.querySelectorAll('.date-limit').forEach(el => {
            el.setAttribute('min', today);
        });

        const kmInput = document.getElementById('edit_nobraukums');
        const oilInput = document.getElementById('edit_pedeja_ella');

        function checkOil() {
            if (parseInt(oilInput.value) > parseInt(kmInput.value)) {
                oilInput.setCustomValidity('Eļļas maiņa nevar pārsniegt pašreizējo nobraukumu!');
            } else {
                oilInput.setCustomValidity('');
            }
        }
        oilInput.addEventListener('input', checkOil);
        kmInput.addEventListener('input', checkOil);
    });
</script>