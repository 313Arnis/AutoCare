<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>{{ $car->razotajs }} {{ $car->modelis }} | Detaļas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-100">
        
        <div class="bg-slate-800 p-6 text-white flex justify-between items-center">
            <a href="{{ route('cars.index') }}" class="flex items-center gap-2 text-sm font-bold opacity-80 hover:opacity-100 transition">
                <span>←</span> ATPAKAĻ UZ GARAŽU
            </a>
            <span class="text-[10px] font-black tracking-widest uppercase opacity-50">Auto Profils</span>
        </div>

        <div class="p-8">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="text-3xl font-black uppercase text-gray-900 tracking-tighter leading-none">
                        {{ $car->razotajs }} <span class="text-blue-600">{{ $car->modelis }}</span>
                    </h1>
                    <p class="text-gray-400 font-bold mt-2 uppercase text-xs tracking-widest">
                        {{ $car->gads }}. GADA MODELIS
                    </p>
                </div>
                <div class="text-right bg-gray-50 p-4 rounded-2xl border border-gray-100">
                    <span class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Kopējais nobraukums</span>
                    <p class="text-2xl font-mono font-black text-gray-800">
                        {{ number_format($car->nobraukums, 0, ',', ' ') }} <span class="text-sm font-normal text-gray-400">km</span>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                @php
                    $now = \Carbon\Carbon::now()->startOfDay();
                    
                    // OCTA dati
                    $octa_date = \Carbon\Carbon::parse($car->octa_beigas)->startOfDay();
                    $octa_days = $now->diffInDays($octa_date, false);
                    
                    // TA dati
                    $ta_date = \Carbon\Carbon::parse($car->tehniska_beigas)->startOfDay();
                    $ta_days = $now->diffInDays($ta_date, false);

                    // Inline funkcija locīšanai, lai izvairītos no "function already defined" kļūdas
                    $getLatvianDays = function($n) {
                        if ($n <= 0) return "Termiņš beidzies!";
                        $n = abs($n);
                        $lastDigit = $n % 10;
                        $lastTwoDigits = $n % 100;
                        
                        $word = ($lastDigit == 1 && $lastTwoDigits != 11) ? "diena" : "dienas";
                        $prefix = ($lastDigit == 1 && $lastTwoDigits != 11) ? "Atlicis" : "Atlikušas";
                        
                        return "$prefix $n $word";
                    };
                @endphp

                @php
                    $octa_color = 'green';
                    if ($octa_days <= 14) $octa_color = 'red';
                    elseif ($octa_days <= 30) $octa_color = 'amber';
                @endphp
                <div class="p-5 rounded-2xl border-2 transition-all 
                    {{ $octa_color == 'red' ? 'border-red-100 bg-red-50/50' : ($octa_color == 'amber' ? 'border-amber-100 bg-amber-50/50' : 'border-green-100 bg-green-50/50') }}">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-black uppercase text-{{ $octa_color }}-600">🛡️ OCTA Beidzas</span>
                        @if($octa_days <= 14 && $octa_days > 0)
                            <span class="flex h-2 w-2 rounded-full bg-red-600 animate-ping"></span>
                        @endif
                    </div>
                    <p class="text-xl font-black text-gray-800">{{ $octa_date->format('d.m.Y') }}</p>
                    <p class="text-[10px] font-bold text-gray-400 uppercase mt-1">
                        {{ $getLatvianDays($octa_days) }}
                    </p>
                </div>

                @php
                    $ta_color = 'green';
                    if ($ta_days <= 14) $ta_color = 'red';
                    elseif ($ta_days <= 30) $ta_color = 'amber';
                @endphp
                <div class="p-5 rounded-2xl border-2 transition-all 
                    {{ $ta_color == 'red' ? 'border-red-100 bg-red-50/50' : ($ta_color == 'amber' ? 'border-amber-100 bg-amber-50/50' : 'border-green-100 bg-green-50/50') }}">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-black uppercase text-{{ $ta_color }}-600">🛠️ TA Termiņš</span>
                        @if($ta_days <= 14 && $ta_days > 0)
                            <span class="flex h-2 w-2 rounded-full bg-red-600 animate-ping"></span>
                        @endif
                    </div>
                    <p class="text-xl font-black text-gray-800">{{ $ta_date->format('d.m.Y') }}</p>
                    <p class="text-[10px] font-bold text-gray-400 uppercase mt-1">
                        {{ $getLatvianDays($ta_days) }}
                    </p>
                </div>
            </div>

            <div class="bg-slate-50 border border-gray-200 p-6 rounded-3xl relative overflow-hidden">
                @php
                    $oil_life_percent = max(0, min(100, ($km_until_oil_change / $car->ellas_intervals_km) * 100));
                    $bar_color = 'bg-emerald-500';
                    $text_color = 'text-emerald-700';
                    if ($oil_life_percent < 20) {
                        $bar_color = 'bg-red-500';
                        $text_color = 'text-red-700';
                    } elseif ($oil_life_percent < 45) {
                        $bar_color = 'bg-amber-500';
                        $text_color = 'text-amber-700';
                    }
                @endphp

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-gray-900 font-black uppercase text-xs tracking-widest">Eļļas resurss</h3>
                    <span class="text-xs font-black {{ $text_color }} bg-white px-3 py-1 rounded-full shadow-sm border border-gray-100">
                        {{ round($oil_life_percent) }}% Atlicis
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <small class="text-gray-400 block text-[10px] uppercase font-black mb-1">Nobraukt līdz maiņai:</small>
                        <p class="text-2xl font-black {{ $km_until_oil_change < 1000 ? 'text-red-600' : 'text-gray-800' }}">
                            {{ number_format($km_until_oil_change, 0, ',', ' ') }} <span class="text-sm font-bold uppercase">km</span>
                        </p>
                    </div>
                    <div>
                        <small class="text-gray-400 block text-[10px] uppercase font-black mb-1">Paredzamais datums:</small>
                        <p class="text-xl font-black text-gray-800">
                            {{ $estimated_service_date ? $estimated_service_date->translatedFormat('F Y') : 'Nav datu' }}
                        </p>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="w-full bg-gray-200 h-4 rounded-full overflow-hidden p-1 shadow-inner">
                        <div class="{{ $bar_color }} h-full rounded-full transition-all duration-1000 ease-out shadow-lg" 
                             style="width: {{ $oil_life_percent }}%">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-gray-100 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('cars.edit', $car->id) }}"
                    class="flex-1 bg-slate-800 text-white text-center py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-black transition-all shadow-lg">
                    Labot auto datus
                </a>
                
                <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Dzēst?')"
                        class="w-full bg-white text-red-600 border-2 border-red-50 py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-red-50 transition-all">
                        Dzēst auto
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>