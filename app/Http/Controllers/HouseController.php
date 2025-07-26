<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\House;

class HouseController extends Controller
{
    public function index()
    {
        return response()->json(House::all());
    }

    public function show($id)
    {
        return response()->json(House::findOrFail($id));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'area' => 'required|integer',
            'car_park' => 'required|integer',
            'location' => 'required|string',
            'type' => 'nullable|string',
            'floors' => 'nullable|integer',
            'year_built' => 'nullable|integer',
            'nearby_places' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',

            // ส่วนของสุขาภิบาล, หลังคา, ไฟฟ้า, สมาร์ทโฮม (รวมจากทั้งสอง Controller)
            'has_septic_tank' => 'nullable|boolean',
            'septic_tank_spec' => 'nullable|string',
            'has_order_trap' => 'nullable|boolean',
            'order_trap_spec' => 'nullable|string',
            'has_grase_trap' => 'nullable|boolean',
            'grase_trap_spec' => 'nullable|string',
            'has_water_tank' => 'nullable|boolean',
            'water_tank_spec' => 'nullable|string',
            'has_water_pump' => 'nullable|boolean',
            'water_pump_spec' => 'nullable|string',
            'has_pipe_termites' => 'nullable|boolean',
            'pipe_termites_spec' => 'nullable|string',

            'has_solar_roof' => 'nullable|boolean',
            'solar_roof_spec' => 'nullable|string',
            'has_insulation' => 'nullable|boolean',
            'insulation_spec' => 'nullable|string',
            'has_roof_ventilator' => 'nullable|boolean',
            'roof_ventilator_spec' => 'nullable|string',

            'has_electric_meter' => 'nullable|boolean',
            'electric_meter_spec' => 'nullable|string',
            'has_main_breaker' => 'nullable|boolean',
            'main_breaker_spec' => 'nullable|string',
            'has_rcd' => 'nullable|boolean',
            'rcd_spec' => 'nullable|string',
            'has_ev_charger' => 'nullable|boolean',
            'ev_charger_spec' => 'nullable|string',
            'has_emergency_light' => 'nullable|boolean',
            'emergency_light_spec' => 'nullable|string',
            'has_door_automatic' => 'nullable|boolean',
            'door_automatic_spec' => 'nullable|string',
            'has_smoke_detector' => 'nullable|boolean',
            'smoke_detector_spec' => 'nullable|string',
            'has_rcd_1st' => 'nullable|boolean',
            'rcd_1st_spec' => 'nullable|string',
            'has_rcd_2nd' => 'nullable|boolean',
            'rcd_2nd_spec' => 'nullable|string',
            'has_heat_detector' => 'nullable|boolean',
            'heat_detector_spec' => 'nullable|string',

            'has_smart_home' => 'nullable|boolean',
            'smart_home_spec' => 'nullable|string',
            'has_security_home_system' => 'nullable|boolean',
            'security_home_system_spec' => 'nullable|string',
            'has_cctv_camera' => 'nullable|boolean',
            'cctv_camera_spec' => 'nullable|string',
            'has_door_bell' => 'nullable|boolean',
            'door_bell_spec' => 'nullable|string',
            'has_plug_switch' => 'nullable|boolean',
            'plug_switch_spec' => 'nullable|string',
            'has_garage_door' => 'nullable|boolean',
            'garage_door_spec' => 'nullable|string',

            'wall_structure' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('image'), $imageName);
            $validated['image'] = $imageName;
        }

        $house = House::create($validated);

        // ✅ คำนวณคะแนนและบันทึก
        $house->total_score = $this->calculateHouseRating($house);
        $house->save();

        return redirect()->route('admin.compare.compare_house')->with('success', 'เพิ่มบ้านเรียบร้อยแล้ว คะแนนรวม: ' . $house->total_score . '/100');
    }

    public function adminView(){
        $houses = House::all();
        return view('admin.compare.compare_house', compact('houses'));
    }

    public function comparisonView(Request $request)
    {
        $houseIds = $request->get('houses');

        if (!$houseIds) {
            return redirect()->route('admin.compare.compare_frontend')->with('error', 'ไม่พบข้อมูลบ้านที่ต้องการเปรียบเทียบ');
        }

        $ids = explode(',', $houseIds);
        $houses = House::whereIn('id', $ids)->get();

        if ($houses->count() < 2) {
            return redirect()->route('admin.compare.compare_frontend')->with('error', 'กรุณาเลือกบ้านอย่างน้อย 2 หลังเพื่อเปรียบเทียบ');
        }

        return view('admin.compare.comparison', compact('houses'));
    }

    public function compareFrontend()
    {
        $houses = House::all();
        return view('admin.compare.compare_frontend', compact('houses'));
    }


    public function apiIndex() {
        $houses = House::all()->map(function ($house) {
            $house->image_url = $house->image ? asset('image/' . $house->image) : null;
            return $house;
        });

        return response()->json($houses);
    }

    public function apiShow($id) {
        return House::findOrFail($id);
    }

    private function calculateHouseRating($house)
    {
        $categoryWeights = [
            'A' => 0.45,
            'B' => 0.35,
            'C' => 0.15,
            'D' => 0.05
        ];

        $itemWeights = [
            'has_electric_meter' => ['category' => 'A', 'weight' => 45],
            'has_main_breaker' => ['category' => 'A', 'weight' => 30],
            'has_water_tank' => ['category' => 'A', 'weight' => 25],
            'wall_structure' => ['category' => 'A', 'weight' => 20],

            'has_rcd' => ['category' => 'B', 'weight' => 35],
            'has_smoke_detector' => ['category' => 'B', 'weight' => 25],
            'has_heat_detector' => ['category' => 'B', 'weight' => 25],
            'has_security_home_system' => ['category' => 'B', 'weight' => 20],
            'has_cctv_camera' => ['category' => 'B', 'weight' => 15],
            'has_emergency_light' => ['category' => 'B', 'weight' => 10],

            'has_door_automatic' => ['category' => 'C', 'weight' => 15],
            'has_garage_door' => ['category' => 'C', 'weight' => 10],
            'has_door_bell' => ['category' => 'C', 'weight' => 8],
            'has_water_pump' => ['category' => 'C', 'weight' => 7],

            'has_ev_charger' => ['category' => 'D', 'weight' => 5],
            'has_smart_home' => ['category' => 'D', 'weight' => 3],
            'has_solar_roof' => ['category' => 'D', 'weight' => 2],
        ];

        $wallStructureWeights = [
            'ก่ออิฐมวลเบา' => 0.6,
            'precast' => 0.4
        ];

        $categoryScores = ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0];
        $categoryMaxScores = ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0];

        foreach ($itemWeights as $field => $config) {
            $category = $config['category'];
            $weight = $config['weight'];
            $categoryMaxScores[$category] += $weight;

            if ($field === 'wall_structure') {
                if ($house->wall_structure && isset($wallStructureWeights[$house->wall_structure])) {
                    $categoryScores[$category] += $weight * $wallStructureWeights[$house->wall_structure];
                }
            } else {
                if ($house->$field) {
                    $categoryScores[$category] += $weight;
                }
            }
        }

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
