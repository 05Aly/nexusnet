<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            $defaultUser = User::where('username', 'aliemad')->first() ?? User::first();
            if ($defaultUser) {
                Auth::login($defaultUser);
            }
        }

        $query = Post::with(['user', 'comments.user', 'likes'])->latest();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where('content', 'like', "%{$search}%");
        }

        $posts = $query->get();

        $suggestedUsers = User::where('id', '!=', Auth::id())
            ->where('is_banned', false)
            ->take(4)
            ->get();

        $settings = SiteSetting::first();

        $popularTags = [
            ['tag' => '#الذكاء_الاصطناعي', 'count' => 'منشور 12.4K', 'img' => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?auto=format&fit=crop&w=160&q=80'],
            ['tag' => '#الطبيعة_والسفر', 'count' => 'منشور 8.7K', 'img' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=160&q=80'],
            ['tag' => '#تصميم_الواجهات', 'count' => 'منشور 6.1K', 'img' => 'https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?auto=format&fit=crop&w=160&q=80'],
            ['tag' => '#تطوير_الذات', 'count' => 'منشور 5.3K', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=160&q=80'],
            ['tag' => '#تقنية', 'count' => 'منشور 5.3K', 'img' => null],
            ['tag' => '#الحياة_الجامعية', 'count' => 'منشور 4.4K', 'img' => null],
        ];

        return view('feed.index', compact('posts', 'suggestedUsers', 'settings', 'popularTags'));
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1500',
            'image_url' => 'nullable|url',
        ]);

        Auth::user()->posts()->create([
            'content' => $request->content,
            'image_url' => $request->image_url,
            'time_label' => 'الآن',
            'base_likes' => 0,
            'base_comments' => 0,
        ]);

        return back()->with('success', 'تم نشر منشورك بنجاح.');
    }

    public function toggleLike(Post $post)
    {
        $like = $post->likes()->where('user_id', Auth::id())->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            $post->likes()->create(['user_id' => Auth::id()]);
            $liked = true;
        }

        if (request()->wantsJson()) {
            return response()->json([
                'liked' => $liked,
                'likes_count' => $post->totalLikesCount(),
            ]);
        }

        return back();
    }

    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'time_label' => 'الآن',
            'likes_count' => 1,
        ]);

        return back()->with('success', 'تم إضافة تعليقك.');
    }

    public function toggleFollow(User $user)
    {
        $me = Auth::user();
        if ($me->id !== $user->id) {
            if ($me->isFollowing($user)) {
                $me->following()->detach($user->id);
            } else {
                $me->following()->attach($user->id);
            }
        }
        return back();
    }
}
