<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Category;
use App\Models\Company;
use App\Models\Cv;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Quản trị viên CareerLink',
            'email' => 'admin@topcv.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        $candidate = User::create([
            'name' => 'Nguyễn Văn Ứng Viên',
            'email' => 'candidate@topcv.test',
            'password' => Hash::make('password'),
            'role' => 'candidate',
            'status' => 'active',
        ]);

        $employer = User::create([
            'name' => 'Trần Thị Tuyển Dụng',
            'email' => 'employer@topcv.test',
            'password' => Hash::make('password'),
            'role' => 'employer',
            'status' => 'active',
        ]);

        $categories = collect(['Công nghệ thông tin', 'Marketing', 'Kế toán', 'Nhân sự', 'Kinh doanh'])
            ->mapWithKeys(fn ($name) => [$name => Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ])]);

        $company = Company::create([
            'user_id' => $employer->id,
            'name' => 'Laravel Talent Việt Nam',
            'description' => 'Công ty phát triển sản phẩm web và tuyển dụng nhân sự công nghệ. Đội ngũ tập trung vào Laravel, hệ thống nội bộ và các sản phẩm SaaS cho doanh nghiệp.',
            'address' => 'Quận 1, TP. Hồ Chí Minh',
            'website' => 'https://example.com',
            'size' => '50-100 nhân viên',
            'status' => 'active',
        ]);

        $jobs = collect([
            ['Lập trình viên Laravel', 'Công nghệ thông tin', 'full-time', 'TP. Hồ Chí Minh'],
            ['Lập trình viên Frontend', 'Công nghệ thông tin', 'remote', 'Làm việc từ xa'],
            ['Chuyên viên Digital Marketing', 'Marketing', 'full-time', 'Hà Nội'],
            ['Nhân viên Kinh doanh', 'Kinh doanh', 'part-time', 'Đà Nẵng'],
        ])->map(function ($item) use ($company, $categories) {
            return Job::create([
                'company_id' => $company->id,
                'category_id' => $categories[$item[1]]->id,
                'title' => $item[0],
                'description' => 'Tham gia phát triển sản phẩm, phối hợp với đội ngũ thiết kế - kiểm thử và đảm bảo tiến độ công việc.',
                'requirements' => 'Có kiến thức nền tảng, tinh thần học hỏi, khả năng làm việc nhóm và tư duy giải quyết vấn đề.',
                'benefits' => 'Lương cạnh tranh, môi trường rõ ràng, được mentor và có cơ hội phát triển nghề nghiệp.',
                'salary_min' => 12000000,
                'salary_max' => 25000000,
                'location' => $item[3],
                'working_type' => $item[2],
                'experience_level' => '1-3 năm',
                'deadline' => now()->addMonth(),
                'status' => 'active',
            ]);
        });

        $cv = Cv::create([
            'user_id' => $candidate->id,
            'title' => 'CV Laravel Developer',
            'type' => 'online',
            'full_name' => $candidate->name,
            'email' => $candidate->email,
            'phone' => '0900000000',
            'address' => 'TP HCM',
            'objective' => 'Trở thành lập trình viên Laravel có khả năng xây dựng sản phẩm hoàn chỉnh.',
            'education' => ['Đại học Công nghệ thông tin - Kỹ sư phần mềm'],
            'experience' => ['1 năm xây dựng ứng dụng Laravel và MySQL'],
            'skills' => ['PHP', 'Laravel', 'MySQL', 'HTML/CSS'],
            'projects' => ['TopCV Mini - hệ thống tuyển dụng nội bộ'],
        ]);

        Application::create([
            'job_id' => $jobs->first()->id,
            'user_id' => $candidate->id,
            'cv_id' => $cv->id,
            'cover_letter' => 'Tôi quan tâm vị trí này và mong muốn được trao đổi thêm.',
            'status' => 'pending',
        ]);
    }
}
