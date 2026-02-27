<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Category;
use App\Models\Department;
use App\Models\Employee;
use App\Models\QuickLink;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'IT'],
            ['name' => 'HR'],
            ['name' => 'Finance'],
            ['name' => 'Management'],
            ['name' => 'Program'],
            ['name' => 'Operations'],
        ];
        foreach ($departments as $d) {
            Department::create($d);
        }

        $categories = [
            ['name' => 'IT Documents', 'slug' => 'it-documents', 'parent_id' => null],
            ['name' => 'Operational Documents', 'slug' => 'operational', 'parent_id' => null],
            ['name' => 'HR', 'slug' => 'operational-hr', 'parent_id' => 2],
            ['name' => 'Finance', 'slug' => 'operational-finance', 'parent_id' => 2],
            ['name' => 'Management', 'slug' => 'operational-management', 'parent_id' => 2],
            ['name' => 'Program & Strategy Documents', 'slug' => 'program-strategy', 'parent_id' => null],
            ['name' => 'Projects', 'slug' => 'program-projects', 'parent_id' => 6],
            ['name' => 'M&E', 'slug' => 'program-me', 'parent_id' => 6],
            ['name' => 'Strategic Documents', 'slug' => 'strategic', 'parent_id' => null],
            ['name' => 'Announcements', 'slug' => 'announcements', 'parent_id' => null],
        ];
        foreach ($categories as $c) {
            Category::create($c);
        }

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'department_id' => 1,
            'status' => 'active',
        ]);

        Employee::create([
            'name' => 'Admin User',
            'position' => 'System Administrator',
            'department_id' => 1,
            'phone' => '+1234567890',
            'email' => 'admin@example.com',
            'office_location' => 'HQ - Floor 1',
            'status' => 'active',
        ]);

        Employee::create([
            'name' => 'John Doe',
            'position' => 'HR Manager',
            'department_id' => 2,
            'phone' => '+1234567891',
            'email' => 'john@example.com',
            'office_location' => 'HQ - Floor 2',
            'status' => 'active',
        ]);

        Employee::create([
            'name' => 'Jane Smith',
            'position' => 'Finance Officer',
            'department_id' => 3,
            'phone' => '+1234567892',
            'email' => 'jane@example.com',
            'office_location' => 'HQ - Floor 2',
            'status' => 'active',
        ]);

        QuickLink::create(['title' => 'HR Forms', 'url' => '#', 'category' => 'Internal', 'sort_order' => 1]);
        QuickLink::create(['title' => 'Finance Templates', 'url' => '#', 'category' => 'Internal', 'sort_order' => 2]);
        QuickLink::create(['title' => 'IT Support', 'url' => '#', 'category' => 'Internal', 'sort_order' => 3]);

        Announcement::create([
            'title' => 'Welcome to Inclusive Growth Portal',
            'content' => 'This is the internal portal for document management, employee directory, and quick links. Explore the navigation to get started.',
            'posted_by' => $admin->id,
            'expiry_date' => now()->addDays(30),
        ]);
    }
}
