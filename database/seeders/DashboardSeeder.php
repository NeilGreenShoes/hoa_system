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
            
            // --- 1. CREATE ADDRESSES ---
            $address1 = Address::create([
                'street'   => '123 Mahogany St',
                'barangay' => 'San Isidro',
                'city'     => 'Davao City',
                'province' => 'Davao del Sur',
            ]);

            $address2 = Address::create([
                'street'   => '456 Narra Ave',
                'barangay' => 'Central',
                'city'     => 'Davao City',
                'province' => 'Davao del Sur',
            ]);

            $address3 = Address::create([
                'street'   => '789 Apitong St',
                'barangay' => 'San Isidro',
                'city'     => 'Davao City',
                'province' => 'Davao del Sur',
            ]);


            // --- 2. CREATE USERS ---
            $userHomeowner1 = User::create([
                'loginEmail'  => 'johndoe@example.com',
                'password'    => Hash::make('password123'),
                'status'      => 'Active',
                'isLoggedIn'  => false,
                'lastSession' => null,
                'roleID'      => 2,
            ]);

            $userHomeowner2 = User::create([
                'loginEmail'  => 'alicesmith@example.com',
                'password'    => Hash::make('password123'),
                'status'      => 'Active',
                'isLoggedIn'  => false,
                'lastSession' => null,
                'roleID'      => 2,
            ]);

            $userStaff = User::create([
                'loginEmail'  => 'janesmith@example.com',
                'password'    => Hash::make('password123'),
                'status'      => 'Active',
                'isLoggedIn'  => false,
                'lastSession' => null,
                'roleID'      => 1,
            ]);


            // --- 3. CREATE STAFF ---
            $staff = Staff::create([
                'lastname'      => 'Smith',
                'firstname'     => 'Jane',
                'middlename'    => 'Marie',
                'dateOfBirth'   => '1990-05-15',
                'gender'        => 'Female',
                'maritalStatus' => 'Single',
                'contactNumber' => '09123456789',
                'email'         => 'janesmith@example.com',
                'profileImage'  => 'profiles/staff_jane.jpg',
                'userID'        => $userStaff->userID, 
                'addressID'     => $address2->addressID,
            ]);


            // --- 4. CREATE HOMEOWNERS ---
            $homeowner1 = Homeowners::create([
                'firstName'     => 'John',
                'middleName'    => 'David',
                'lastName'      => 'Doe',
                'dateOfBirth'   => '1985-11-23',
                'gender'        => 'Male',
                'religion'      => 'Christian',
                'maritalStatus' => 'Married',
                'contactNumber' => '09987654321',
                'email'         => 'johndoe@example.com',
                'profileImage'  => 'profiles/homeowner_john.jpg',
                'userID'        => $userHomeowner1->userID, 
                'addressID'     => $address1->addressID,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            $homeowner2 = Homeowners::create([
                'firstName'     => 'Alice',
                'middleName'    => 'Grace',
                'lastName'      => 'Smith',
                'dateOfBirth'   => '1992-02-14',
                'gender'        => 'Female',
                'religion'      => 'Catholic',
                'maritalStatus' => 'Single',
                'contactNumber' => '09171234567',
                'email'         => 'alicesmith@example.com',
                'profileImage'  => 'profiles/homeowner_alice.jpg',
                'userID'        => $userHomeowner2->userID, 
                'addressID'     => $address3->addressID,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);


            // --- 5. CREATE HOUSELOTS ---
            $houseLot1 = Houselots::create([
                'lotNumber'        => 14,
                'blockNumber'      => 5,
                'homeownerID'      => $homeowner1->homeownerID,
                'occupancyStatus'  => 'Occupied',
                'lastVerifiedDate' => now()->toDateString(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            $houseLot2 = Houselots::create([
                'lotNumber'        => 22,
                'blockNumber'      => 3,
                'homeownerID'      => $homeowner2->homeownerID,
                'occupancyStatus'  => 'Occupied',
                'lastVerifiedDate' => now()->toDateString(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);


            // --- 6. CREATE REGISTRATIONS ---
            $registration1 = Registrations::create([
                'registrationType' => 'Online',
                'membershipFee'    => 1500.00,
                'validIDImage'     => 'documents/ids/john_id.jpg',
                'lotDocument'      => 'documents/lots/john_land_title.pdf',
                'registrationDate' => now()->toDateString(),
                'status'           => 'Approved', 
                'remark'           => 'Documents verified by HOA staff.',
                'homeownerID'      => $homeowner1->homeownerID,
                'houseLotID'       => $houseLot1->houseLotID,
                'userID'           => $userHomeowner1->userID, 
                'staffID'          => $staff->staffID,     
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            $registration2 = Registrations::create([
                'registrationType' => 'Walk-in',
                'membershipFee'    => 1500.00,
                'validIDImage'     => 'documents/ids/alice_id.jpg',
                'lotDocument'      => 'documents/lots/alice_land_title.pdf',
                'registrationDate' => now()->subDays(5)->toDateString(),
                'status'           => 'Approved', 
                'remark'           => 'Walk-in processing complete.',
                'homeownerID'      => $homeowner2->homeownerID,
                'houseLotID'       => $houseLot2->houseLotID,
                'userID'           => $userHomeowner2->userID, 
                'staffID'          => $staff->staffID,     
                'created_at'       => now()->subDays(5),
                'updated_at'       => now()->subDays(5),
            ]);


            // --- 7. CREATE MEMBERSHIPS ---
            $membership1 = Membership::create([
                'membershipStartDate' => now()->toDateString(),
                'memberShipEndDate'   => null, 
                'status'              => 'Active',
                'homeownerID'         => $homeowner1->homeownerID,
                'houseLotID'          => $houseLot1->houseLotID,
                'registrationID'      => $registration1->registrationID,
            ]);

            $membership2 = Membership::create([
                'membershipStartDate' => now()->subDays(5)->toDateString(),
                'memberShipEndDate'   => null, 
                'status'              => 'Active',
                'homeownerID'         => $homeowner2->homeownerID,
                'houseLotID'          => $houseLot2->houseLotID,
                'registrationID'      => $registration2->registrationID,
            ]);


            // --- 8. CREATE ANNOUNCEMENTS ---
            Announcement::create([
                'title'           => 'Monthly General Assembly Meeting',
                'description'     => 'All homeowners are invited to attend our assembly on Saturday at the community clubhouse.',
                'targetType'      => 'All',
                'targetReference' => 'General',
                'datePosted'      => now()->toDateString(),
                'staffID'         => $staff->staffID,
            ]);

            Announcement::create([
                'title'           => 'Scheduled Scheduled Water Maintenance Interruption',
                'description'     => 'Water services will be down temporarily from 1:00 PM to 4:00 PM for pipe adjustments.',
                'targetType'      => 'Block',
                'targetReference' => 'Block 5',
                'datePosted'      => now()->toDateString(),
                'staffID'         => $staff->staffID,
            ]);


            // --- 9. CREATE WATER READINGS ---
            $waterReading1 = WaterReading::create([
                'previousReading' => 120.00,
                'currentReading'  => 145.00,
                'consumption'     => 25.00,
                'readingImage'    => 'readings/meter_john.jpg',
                'readingDate'     => now()->toDateString(),
                'amount'          => 375.00,
                'membershipID'    => $membership1->membershipID,
                'staffID'         => $staff->staffID,
            ]);

            $waterReading2 = WaterReading::create([
                'previousReading' => 85.00,
                'currentReading'  => 105.00,
                'consumption'     => 20.00,
                'readingImage'    => 'readings/meter_alice.jpg',
                'readingDate'     => now()->toDateString(),
                'amount'          => 300.00,
                'membershipID'    => $membership2->membershipID,
                'staffID'         => $staff->staffID,
            ]);


            // --- 10. CREATE BILLINGS ---
            $billing1 = Billing::create([
                'billingDate'            => now()->toDateString(),
                'dueDate'                => now()->addDays(15)->toDateString(),
                'monthlyDue'             => 500.00,
                'securityFee'            => 200.00,
                'penaltyFee'             => 0.00,
                'reconnectionFee'        => 0.00,
                'arrears'                => 0.00,
                'totalAmount'            => 1075.00, 
                'status'                 => 'Pending',
                'seniorDiscountEligible' => false,
                'waterReadingID'         => $waterReading1->waterReadingID,
                'membershipID'           => $membership1->membershipID,
                'staffID'                => $staff->staffID,
            ]);

            $billing2 = Billing::create([
                'billingDate'            => now()->toDateString(),
                'dueDate'                => now()->addDays(15)->toDateString(),
                'monthlyDue'             => 500.00,
                'securityFee'            => 200.00,
                'penaltyFee'             => 0.00,
                'reconnectionFee'        => 0.00,
                'arrears'                => 0.00,
                'totalAmount'            => 1000.00, 
                'status'                 => 'Paid', // This one will show up as completely settled
                'seniorDiscountEligible' => false,
                'waterReadingID'         => $waterReading2->waterReadingID,
                'membershipID'           => $membership2->membershipID,
                'staffID'                => $staff->staffID,
            ]);


            // --- 11. CREATE COMPLAINTS ---
            // FIXED: Changed securityLevel array key property name to severityLevel 
            Complaints::create([
                'title'         => 'Streetlight Malfunction',
                'category'      => 'Facilities',
                'description'   => 'The streetlight near Block 5 Lot 14 has been blinking constantly.',
                'attachedFile'  => 'complaints/streetlight.jpg',
                'severityLevel' => 'Low',
                'submitDate'    => now()->toDateString(),
                'status'        => 'Pending',
                'membershipID'  => $membership1->membershipID,
                'staffID'       => $staff->staffID,
            ]);

            Complaints::create([
                'title'         => 'Stray Dog Threat',
                'category'      => 'Safety',
                'description'   => 'Pack of aggressive stray dogs loitering around the Block 3 playground area.',
                'attachedFile'  => 'complaints/dogs.jpg',
                'severityLevel' => 'High',
                'submitDate'    => now()->subDays(2)->toDateString(),
                'status'        => 'Pending',
                'membershipID'  => $membership2->membershipID,
                'staffID'       => $staff->staffID,
            ]);


            // --- 12. CREATE MAINTENANCE REQUESTS ---
            Maintenance::create([
                'title'        => 'Clubhouse Gutter Repair',
                'category'     => 'Public Properties',
                'description'  => 'The main gutter system on the right side of the clubhouse is detached.',
                'attachedFile' => 'maintenance/gutter_issue.jpg',
                'requestDate'  => now()->toDateString(),
                'status'       => 'Pending',
                'membershipID' => $membership1->membershipID,
                'staffID'      => $staff->staffID,
            ]);

            Maintenance::create([
                'title'        => 'Drainage Unclogging',
                'category'     => 'Sewage',
                'description'  => 'Main drainage pipeline on street corner is overflowing with storm mud.',
                'attachedFile' => 'maintenance/drainage.jpg',
                'requestDate'  => now()->subDays(1)->toDateString(),
                'status'       => 'Pending',
                'membershipID' => $membership2->membershipID,
                'staffID'      => $staff->staffID,
            ]);


            // --- 13. CREATE PAYMENT METHODS ---
            // Explicit ID mapping to fix the downstream "cannot be null" constraint error
            $gcashMethodId = DB::table('payment_methods')->insertGetId([
                'methodName' => 'GCash',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $cashMethodId = DB::table('payment_methods')->insertGetId([
                'methodName' => 'Cash',
                'created_at' => now(),
                'updated_at' => now()
            ]);


            // --- 14. CREATE PAYMENTS ---
            // Payment for Billing 1 (Partial payment entry)
            Payments::create([
                'amount'          => 500.00,
                'discount'        => 0.00,
                'paymentDate'     => now()->toDateString(),
                'paymentMethodID' => $gcashMethodId,
                'billingID'       => $billing1->billingID,
                'staffID'         => $staff->staffID,
            ]);

            // Payment for Billing 2 (Full settlement entry)
            Payments::create([
                'amount'          => 1000.00,
                'discount'        => 0.00,
                'paymentDate'     => now()->toDateString(),
                'paymentMethodID' => $cashMethodId,
                'billingID'       => $billing2->billingID,
                'staffID'         => $staff->staffID,
            ]);

        });
    }
}