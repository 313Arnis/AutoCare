<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-4xl mx-auto p-6 space-y-8">
    <div class="flex justify-between items-center">
        <a href="{{ route('cars.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2 transition text-sm font-bold">
            ← Atpakaļ uz garažu
        </a>
        <h1 class="text-2xl font-extrabold text-gray-800 tracking-tight text-right">Rediģēt auto</h1>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <span class="text-yellow-500 text-2xl">📝</span> {{ $car->razotajs }} {{ $car->modelis }}
            </h2>
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest italic">ID: #{{ $car->id }}</span>
        </div>

        <form action="{{ route('cars.update', $car->id) }}" method="POST" class="p-8">
            @csrf
            @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="space-y-5">
                    <h3 class="text-xs font-bold uppercase text-gray-400 tracking-wider flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span> Pamatinformācija
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-gray-500 ml-1 uppercase">Ražotājs</label>
                            <input type="text" name="razotajs" value="{{ old('razotajs', $car->razotajs) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition font-medium" required>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-gray-500 ml-1 uppercase">Modelis</label>
                            <input type="text" name="modelis" value="{{ old('modelis', $car->modelis) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition font-medium" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-gray-500 ml-1 uppercase">Izlaiduma gads</label>
                            <input type="number" name="gads" value="{{ old('gads', $car->gads) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition font-medium" required>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-gray-500 ml-1 uppercase">Pašreizējais nobraukums</label>
                            <input type="number" name="nobraukums" value="{{ old('nobraukums', $car->nobraukums) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition font-medium" required>
                        </div>
                    </div>
                </div>

                <div class="space-y-5">
                    <h3 class="text-xs font-bold uppercase text-gray-400 tracking-wider flex items-center gap-2">
                        <span class="w-2 h-2 bg-yellow-500 rounded-full"></span> Termiņi
                    </h3>
                    <div class="space-y-4">
                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold text-gray-500 ml-1 uppercase">OCTA beigu datums</label>
                            <input type="date" name="octa_beigas" value="{{ old('octa_beigas', $car->octa_beigas->format('Y-m-d')) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition font-medium" required>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-[10px] font-bold text-gray-500 ml-1 uppercase">Tehniskās apskates beigas</label>
                            <input type="date" name="tehniska_beigas" value="{{ old('tehniska_beigas', $car->tehniska_beigas->format('Y-m-d')) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition font-medium" required>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 pt-6 border-t border-gray-100">
                    <h3 class="text-xs font-bold uppercase text-gray-400 tracking-wider mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span> Lietošanas un servisa iestatījumi
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-gray-500 ml-1 uppercase">Nobraukums pie pēdējās eļļas</label>
                            <input type="number" name="pedeja_ella_km" value="{{ old('pedeja_ella_km', $car->pedeja_ella_km) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition font-medium" required>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-gray-500 ml-1 uppercase">Maiņas intervāls (km)</label>
                            <input type="number" name="ellas_intervals_km" value="{{ old('ellas_intervals_km', $car->ellas_intervals_km) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition font-medium" required>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-gray-500 ml-1 uppercase">Vidējais km mēnesī</label>
                            <input type="number" name="videjais_menes_km" value="{{ old('videjais_menes_km', $car->videjais_menes_km) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition font-medium" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex gap-4 border-t border-gray-50 pt-8">
                <button type="submit" class="flex-1 md:flex-none px-12 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-all shadow-md shadow-blue-100">
                    Saglabāt izmaiņas
                </button>
                <a href="{{ route('cars.index') }}" class="flex-1 md:flex-none px-8 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold rounded-lg transition-all text-center">
                    Atcelt
                </a>
            </div>
        </form>
    </div>
</div>