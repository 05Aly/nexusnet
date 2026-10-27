<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();
        $posts = Post::with('user')->latest()->get();
        $users = User::latest()->get();

        return view('admin.index', compact('settings', 'posts', 'users'));
    }

    public function updateSettings(Request $request)
    {
        $settings = SiteSetting::first();
        $settings->update($request->only([
            'site_name',
            'welcome_title',
            'welcome_subtitle',
            'demo_banner_text',
            'quote_text',
            'quote_author',
            'stat_users',
            'stat_posts',
            'stat_groups',
        ]));

        return back()->with('success', 'تم حفظ إعدادات ومحتوى الموقع بنجاح.');
    }

    public function deletePost(Post $post)
    {
        $post->delete();
        return back()->with('success', 'تم حذف المنشور.');
    }

    public function toggleVerify(User $user)
    {
        $user->is_verified = !$user->is_verified;
        $user->save();
        return back()->with('success', 'تم تحديث حالة التوثيق للمستخدم.');
    }
}
