<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntitySeeder extends Seeder
{
    public function run(): void
    {
        // DB::table('entities')->insert([
        //     ['EntityName' => 'country', 'ModuleID' => DB::table('modules')->where('ModuleName', 'Databank')->first()->ModuleID],
        //     ['EntityName' => 'province', 'ModuleID' => DB::table('modules')->where('ModuleName', 'Databank')->first()->ModuleID],
        //     ['EntityName' => 'category', 'ModuleID' => DB::table('modules')->where('ModuleName', 'Databank')->first()->ModuleID],
        //     ['EntityName' => 'evaluation-authority', 'ModuleID' => DB::table('modules')->where('ModuleName', 'Databank')->first()->ModuleID],
        //     ['EntityName' => 'sukuk-type', 'ModuleID' => DB::table('modules')->where('ModuleName', 'Databank')->first()->ModuleID],
        //     ['EntityName' => 'city', 'ModuleID' => DB::table('modules')->where('ModuleName', 'Databank')->first()->ModuleID],
        //     ['EntityName' => 'account', 'ModuleID' => DB::table('modules')->where('ModuleName', 'User')->first()->ModuleID],
        //     ['EntityName' => 'dashboard', 'ModuleID' => DB::table('modules')->where('ModuleName', 'Dashboard')->first()->ModuleID],
        //     ['EntityName' => 'sukuk', 'ModuleID' => DB::table('modules')->where('ModuleName', 'Sukuk')->first()->ModuleID],
        //     ['EntityName' => 'evaluations', 'ModuleID' => DB::table('modules')->where('ModuleName', 'Sukuk')->first()->ModuleID],
        //     ['EntityName' => 'system-module', 'ModuleID' => DB::table('modules')->where('ModuleName', 'Security')->first()->ModuleID],
        //     ['EntityName' => 'role-rights', 'ModuleID' => DB::table('modules')->where('ModuleName', 'Security')->first()->ModuleID],
        //     ['EntityName' => 'users', 'ModuleID' => DB::table('modules')->where('ModuleName', 'Security')->first()->ModuleID],
        //     ['EntityName' => 'sessions', 'ModuleID' => DB::table('modules')->where('ModuleName', 'Security')->first()->ModuleID],
        //     ['EntityName' => 'security', 'ModuleID' => DB::table('modules')->where('ModuleName', 'Security')->first()->ModuleID],
        // ]);
    }
}