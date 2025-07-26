<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bedrooms',
        'bathrooms',
        'area',
        'car_park',
        'location',
        'type',
        'floors',
        'year_built',
        'nearby_places',
        'image',
        'price',
        'maid_room',
        'total_score',

        // สุขาภิบาล
        'has_septic_tank', 'spec_septic_tank',
        'has_order_trap', 'spec_order_trap',
        'has_grase_trap', 'spec_grase_trap',
        'has_water_tank', 'spec_water_tank',
        'has_water_pump', 'spec_water_pump',
        'has_pipe_termites', 'spec_pipe_termites',

        // หลังคา
        'has_solar_roof', 'spec_solar_roof',
        'has_insulation', 'spec_insulation',
        'has_roof_ventilator', 'spec_roof_ventilator',

        // ไฟฟ้า
        'has_electric_meter', 'spec_electric_meter',
        'has_main_breaker', 'spec_main_breaker',
        'has_rcd', 'spec_rcd',
        'has_ev_charger', 'spec_ev_charger',
        'has_emergency_light', 'spec_emergency_light',
        'has_door_automatic', 'spec_door_automatic',
        'has_smoke_detector', 'spec_smoke_detector',
        'has_rcd_1st', 'spec_rcd_1st',
        'has_rcd_2nd', 'spec_rcd_2nd',
        'has_heat_detector', 'spec_heat_detector',

        // สมาร์ทโฮม/ความปลอดภัย
        'has_smart_home', 'spec_smart_home',
        'has_security_system', 'spec_security_system',
        'has_cctv', 'spec_cctv',
        'has_door_bell', 'spec_door_bell',
        'has_plug_switch', 'spec_plug_switch',
        'has_garage_door', 'spec_garage_door',

        // โครงสร้าง
        'wall_structure',
    ];

    protected $casts = [
        'has_septic_tank' => 'boolean',
        'has_order_trap' => 'boolean',
        'has_grase_trap' => 'boolean',
        'has_water_tank' => 'boolean',
        'has_water_pump' => 'boolean',
        'has_pipe_termites' => 'boolean',
        'has_solar_roof' => 'boolean',
        'has_insulation' => 'boolean',
        'has_roof_ventilator' => 'boolean',
        'has_electric_meter' => 'boolean',
        'has_main_breaker' => 'boolean',
        'has_rcd' => 'boolean',
        'has_ev_charger' => 'boolean',
        'has_emergency_light' => 'boolean',
        'has_door_automatic' => 'boolean',
        'has_smoke_detector' => 'boolean',
        'has_rcd_1st' => 'boolean',
        'has_rcd_2nd' => 'boolean',
        'has_heat_detector' => 'boolean',
        'has_smart_home' => 'boolean',
        'has_security_system' => 'boolean',
        'has_cctv' => 'boolean',
        'has_door_bell' => 'boolean',
        'has_plug_switch' => 'boolean',
        'has_garage_door' => 'boolean',
        'total_score' => 'decimal:1',
    ];

    /**
     * Get rating category breakdown (A, B, C, D)
     */
    public function getRatingBreakdown()
    {
        $categoryWeights = [
            'A' => 0.45, // Structure
            'B' => 0.35, // Safety
            'C' => 0.15, // Comfort
            'D' => 0.05  // Technology
        ];

        $itemWeights = [
            // Structure (A)
            'has_electric_meter' => ['category' => 'A', 'weight' => 45],
            'has_main_breaker' => ['category' => 'A', 'weight' => 30],
            'has_water_tank' => ['category' => 'A', 'weight' => 25],
            'wall_structure' => ['category' => 'A', 'weight' => 20],

            // Safety (B)
            'has_rcd' => ['category' => 'B', 'weight' => 35],
            'has_smoke_detector' => ['category' => 'B', 'weight' => 25],
            'has_heat_detector' => ['category' => 'B', 'weight' => 25],
            'has_security_system' => ['category' => 'B', 'weight' => 20],
            'has_cctv' => ['category' => 'B', 'weight' => 15],
            'has_emergency_light' => ['category' => 'B', 'weight' => 10],

            // Comfort (C)
            'has_door_automatic' => ['category' => 'C', 'weight' => 15],
            'has_garage_door' => ['category' => 'C', 'weight' => 10],
            'has_door_bell' => ['category' => 'C', 'weight' => 8],
            'has_water_pump' => ['category' => 'C', 'weight' => 7],

            // Technology (D)
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
                if ($this->wall_structure && isset($wallStructureWeights[$this->wall_structure])) {
                    $categoryScores[$category] += $weight * $wallStructureWeights[$this->wall_structure];
                }
            } else {
                if ($this->$field) {
                    $categoryScores[$category] += $weight;
                }
            }
        }

        $breakdown = [];
        foreach ($categoryScores as $category => $score) {
            if ($categoryMaxScores[$category] > 0) {
                $categoryPercentage = ($score / $categoryMaxScores[$category]) * 100;
                $weightedScore = $categoryPercentage * $categoryWeights[$category];
                $breakdown[$category] = round($weightedScore, 1);
            } else {
                $breakdown[$category] = 0;
            }
        }

        return $breakdown;
    }
}
