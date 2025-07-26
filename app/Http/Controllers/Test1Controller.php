<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $houses = House::all();
        
        // Calculate rating for each house if not already calculated
        foreach ($houses as $house) {
            if (!$house->total_score) {
                $house->total_score = $this->calculateHouseRating($house);
                $house->save();
            }
        }
        
        return view('admin.houses.index', compact('houses'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'bedrooms' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'area' => 'required|numeric|min:1',
            'car_park' => 'required|integer|min:0',
            'location' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'floors' => 'nullable|integer|min:1',
            'year_built' => 'nullable|integer|min:1900|max:2030',
            'nearby_places' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // Structure (A) - 45%
            'has_electric_meter' => 'nullable|boolean',
            'electric_meter_spec' => 'nullable|string',
            'has_main_breaker' => 'nullable|boolean',
            'main_breaker_spec' => 'nullable|string',
            'has_water_tank' => 'nullable|boolean',
            'water_tank_spec' => 'nullable|string',
            'wall_structure' => 'nullable|string',
            
            // Safety (B) - 35%
            'has_rcd' => 'nullable|boolean',
            'rcd_spec' => 'nullable|string',
            'has_smoke_detector' => 'nullable|boolean',
            'smoke_detector_spec' => 'nullable|string',
            'has_heat_detector' => 'nullable|boolean',
            'heat_detector_spec' => 'nullable|string',
            'has_security_home_system' => 'nullable|boolean',
            'security_home_system_spec' => 'nullable|string',
            'has_cctv_camera' => 'nullable|boolean',
            'cctv_camera_spec' => 'nullable|string',
            'has_emergency_light' => 'nullable|boolean',
            'emergency_light_spec' => 'nullable|string',
            
            // Comfort (C) - 15%
            'has_door_automatic' => 'nullable|boolean',
            'door_automatic_spec' => 'nullable|string',
            'has_garage_door' => 'nullable|boolean',
            'garage_door_spec' => 'nullable|string',
            'has_door_bell' => 'nullable|boolean',
            'door_bell_spec' => 'nullable|string',
            'has_water_pump' => 'nullable|boolean',
            'water_pump_spec' => 'nullable|string',
            
            // Technology (D) - 5%
            'has_ev_charger' => 'nullable|boolean',
            'ev_charger_spec' => 'nullable|string',
            'has_smart_home' => 'nullable|boolean',
            'smart_home_spec' => 'nullable|string',
            'has_solar_roof' => 'nullable|boolean',
            'solar_roof_spec' => 'nullable|string',
            
            // Additional systems
            'has_septic_tank' => 'nullable|boolean',
            'septic_tank_spec' => 'nullable|string',
            'has_order_trap' => 'nullable|boolean',
            'order_trap_spec' => 'nullable|string',
            'has_grase_trap' => 'nullable|boolean',
            'grase_trap_spec' => 'nullable|string',
            'has_pipe_termites' => 'nullable|boolean',
            'pipe_termites_spec' => 'nullable|string',
            'has_insulation' => 'nullable|boolean',
            'insulation_spec' => 'nullable|string',
            'has_roof_ventilator' => 'nullable|boolean',
            'roof_ventilator_spec' => 'nullable|string',
            'has_rcd_1st' => 'nullable|boolean',
            'rcd_1st_spec' => 'nullable|string',
            'has_rcd_2nd' => 'nullable|boolean',
            'rcd_2nd_spec' => 'nullable|string',
            'has_plug_switch' => 'nullable|boolean',
            'plug_switch_spec' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('image'), $imageName);
            $validatedData['image'] = $imageName;
        }

        // Create house record
        $house = House::create($validatedData);
        
        // Calculate and save rating
        $house->total_score = $this->calculateHouseRating($house);
        $house->save();

        return redirect()->route('admin.houses.index')
                        ->with('success', 'เพิ่มข้อมูลบ้านเรียบร้อยแล้ว คะแนนรวม: ' . $house->total_score . '/100');
    }

    private function calculateHouseRating($house)
    {
        // Rating weights for each category
        $categoryWeights = [
            'A' => 0.45, // Structure - 45%
            'B' => 0.35, // Safety - 35%
            'C' => 0.15, // Comfort - 15%
            'D' => 0.05  // Technology - 5%
        ];

        // Define item weights within each category
        $itemWeights = [
            // Structure (A) - Total possible: 120 points
            'has_electric_meter' => ['category' => 'A', 'weight' => 45],
            'has_main_breaker' => ['category' => 'A', 'weight' => 30],
            'has_water_tank' => ['category' => 'A', 'weight' => 25],
            'wall_structure' => ['category' => 'A', 'weight' => 20],
            
            // Safety (B) - Total possible: 130 points
            'has_rcd' => ['category' => 'B', 'weight' => 35],
            'has_smoke_detector' => ['category' => 'B', 'weight' => 25],
            'has_heat_detector' => ['category' => 'B', 'weight' => 25],
            'has_security_home_system' => ['category' => 'B', 'weight' => 20],
            'has_cctv_camera' => ['category' => 'B', 'weight' => 15],
            'has_emergency_light' => ['category' => 'B', 'weight' => 10],
            
            // Comfort (C) - Total possible: 40 points
            'has_door_automatic' => ['category' => 'C', 'weight' => 15],
            'has_garage_door' => ['category' => 'C', 'weight' => 10],
            'has_door_bell' => ['category' => 'C', 'weight' => 8],
            'has_water_pump' => ['category' => 'C', 'weight' => 7],
            
            // Technology (D) - Total possible: 10 points
            'has_ev_charger' => ['category' => 'D', 'weight' => 5],
            'has_smart_home' => ['category' => 'D', 'weight' => 3],
            'has_solar_roof' => ['category' => 'D', 'weight' => 2],
        ];

        // Special weights for wall structure options
        $wallStructureWeights = [
            'ก่ออิฐมวลเบา' => 0.6, // 60%
            'precast' => 0.4       // 40%
        ];

        $categoryScores = ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0];
        $categoryMaxScores = ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0];

        // Calculate scores for each item
        foreach ($itemWeights as $field => $config) {
            $category = $config['category'];
            $weight = $config['weight'];
            
            $categoryMaxScores[$category] += $weight;

            if ($field === 'wall_structure') {
                // Handle special case for wall structure with weighted options
                if ($house->wall_structure && isset($wallStructureWeights[$house->wall_structure])) {
                    $categoryScores[$category] += $weight * $wallStructureWeights[$house->wall_structure];
                }
            } else {
                // Handle boolean fields
                if ($house->$field) {
                    $categoryScores[$category] += $weight;
                }
            }
        }

        // Calculate final weighted score
        $totalScore = 0;
        foreach ($categoryScores as $category => $score) {
            if ($categoryMaxScores[$category] > 0) {
                $categoryPercentage = ($score / $categoryMaxScores[$category]) * 100;
                $weightedScore = $categoryPercentage * $categoryWeights[$category];
                $totalScore += $weightedScore;
            }
        }

        return round($totalScore, 1);
    }
}
