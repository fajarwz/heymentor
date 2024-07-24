<?php

namespace Database\Seeders;

use App\Enums\BookingStatus;
use App\Enums\UserRole;
use App\Models\Booking;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $member = User::where('role', UserRole::ROLE_MEMBER)->first();
        $mentor = User::where('role', UserRole::ROLE_MENTOR)->first();
        $setting = Setting::first();

        $data = [
            [
                'user_id' => $member->id,
                'mentor_user_id' => $mentor->id,
                'start_date_time' => now()->addDay()->startOfHour(),
                'end_date_time' => now()->addDay()->addHours(3)->endOfHour(),
                'price_after_hours' => $priceAfterHours = $mentor->mentor->price_per_hour * 3,
                'tax_cost' => $taxCost = ($setting->tax_percent / 100) * $priceAfterHours,
                'career_insurance_cost' => $careerInsuranceCost = $setting->career_insurance_cost,
                'add_on_tools_cost' => $addOnToolsCost = $setting->add_on_tools_cost,
                'grand_total' => $priceAfterHours + $taxCost + $careerInsuranceCost + $addOnToolsCost,
                'status' => BookingStatus::STATUS_APPROVED,
            ],
            [
                'user_id' => $member->id,
                'mentor_user_id' => $mentor->id,
                'start_date_time' => now()->addDays(2)->addHours(3)->startOfHour(),
                'end_date_time' => now()->addDays(2)->addHours(6)->endOfHour(),
                'price_after_hours' => $priceAfterHours = $mentor->mentor->price_per_hour * 3,
                'tax_cost' => $taxCost = ($setting->tax_percent / 100) * $priceAfterHours,
                'career_insurance_cost' => $careerInsuranceCost = $setting->career_insurance_cost,
                'add_on_tools_cost' => $addOnToolsCost = $setting->add_on_tools_cost,
                'grand_total' => $priceAfterHours + $taxCost + $careerInsuranceCost + $addOnToolsCost,
                'status' => BookingStatus::STATUS_APPROVED,
            ],
        ];

        foreach ($data as $data) {
            Booking::create($data);
        }
    }
}
