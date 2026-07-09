<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Address;
use App\Models\Homeowners;
use App\Models\Houselots;
use App\Models\Registrations;
use App\Models\Staff;
use App\Models\User;
use App\Models\Membership;
use App\Models\Announcement;
use App\Models\WaterReading;
use App\Models\Billing;
use App\Models\Complaints;
use App\Models\Maintenance;
use App\Models\PaymentMethod;
use App\Models\Payments;

class DashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    

    public function run(): void
    {
        DB::transaction(function () {

            $gcash = PaymentMethod::factory()->create([
                'methodName' => 'GCash',
            ]);

            $cash = PaymentMethod::factory()->create([
                'methodName' => 'Cash',
            ]);

            $staffAddress = Address::factory()->create();

            $staffUser = User::factory()->create([
                'roleID' => 1,
            ]);

            $staff = Staff::factory()->create([
                'userID' => $staffUser->userID,
                'addressID' => $staffAddress->addressID,
            ]);

            Announcement::factory()
                ->count(20)
                ->create([
                    'staffID' => $staff->staffID,
                ]);

            for ($i = 0; $i < 20; $i++) {

                $address = Address::factory()->create();

                $user = User::factory()->create([
                    'roleID' => 2,
                ]);

                $homeowner = Homeowners::factory()->create([
                    'userID' => $user->userID,
                    'addressID' => $address->addressID,
                ]);

                $lot = Houselots::factory()->create([
                    'homeownerID' => $homeowner->homeownerID,
                ]);

                $registration = Registrations::factory()->create([
                    'homeownerID' => $homeowner->homeownerID,
                    'houseLotID' => $lot->houseLotID,
                    'userID' => $user->userID,
                    'staffID' => $staff->staffID,
                ]);

                $membership = Membership::factory()->create([
                    'homeownerID' => $homeowner->homeownerID,
                    'houseLotID' => $lot->houseLotID,
                    'registrationID' => $registration->registrationID,
                ]);

                $reading = WaterReading::factory()->create([
                    'membershipID' => $membership->membershipID,
                    'staffID' => $staff->staffID,
                ]);

                $billing = Billing::factory()->create([
                    'membershipID' => $membership->membershipID,
                    'waterReadingID' => $reading->waterReadingID,
                    'staffID' => $staff->staffID,
                ]);

                $registration->update([
                    'billingID' => $billing->billingID,
                ]);

                Payments::factory()->create([
                    'billingID' => $billing->billingID,
                    'staffID' => $staff->staffID,
                    'paymentMethodID' => fake()->randomElement([
                        $gcash->paymentMethodID,
                        $cash->paymentMethodID,
                    ]),
                ]);

                Complaints::factory()->create([
                    'membershipID' => $membership->membershipID,
                    'staffID' => $staff->staffID,
                ]);

                Maintenance::factory()->create([
                    'membershipID' => $membership->membershipID,
                    'staffID' => $staff->staffID,
                ]);
            }
        });
    }
}