<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CarController extends Controller
{
    public function index()
    {

        $cars = Auth::user()->cars ?? Car::where('user_id', Auth::id())->get();

        return view('cars.index', compact('cars'));
    }

    /**
     * Saglabā jaunu auto datubāzē.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'razotajs' => 'required|string|max:255',
            'modelis' => 'required|string|max:255',
            'gads' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'nobraukums' => 'required|integer|min:0',
        
            'octa_beigas' => 'required|date|after_or_equal:today',
            'tehniska_beigas' => 'required|date|after_or_equal:today',
            'pedeja_ella_km' => 'nullable|integer|min:0',
            'ellas_intervals_km' => 'nullable|integer|min:0',
            'videjais_menes_km' => 'nullable|integer|min:0',
        ]);

        $validated['user_id'] = Auth::id();

        Car::create($validated);

        return redirect()->route('cars.index')->with('success', 'Auto veiksmīgi pievienots!');
    }

    public function show(Car $car)
    {

        if ($car->user_id !== Auth::id()) {
            abort(403);
        }

        $next_oil_change_km = $car->pedeja_ella_km + $car->ellas_intervals_km;
        $km_until_oil_change = $next_oil_change_km - $car->nobraukums;


        $months_until_service = $car->videjais_menes_km > 0
            ? $km_until_oil_change / $car->videjais_menes_km
            : null;

        $estimated_service_date = ($months_until_service !== null && $months_until_service > 0)
            ? Carbon::now()->addMonths(round($months_until_service))
            : null;

        // Kritiskie datumi (14 dienas līdz beigām vai jau beidzies)
        $is_octa_critical = Carbon::parse($car->octa_beigas)->isPast() || Carbon::parse($car->octa_beigas)->diffInDays(now()) <= 14;
        $is_tehniska_critical = Carbon::parse($car->tehniska_beigas)->isPast() || Carbon::parse($car->tehniska_beigas)->diffInDays(now()) <= 14;

        return view('cars.show', compact(
            'car',
            'km_until_oil_change',
            'estimated_service_date',
            'is_octa_critical',
            'is_tehniska_critical'
        ));
    }

    public function checkService(Car $car)
    {
        if ($car->user_id !== Auth::id()) abort(403);


        return redirect()->route('cars.show', $car->id)->with('info', 'Servisa statuss atjaunots.');
    }
    public function edit(Car $car)
    {
        if ($car->user_id !== Auth::id()) {
            abort(403);
        }
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        if ($car->user_id !== Auth::id()) {
            abort(403);
        }
        $validated = $request->validate([
            'razotajs' => 'required|string|max:255',
            'modelis' => 'required|string|max:255',
            'gads' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'nobraukums' => 'required|integer|min:0',
            'octa_beigas' => 'required|date',
            'tehniska_beigas' => 'required|date',
            'pedeja_ella_km' => 'required|integer|min:0',
            'ellas_intervals_km' => 'required|integer|min:0',
            'videjais_menes_km' => 'required|integer|min:0',
        ]);

        $car->update($validated);

        return redirect()->route('cars.index')->with('success', 'Auto dati atjaunoti!');
    }
    public function destroy(Car $car)
    {
        if ($car->user_id !== Auth::id()) {
            abort(403);
        }

        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Auto izdzēsts no garažas!');
    }
}