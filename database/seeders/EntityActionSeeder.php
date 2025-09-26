<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntityActionSeeder extends Seeder
{
    public function run(): void
    {
        // DB::table('entityactions')->insert([
        //     // country entity
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'country')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'create')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'country')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'show')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'country')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'edit')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'country')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'delete')->first()->ActionID],
        //     // province entity
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'province')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'create')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'province')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'show')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'province')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'edit')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'province')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'delete')->first()->ActionID],
        //     // category entity
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'category')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'create')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'category')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'show')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'category')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'edit')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'category')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'delete')->first()->ActionID],
        //     // evaluation-authority entity
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'evaluation-authority')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'create')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'evaluation-authority')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'show')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'evaluation-authority')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'edit')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'evaluation-authority')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'delete')->first()->ActionID],
        //     // sukuk-type entity
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'sukuk-type')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'create')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'sukuk-type')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'show')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'sukuk-type')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'edit')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'sukuk-type')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'delete')->first()->ActionID],
        //     // city entity
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'city')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'create')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'city')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'show')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'city')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'edit')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'city')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'delete')->first()->ActionID],
        //     // account entity
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'account')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'show')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'account')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'edit')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'account')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'delete')->first()->ActionID],
        //     // dashboard entity
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'dashboard')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'show')->first()->ActionID],
        //     // sukuk entity
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'sukuk')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'create')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'sukuk')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'show')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'sukuk')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'edit')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'sukuk')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'delete')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'sukuk')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'evaluate')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'sukuk')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'import')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'sukuk')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'export')->first()->ActionID],
        //     // evaluations entity
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'evaluations')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'create')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'evaluations')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'edit')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'evaluations')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'delete')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'evaluations')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'evaluate')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'evaluations')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'import')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'evaluations')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'export')->first()->ActionID],
        //     // system-module entity
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'system-module')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'show')->first()->ActionID],
        //     // role-rights entity
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'role-rights')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'show')->first()->ActionID],
        //     // users entity
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'users')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'show')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'users')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'approve')->first()->ActionID],
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'users')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'reject')->first()->ActionID],
        //     // sessions entity
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'sessions')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'show')->first()->ActionID],
        //     // security entity
        //     ['EntityID' => DB::table('entities')->where('EntityName', 'security')->first()->EntityID, 'ActionID' => DB::table('actions')->where('ActionName', 'show')->first()->ActionID],
        // ]);
    }
}