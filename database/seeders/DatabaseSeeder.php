<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::create([
            'site_name' => 'NexusNet',
            'welcome_title' => 'مرحباً بك في NexusNet',
            'welcome_subtitle' => 'منصة تواصل اجتماعي تجمع الأشخاص المميزين، حول اهتمامات مشتركة وأفكار ملهمة',
            'demo_banner_text' => 'وضع المعاينة التجريبي (Portfolio Demo) — تم ملء المنصة ببيانات تجريبية للعرض فقط',
            'quote_text' => '"الأفكار العظيمة لا تأتي من الراحة، بل من الفضول والمثابرة".',
            'quote_author' => 'NexusNet',
            'stat_users' => '1.2K',
            'stat_posts' => '245',
            'stat_groups' => '89',
        ]);

        // Main Profile User: Ali Emad (matching screenshot)
        $ali = User::create([
            'name' => 'Ali Emad',
            'username' => 'aliemad',
            'email' => 'ali@nexusnet.com',
            'password' => Hash::make('password'),
            'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=300&q=80',
            'cover_image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=900&q=80',
            'bio' => 'مطور ويب | أحب التقنية والتعلم المستمر وأؤمن أن الأفكار العظيمة تبدأ من هنا.',
            'role' => 'admin',
            'is_verified' => true,
            'followers_display' => '1.2K',
            'following_display' => '348',
        ]);

        $omar = User::create([
            'name' => 'Omar Hassan',
            'username' => 'omarhassan',
            'email' => 'omar@nexusnet.com',
            'password' => Hash::make('password'),
            'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=300&q=80',
            'cover_image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=900&q=80',
            'bio' => 'مصور طبيعة ورحالة | أشارككم لحظات من حول العالم.',
            'role' => 'user',
            'is_verified' => true,
        ]);

        $sara = User::create([
            'name' => 'Sara Ahmed',
            'username' => 'sarahmed',
            'email' => 'sara@nexusnet.com',
            'password' => Hash::make('password'),
            'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=300&q=80',
            'bio' => 'مصممة واجهات وتجربة مستخدم UI/UX.',
            'role' => 'user',
            'is_verified' => false,
        ]);

        $lina = User::create([
            'name' => 'Lina Khaled',
            'username' => 'linakhaled',
            'email' => 'lina@nexusnet.com',
            'password' => Hash::make('password'),
            'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=300&q=80',
            'bio' => 'Product Designer & Creative Director.',
            'role' => 'user',
            'is_verified' => true,
        ]);

        $youssef = User::create([
            'name' => 'Youssef Gamal',
            'username' => 'youssefgamal',
            'email' => 'youssef@nexusnet.com',
            'password' => Hash::make('password'),
            'avatar' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=300&q=80',
            'bio' => 'مهندس برمجيات ومهتم بالذكاء الاصطناعي.',
            'role' => 'user',
            'is_verified' => false,
        ]);

        $ahmed = User::create([
            'name' => 'Ahmed Tarek',
            'username' => 'ahmedtarek',
            'email' => 'ahmed@nexusnet.com',
            'password' => Hash::make('password'),
            'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=300&q=80',
            'bio' => 'Full-Stack Developer.',
            'role' => 'user',
            'is_verified' => false,
        ]);

        // Post 1: Omar Hassan (Mountain Lake Photo - exact match to screenshot)
        $post1 = Post::create([
            'user_id' => $omar->id,
            'content' => 'الطبيعة دائماً تمنحنا طاقة جديدة. هذه الصورة التقطتها في رحلتي الأخيرة إلى الجبال.',
            'image_url' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=85',
            'time_label' => 'منذ 3 ساعات',
            'base_likes' => 248,
            'base_comments' => 30,
        ]);

        Comment::create([
            'user_id' => $sara->id,
            'post_id' => $post1->id,
            'content' => 'صورة رائعة جداً! للطبيعة لها سحر خاص.',
            'time_label' => 'منذ ساعتين',
            'likes_count' => 12,
        ]);

        Comment::create([
            'user_id' => $ahmed->id,
            'post_id' => $post1->id,
            'content' => 'مكان جميل جداً.. أتمنى أن أزوره قريباً!',
            'time_label' => 'منذ ساعة',
            'likes_count' => 8,
        ]);

        // Post 2: Lina Khaled (UI Design Workspace - exact match to screenshot)
        Post::create([
            'user_id' => $lina->id,
            'content' => 'تصميم جديد أعمل عليه حالياً، ما رأيكم؟',
            'image_url' => 'https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?auto=format&fit=crop&w=1200&q=85',
            'time_label' => 'منذ 5 ساعات',
            'base_likes' => 184,
            'base_comments' => 19,
        ]);
    }
}
