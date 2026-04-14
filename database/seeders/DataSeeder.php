<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // 1. Admins
        $adminIds = [];
        for ($i = 0; $i < 2; $i++) {
            $adminIds[] = DB::table('admins')->insertGetId([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 2. Users
        $userIds = [];
        for ($i = 0; $i < 2; $i++) {
            $userIds[] = DB::table('users')->insertGetId([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'avatar_url' => $faker->imageUrl(),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Campaign Categories
        $categoryIds = [];
        for ($i = 0; $i < 2; $i++) {
            $name = $faker->unique()->word;
            $categoryIds[] = DB::table('campaign_categories')->insertGetId([
                'name' => ucfirst($name),
                'slug' => Str::slug($name),
                'icon_url' => $faker->imageUrl(50, 50),
                'is_active' => true,
                'order_index' => $i,
                'created_at' => now(),
            ]);
        }

        // 4. Tags
        $tagIds = [];
        for ($i = 0; $i < 2; $i++) {
            $name = $faker->unique()->word;
            $tagIds[] = DB::table('tags')->insertGetId([
                'name' => ucfirst($name),
                'slug' => Str::slug($name),
                'created_at' => now(),
            ]);
        }

        // 5. Banners
        $bannerIds = [];
        for ($i = 0; $i < 2; $i++) {
            $bannerIds[] = DB::table('banners')->insertGetId([
                'title' => $faker->sentence,
                'image_url' => $faker->imageUrl(1200, 400),
                'link_url' => $faker->url,
                'is_active' => true,
                'start_at' => now(),
                'end_at' => now()->addMonth(),
                'order_index' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 6. Site Settings
        for ($i = 0; $i < 2; $i++) {
            DB::table('site_settings')->insert([
                'key' => 'setting_' . $faker->unique()->word,
                'value' => $faker->word,
                'type' => 'string',
                'updated_at' => now(),
            ]);
        }

        // 7. FAQs
        for ($i = 0; $i < 2; $i++) {
            DB::table('faqs')->insert([
                'question' => $faker->sentence . '?',
                'answer' => $faker->paragraph,
                'is_active' => true,
                'order_index' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 8. OAuth Accounts
        foreach ($userIds as $userId) {
            DB::table('oauth_accounts')->insert([
                'user_id' => $userId,
                'provider' => 'google',
                'provider_id' => $faker->uuid,
                'access_token' => Str::random(40),
                'refresh_token' => Str::random(40),
                'token_expires_at' => now()->addHour(),
                'created_at' => now(),
            ]);
        }

        // 9. Campaigns
        $campaignIds = [];
        for ($i = 0; $i < 2; $i++) {
            $title = $faker->sentence;
            $campaignIds[] = DB::table('campaigns')->insertGetId([
                'user_id' => $userIds[$i],
                'category_id' => $categoryIds[$i],
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => $faker->paragraph,
                'story' => $faker->paragraphs(3, true),
                'cover_image_url' => $faker->imageUrl(800, 600),
                'goal_amount' => 10000000,
                'collected_amount' => 0,
                'donor_count' => 0,
                'deadline' => now()->addMonths(2)->toDateString(),
                'status' => 'active',
                'verified_status' => 'verified',
                'verified_by' => $adminIds[0],
                'verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 10. Campaign Images
        foreach ($campaignIds as $campaignId) {
            for ($i = 0; $i < 2; $i++) {
                DB::table('campaign_images')->insert([
                    'campaign_id' => $campaignId,
                    'image_url' => $faker->imageUrl(800, 600),
                    'order_index' => $i,
                    'created_at' => now(),
                ]);
            }
        }

        // 11. Campaign Updates
        foreach ($campaignIds as $index => $campaignId) {
            DB::table('campaign_updates')->insert([
                'campaign_id' => $campaignId,
                'user_id' => $userIds[$index],
                'title' => 'Update ' . ($index + 1),
                'content' => $faker->paragraph,
                'image_url' => $faker->imageUrl(800, 600),
                'created_at' => now(),
            ]);
        }

        // 12. Campaign Tags
        foreach ($campaignIds as $campaignId) {
            foreach ($tagIds as $tagId) {
                DB::table('campaign_tags')->insert([
                    'campaign_id' => $campaignId,
                    'tag_id' => $tagId,
                ]);
            }
        }

        // 13. Donations
        $donationIds = [];
        foreach ($campaignIds as $campaignId) {
            $donationIds[] = DB::table('donations')->insertGetId([
                'donation_number' => 'DON-' . strtoupper(Str::random(10)),
                'campaign_id' => $campaignId,
                'user_id' => $userIds[0],
                'amount' => 50000,
                'message' => $faker->sentence,
                'is_anonymous' => false,
                'status' => 'success',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 14. Donation Payments
        foreach ($donationIds as $donationId) {
            DB::table('donation_payments')->insert([
                'donation_id' => $donationId,
                'payment_method' => 'E-Wallet',
                'payment_channel' => 'GOPAY',
                'external_ref' => 'REF-' . strtoupper(Str::random(12)),
                'gross_amount' => 50000,
                'fee_amount' => 1000,
                'net_amount' => 49000,
                'status' => 'paid',
                'paid_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 15. Withdrawals
        foreach ($campaignIds as $index => $campaignId) {
            DB::table('withdrawals')->insert([
                'campaign_id' => $campaignId,
                'user_id' => $userIds[$index],
                'amount' => 1000000,
                'bank_name' => 'BCA',
                'account_number' => '1234567890',
                'account_name' => $faker->name,
                'status' => 'completed',
                'processed_by' => $adminIds[0],
                'transfer_proof_url' => $faker->imageUrl(),
                'processed_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 16. Banner Placements
        foreach ($bannerIds as $bannerId) {
            DB::table('banner_placements')->insert([
                'banner_id' => $bannerId,
                'placement' => 'home_top',
                'created_at' => now(),
            ]);
        }

        // 17. Notifications
        foreach ($userIds as $userId) {
            DB::table('notifications')->insert([
                'user_id' => $userId,
                'type' => 'info',
                'title' => 'Welcome',
                'body' => 'Welcome to the platform!',
                'created_at' => now(),
            ]);
        }
    }
}
