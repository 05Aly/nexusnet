@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8 space-y-6">

    <div class="bg-[#f7f4ef] border border-[#e2dcd3] rounded-[18px] p-6 text-[#1c1917]">
        <div class="flex items-center justify-between border-b border-[#d5d5d5] pb-4 mb-6">
            <div>
                <h1 class="text-lg font-bold text-black">لوحة تحكم المحتوى والمنصة (Admin CMS)</h1>
                <p class="text-[12px] text-[#424242]">يمكنك تعديل نصوص الترحيب، البانر التجريبي، الإحصائيات، والاقتباسات، أو إدارة المنشورات</p>
            </div>
            <a href="{{ route('feed') }}" class="bg-black text-white text-[12px] font-semibold px-4 py-2 rounded-full">
                العودة للرئيسية ←
            </a>
        </div>

        <form method="POST" action="{{ route('admin.settings.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-[13px]">
            @csrf
            <div>
                <label class="block font-semibold mb-1">اسم المنصة</label>
                <input type="text" name="site_name" value="{{ $settings->site_name }}" class="w-full rounded-[8px] border border-[#d5d5d5] bg-white px-3 py-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">عنوان بطاقة الترحيب</label>
                <input type="text" name="welcome_title" value="{{ $settings->welcome_title }}" class="w-full rounded-[8px] border border-[#d5d5d5] bg-white px-3 py-2">
            </div>
            <div class="md:col-span-2">
                <label class="block font-semibold mb-1">نص شريط التنبيه التجريبي (Demo Banner)</label>
                <input type="text" name="demo_banner_text" value="{{ $settings->demo_banner_text }}" class="w-full rounded-[8px] border border-[#d5d5d5] bg-white px-3 py-2">
            </div>
            <div class="md:col-span-2">
                <label class="block font-semibold mb-1">وصف بطاقة الترحيب</label>
                <textarea name="welcome_subtitle" rows="2" class="w-full rounded-[8px] border border-[#d5d5d5] bg-white px-3 py-2">{{ $settings->welcome_subtitle }}</textarea>
            </div>
            <div>
                <label class="block font-semibold mb-1">اقتباس اليوم</label>
                <input type="text" name="quote_text" value="{{ $settings->quote_text }}" class="w-full rounded-[8px] border border-[#d5d5d5] bg-white px-3 py-2">
            </div>
            <div class="grid grid-cols-3 gap-2">
                <div>
                    <label class="block font-semibold mb-1">المستخدمين</label>
                    <input type="text" name="stat_users" value="{{ $settings->stat_users }}" class="w-full rounded-[8px] border border-[#d5d5d5] bg-white px-3 py-2">
                </div>
                <div>
                    <label class="block font-semibold mb-1">المنشورات</label>
                    <input type="text" name="stat_posts" value="{{ $settings->stat_posts }}" class="w-full rounded-[8px] border border-[#d5d5d5] bg-white px-3 py-2">
                </div>
                <div>
                    <label class="block font-semibold mb-1">المجموعات</label>
                    <input type="text" name="stat_groups" value="{{ $settings->stat_groups }}" class="w-full rounded-[8px] border border-[#d5d5d5] bg-white px-3 py-2">
                </div>
            </div>
            <div class="md:col-span-2 pt-2">
                <button type="submit" class="bg-[#c85a32] hover:bg-[#b24d28] text-white font-semibold px-6 py-2.5 rounded-full transition">
                    حفظ التعديلات فوراً
                </button>
            </div>
        </form>
    </div>

    <!-- Posts Management -->
    <div class="bg-[#f7f4ef] border border-[#e2dcd3] rounded-[18px] p-6 text-[#1c1917]">
        <h2 class="text-base font-bold text-black mb-4">إدارة المنشورات الحالية ({{ $posts->count() }})</h2>
        <div class="space-y-2.5">
            @foreach($posts as $post)
            <div class="flex items-center justify-between bg-white p-3 rounded-[8px] border border-[#d5d5d5] text-[13px]">
                <div>
                    <span class="font-bold text-black">{{ $post->user->name }}:</span>
                    <span class="text-[#424242]">{{ Str::limit($post->content, 80) }}</span>
                </div>
                <form method="POST" action="{{ route('admin.posts.delete', $post) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 font-semibold hover:underline text-[12px]">حذف المنشور</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
