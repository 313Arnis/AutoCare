<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>{{ $car->razotajs }} {{ $car->modelis }} | Detaļas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 font-sans">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-8 text-sm">
        
        <a href="{{ route('cars.index') }}" class="text-blue-500 hover:text-blue-700 font-medium">← Atpakaļ uz garāžu</a>
        
        <div class="flex justify-between items-end my-6 border-b pb-4">
            <div>
                <h1 class="text-2xl font-black uppercase text-gray-800 tracking-tight">
                    {{ $car->razotajs }} {{ $car->modelis }}
                </h1>
                <p class="text-gray-500 italic">{{ $car->gads }}. gada modelis</p>
            </div>
            <div class="text-right">
                <span class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Pašreizējais nobraukums</span>
                <p class="text-xl font-mono font-bold">{{ number_format($car->nobraukums, 0, ',', ' ') }} km</p>
            </div>
        </div>

        <section class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4 rounded-lg {{ $is_octa_critical ? 'bg-red-50 border border-red-200' : 'bg-green-50 border border-green-200' }}">
                    <small class="font-bold {{ $is_octa_critical ? 'text-red-700' : 'text-green-700' }} uppercase">🛡️ OCTA beidzas</small>
                    <p class="text-lg font-bold">{{ \Carbon\Carbon::parse($car->octa_beigas)->format('d.m.Y') }}</p>
                </div>

                <div class="p-4 rounded-lg {{ $is_tehniska_critical ? 'bg-red-50 border border-red-200' : 'bg-green-50 border border-green-200' }}">
                    <small class="font-bold {{ $is_tehniska_critical ? 'text-red-700' : 'text-green-700' }} uppercase">🛠️ TA termiņš</small>
                    <p class="text-lg font-bold">{{ \Carbon\Carbon::parse($car->tehniska_beigas)->format('d.m.Y') }}</p>
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-100 p-6 rounded-lg">
                <h3 class="text-blue-800 font-bold uppercase text-xs mb-3">Eļļas maiņas prognoze</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <small class="text-gray-500 block">Atlicis nobraukt:</small>
                        <p class="text-xl font-bold {{ $km_until_oil_change < 1000 ? 'text-red-600' : 'text-blue-900' }}">
                            {{ number_format($km_until_oil_change, 0, ',', ' ') }} km
                        </p>
                    </div>
                    <div>
                        <small class="text-gray-500 block">Paredzamais laiks:</small>
                        <p class="text-xl font-bold text-blue-900">
                            {{ $estimated_service_date ? $estimated_service_date->translatedFormat('F Y') : 'Nav datu' }}
                        </p>
                    </div>
                </div>
                
                @php 
                    $oil_life_percent = max(0, min(100, ($km_until_oil_change / $car->ellas_intervals_km) * 100));
                @endphp
                <div class="w-full bg-blue-200 h-2 mt-4 rounded-full overflow-hidden">
                    <div class="bg-blue-600 h-full transition-all" style="width: {{ $oil_life_percent }}%"></div>
                </div>
            </div>

            <div class="pt-4 border-t grid grid-cols-2 gap-4">
                <div>
                    <small class="font-bold text-gray-400 uppercase text-[10px]">Vidēji mēnesī</small>
                    <p class="font-medium text-gray-700">{{ $car->videjais_menes_km }} km</p>
                </div>
                <div>
                    <small class="font-bold text-gray-400 uppercase text-[10px]">Eļļas intervāls</small>
                    <p class="font-medium text-gray-700">{{ number_format($car->ellas_intervals_km, 0, ',', ' ') }} km</p>
                </div>
            </div>
        </section>

        <div class="mt-8 pt-6 border-t flex gap-3">
            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('Pārdots vai nodots lūžņos?')">
                @csrf @method('DELETE')
                <button class="bg-red-600 text-white px-6 py-2 hover:bg-red-700 uppercase text-xs font-black rounded transition">
                    Noņemt no uzskaites
                </button>
            </form>
            
            <a href="{{ route('cars.edit', $car->id) }}" class="bg-gray-800 text-white px-6 py-2 hover:bg-black uppercase text-xs font-black rounded transition text-center">
                Labot datus
            </a>
        </div>

    </div>
</body>
</html>