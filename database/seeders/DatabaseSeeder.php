<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PageVariable;
use App\Models\MajorDepartment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Pastwork;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function create_major()
    {
        MajorDepartment::create([
            // 'icon' => 'fa-search',
            "theme" => 'blue-theme',
            'locale' => [
                'en' => 'T. Home Inspector',
                'th' => 'ตรวจบ้าน'
            ]
        ]);
        MajorDepartment::create([
            // 'icon' => 'fa-hammer',
            "theme" => 'orange-theme',
            'locale' => [
                'en' => 'T. Home Construction',
                'th' => 'ต่อเติม'
            ]
        ]);
        MajorDepartment::create([
            // 'icon' => 'fa-paint-brush',
            "theme" => 'gray-theme',
            'locale' => [
                'en' => 'T. Home Interior',
                'th' => 'ตกแต่ง'
            ]
        ]);
    }

    public function create_page_variable()
    {
        PageVariable::create([
            'page' => 'home',
            'var' => [
                'dev' => '99',
                'project' => '99',
                'house' => '99',
                'satisfaction' => '99'
            ]
        ]);
    }

    public function create_user_variable()
    {
        User::create([
            'name' => 'superadmin',
            'username' => 'superadmin',
            'password' => Hash::make('superadmin'),
        ]);
    }

    // public function create_page_project()
    // {
    //     $projects = [
    //         'inspection',
    //         'construction',
    //         'interior',
    //         'hbutler'
    //     ];

    //     foreach ($projects as $project) {
    //         Pastwork::create([
    //             'page' => $project,
    //             'title' => [
    //                 'en' => 'Project Title in English',
    //                 'th' => 'ชื่อโครงการภาษาไทย'
    //             ],
    //             'detail' => [
    //                 'en' => 'Project details in English',
    //                 'th' => 'รายละเอียดโครงการภาษาไทย'
    //             ],
    //             'images' => []
    //         ]);
    //     }
    // }

    public function run()
    {
        $this->create_major();
        $this->create_page_variable();
        $this->create_user_variable();
    }
}
