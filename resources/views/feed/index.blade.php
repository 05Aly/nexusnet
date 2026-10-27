@extends('layouts.app')

@section('content')
<div class="max-w-[1440px] mx-auto px-3 lg:px-5 py-4">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-start">

        <!-- COLUMN 1 (Far Left in Screenshot / Navigation Sidebar) -->
        <aside :class="mode === 'threads_paper' ? 'bg-white border border-[#d5d5d5] text-black' : 'bg-[#161412] border border-[#262320] text-zinc-200'"
               class="lg:col-span-2 rounded-[18px] p-3 flex flex-col justify-between min-h-[680px] sticky top-18" dir="rtl">

            <div class="space-y-1">
                <a href="{{ route('feed') }}"
                   :class="mode === 'threads_paper' ? 'bg-[#efefef] text-black font-semibold' : 'bg-[#c85a32] text-white font-semibold'"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-[12px] text-[14px] transition">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    <span>الرئيسية</span>
                </a>

                <a href="{{ route('feed') }}?q="
                   :class="mode === 'threads_paper' ? 'hover:bg-[#efefef] text-black' : 'hover:bg-[#221f1c] text-zinc-300'"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-[12px] text-[14px] transition">
                    <i data-lucide="search" class="w-4 h-4"></i>
                    <span>استكشاف</span>
                </a>

                <a href="#messages"
                   :class="mode === 'threads_paper' ? 'hover:bg-[#efefef] text-black' : 'hover:bg-[#221f1c] text-zinc-300'"
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-[12px] text-[14px] transition">
                    <div class="flex items-center gap-3">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                        <span>الرسائل</span>
                    </div>
                    <span :class="mode === 'threads_paper' ? 'bg-black text-white' : 'bg-[#c85a32] text-white'"
                          class="text-[11px] font-bold px-2 py-0.5 rounded-full">3</span>
                </a>

                <a href="#notifications"
                   :class="mode === 'threads_paper' ? 'hover:bg-[#efefef] text-black' : 'hover:bg-[#221f1c] text-zinc-300'"
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-[12px] text-[14px] transition">
                    <div class="flex items-center gap-3">
                        <i data-lucide="bell" class="w-4 h-4"></i>
                        <span>الإشعارات</span>
                    </div>
                    <span :class="mode === 'threads_paper' ? 'bg-black text-white' : 'bg-[#c85a32] text-white'"
                          class="text-[11px] font-bold px-2 py-0.5 rounded-full">5</span>
                </a>

                <a href="#profile-card"
                   :class="mode === 'threads_paper' ? 'hover:bg-[#efefef] text-black' : 'hover:bg-[#221f1c] text-zinc-300'"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-[12px] text-[14px] transition">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    <span>الملف الشخصي</span>
                </a>

                <a href="#groups"
                   :class="mode === 'threads_paper' ? 'hover:bg-[#efefef] text-black' : 'hover:bg-[#221f1c] text-zinc-300'"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-[12px] text-[14px] transition">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    <span>المجموعات</span>
                </a>

                <a href="#bookmarks"
                   :class="mode === 'threads_paper' ? 'hover:bg-[#efefef] text-black' : 'hover:bg-[#221f1c] text-zinc-300'"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-[12px] text-[14px] transition">
                    <i data-lucide="star" class="w-4 h-4"></i>
                    <span>المفضلات</span>
                </a>

                <a href="#memories"
                   :class="mode === 'threads_paper' ? 'hover:bg-[#efefef] text-black' : 'hover:bg-[#221f1c] text-zinc-300'"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-[12px] text-[14px] transition">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                    <span>الذكريات</span>
                </a>

                <div class="my-3 border-t" :class="mode === 'threads_paper' ? 'border-[#d5d5d5]' : 'border-[#262320]'"></div>

                <a href="{{ route('admin.index') }}"
                   :class="mode === 'threads_paper' ? 'hover:bg-[#efefef] text-black' : 'hover:bg-[#221f1c] text-zinc-300'"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-[12px] text-[14px] transition">
                    <i data-lucide="settings" class="w-4 h-4"></i>
                    <span>الإعدادات (الأدمن)</span>
                </a>
            </div>

            <!-- Bottom Brand Stamp -->
            <div class="pt-6 pb-2 text-center border-t" :class="mode === 'threads_paper' ? 'border-[#d5d5d5]' : 'border-[#262320]'">
                <div class="font-bold text-sm mb-0.5">NexusNet</div>
                <div class="text-[11px] text-[#969696]" dir="ltr">Connect • Share • Grow</div>
            </div>
        </aside>

        <!-- MAIN 10 COLUMNS AREA (With Top Demo Banner inside, matching Screenshot) -->
        <div class="lg:col-span-10 space-y-4">

            <!-- Portfolio Demo Notice Banner (Exact match to Screenshot top bar) -->
            <div x-show="showDemoBanner"
                 :class="mode === 'threads_paper' ? 'bg-white border border-[#d5d5d5] text-black' : 'bg-[#f7f4ef] border border-[#e2dcd3] text-[#1c1917]'"
                 class="rounded-[14px] px-4 py-2.5 flex items-center justify-between text-[13px]">
                <div class="flex items-center gap-2 font-medium">
                    <i data-lucide="info" class="w-4 h-4 text-[#3b7a75]"></i>
                    <span>{{ $settings->demo_banner_text }}</span>
                </div>
                <button @click="showDemoBanner = false" class="text-[#969696] hover:text-black">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            @if(session('success'))
            <div class="bg-[#eef6f5] border border-[#3b7a75] text-[#1c1917] px-4 py-2.5 rounded-[12px] text-[13px] font-semibold">
                {{ session('success') }}
            </div>
            @endif

            <!-- 3-Column Inner Grid: Profile/Suggestions + Center Feed + Right Welcome/Trends -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-start">

                <!-- LEFT INNER COLUMN: User Profile Card + Suggested Friends + Popular Hashtags -->
                <div class="lg:col-span-3 space-y-4" id="profile-card">

                    <!-- Ali Emad Profile Card -->
                    <div :class="mode === 'threads_paper' ? 'bg-white border-[#d5d5d5]' : 'bg-[#f7f4ef] border-[#e2dcd3]'"
                         class="rounded-[18px] border overflow-hidden">
                        <img src="{{ Auth::user()->cover_image }}" alt="Cover" class="w-full h-24 object-cover">
                        <div class="px-4 pb-4 text-center -mt-9">
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"
                                 class="w-16 h-16 rounded-full mx-auto object-cover border-2 border-white">
                            <h2 class="text-[15px] font-bold text-black mt-2" dir="ltr">{{ Auth::user()->name }}</h2>
                            <p class="text-[12px] text-[#969696]" dir="ltr">@<span>{{ Auth::user()->username }}</span></p>
                            <p class="text-[12px] text-[#424242] mt-2 leading-relaxed">
                                {{ Auth::user()->bio }}
                            </p>

                            <!-- Stats Row -->
                            <div class="grid grid-cols-3 gap-2 my-3.5 pt-3 border-t border-[#d5d5d5]/70 text-center">
                                <div>
                                    <span class="block text-[14px] font-bold text-black">{{ Auth::user()->following_display }}</span>
                                    <span class="text-[11px] text-[#969696]">متابع</span>
                                </div>
                                <div>
                                    <span class="block text-[14px] font-bold text-black">{{ Auth::user()->followers_display }}</span>
                                    <span class="text-[11px] text-[#969696]">متابعين</span>
                                </div>
                                <div>
                                    <span class="block text-[14px] font-bold text-black">12</span>
                                    <span class="text-[11px] text-[#969696]">منشورات</span>
                                </div>
                            </div>

                            <a href="{{ route('admin.index') }}"
                               class="block w-full py-2 rounded-full border border-[#d5d5d5] text-[12px] font-semibold text-black hover:bg-[#efefef] transition">
                                تعديل الملف الشخصي
                            </a>
                        </div>
                    </div>

                    <!-- Suggested Friends Card -->
                    <div :class="mode === 'threads_paper' ? 'bg-white border-[#d5d5d5]' : 'bg-[#f7f4ef] border-[#e2dcd3]'"
                         class="rounded-[18px] border p-4">
                        <h3 class="text-[13px] font-bold text-black mb-3">أصدقاء مقترحون للمتابعة</h3>
                        <div class="space-y-3">
                            @foreach($suggestedUsers as $sUser)
                            <div class="flex items-center justify-between gap-2">
                                <form method="POST" action="{{ route('users.follow', $sUser) }}">
                                    @csrf
                                    <button type="submit"
                                            :class="mode === 'threads_paper'
                                                ? 'border border-[#0095f6] text-[#0095f6] hover:bg-[#0095f6] hover:text-white rounded-full'
                                                : 'bg-[#3b7a75] hover:bg-[#2f635f] text-white rounded-[8px]'"
                                            class="px-3 py-1 text-[12px] font-semibold transition">
                                        {{ Auth::user()->isFollowing($sUser) ? 'متابَع' : 'متابعة' }}
                                    </button>
                                </form>
                                <div class="flex items-center gap-2.5 text-left" dir="ltr">
                                    <img src="{{ $sUser->avatar }}" class="w-8 h-8 rounded-full object-cover border border-[#d5d5d5]">
                                    <div>
                                        <div class="text-[13px] font-semibold text-black leading-tight">{{ $sUser->name }}</div>
                                        <div class="text-[11px] text-[#969696]">@<span>{{ $sUser->username }}</span></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Trending Hashtags List -->
                    <div :class="mode === 'threads_paper' ? 'bg-white border-[#d5d5d5]' : 'bg-[#f7f4ef] border-[#e2dcd3]'"
                         class="rounded-[18px] border p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-[13px] font-bold text-black">المواضيع الشائعة</h3>
                            <i data-lucide="flame" class="w-4 h-4 text-[#c85a32]"></i>
                        </div>
                        <div class="space-y-2.5">
                            @foreach($popularTags as $item)
                            <div class="flex items-center justify-between text-[12px]">
                                <span class="text-[#3b7a75] font-bold">#</span>
                                <div class="text-right">
                                    <div class="font-semibold text-black">{{ $item['tag'] }}</div>
                                    <div class="text-[11px] text-[#969696]">{{ $item['count'] }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- CENTER FEED COLUMN (Max-width ~600px aesthetic from DESIGN.md + Screenshot) -->
                <main class="lg:col-span-6 space-y-4">

                    <!-- Compose Post Box -->
                    <div :class="mode === 'threads_paper' ? 'bg-white border-[#d5d5d5]' : 'bg-[#f7f4ef] border-[#e2dcd3]'"
                         class="rounded-[18px] border p-4" x-data="{ showImageInput: false }">
                        <form method="POST" action="{{ route('posts.store') }}" class="space-y-3">
                            @csrf
                            <div class="flex items-center gap-3">
                                <img src="{{ Auth::user()->avatar }}" class="w-10 h-10 rounded-full object-cover border border-[#d5d5d5]">
                                <input type="text" name="content" required placeholder="ماذا تريد أن تشارك اليوم؟"
                                       :class="mode === 'threads_paper' ? 'bg-[#fafafa] border-[#d5d5d5]' : 'bg-[#efeae2] border-[#e0d9ce]'"
                                       class="w-full rounded-full px-4 py-2.5 text-[14px] text-black placeholder-[#969696] border outline-none">
                            </div>

                            <div x-show="showImageInput" class="pt-1">
                                <input type="url" name="image_url" placeholder="أدخل رابط الصورة (https://...)"
                                       class="w-full rounded-[8px] border border-[#d5d5d5] bg-white px-3 py-1.5 text-[13px] text-black outline-none" dir="ltr">
                            </div>

                            <div class="flex items-center justify-between pt-2 border-t border-[#d5d5d5]/60">
                                <button type="submit"
                                        :class="mode === 'threads_paper' ? 'bg-black text-white rounded-full' : 'bg-[#c85a32] hover:bg-[#b24d28] text-white rounded-[10px]'"
                                        class="px-5 py-1.5 text-[13px] font-semibold flex items-center gap-1.5 transition">
                                    <i data-lucide="send" class="w-3.5 h-3.5"></i>
                                    <span>نشر</span>
                                </button>

                                <div class="flex items-center gap-4 text-[13px] text-[#424242] font-medium">
                                    <button type="button" @click="showImageInput = !showImageInput" class="flex items-center gap-1.5 hover:text-black">
                                        <span>صورة</span>
                                        <i data-lucide="image" class="w-4 h-4 text-[#3b7a75]"></i>
                                    </button>
                                    <button type="button" @click="showImageInput = !showImageInput" class="flex items-center gap-1.5 hover:text-black">
                                        <span>رابط</span>
                                        <i data-lucide="link" class="w-4 h-4 text-[#424242]"></i>
                                    </button>
                                    <span class="flex items-center gap-1.5">
                                        <span>منشور</span>
                                        <i data-lucide="file-text" class="w-4 h-4 text-[#424242]"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Stacked Post Cards -->
                    @foreach($posts as $post)
                    <article :class="mode === 'threads_paper' ? 'bg-white border-[#d5d5d5]' : 'bg-[#f7f4ef] border-[#e2dcd3]'"
                             class="rounded-[18px] border px-4 py-3.5 space-y-3"
                             x-data="{ liked: {{ $post->isLikedBy(Auth::user()) ? 'true' : 'false' }}, likesCount: {{ $post->totalLikesCount() }} }">

                        <!-- Username Row (13px/600 username, verified badge #385898, 13px/400 timestamp #969696) -->
                        <div class="flex items-center justify-between">
                            <button class="text-[#969696] hover:text-black">
                                <i data-lucide="more-horizontal" class="w-4 h-4"></i>
                            </button>

                            <div class="flex items-center gap-2.5" dir="ltr">
                                <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}"
                                     class="w-9 h-9 rounded-full object-cover border border-[#d5d5d5]">
                                <div class="text-left">
                                    <div class="flex items-center gap-1">
                                        <span class="text-[13px] font-semibold text-black">{{ $post->user->name }}</span>
                                        @if($post->user->is_verified)
                                            <!-- Verified Indigo Badge (#385898) -->
                                            <span class="inline-flex items-center justify-center w-3.5 h-3.5 rounded-full bg-[#385898] text-white" title="Verified">
                                                <i data-lucide="check" class="w-2.5 h-2.5 stroke-[3]"></i>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-[12px] text-[#969696]">
                                        @<span>{{ $post->user->username }}</span> • <span>{{ $post->time_label }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Post Body (15px/400 #000000, line-height 1.4) -->
                        <p class="text-[15px] font-normal text-black leading-[1.45] text-right">
                            {{ $post->content }}
                        </p>

                        <!-- Media Thumbnail (8px radius, 1px solid #d5d5d5 border) -->
                        @if($post->image_url)
                        <div class="rounded-[8px] overflow-hidden border border-[#d5d5d5]">
                            <img src="{{ $post->image_url }}" alt="Post media" class="w-full max-h-[380px] object-cover block">
                        </div>
                        @endif

                        <!-- Post Action Bar (24px outlined icons, hover shifts to #385898 indigo) -->
                        <div class="pt-1 pb-1 flex items-center justify-between text-[#424242]" dir="ltr">
                            <div class="flex items-center gap-5">
                                <form @submit.prevent="fetch('{{ route('posts.like', $post) }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' } }).then(r=>r.json()).then(d=>{ liked = d.liked; likesCount = d.likes_count; })">
                                    <button type="submit" class="flex items-center gap-2 text-[13px] hover:text-[#385898] transition"
                                            :class="liked ? 'text-[#c85a32] font-semibold' : 'text-[#424242]'">
                                        <i data-lucide="heart" class="w-5 h-5" :class="liked ? 'fill-current' : ''"></i>
                                        <span x-text="likesCount"></span>
                                    </button>
                                </form>

                                <div class="flex items-center gap-2 text-[13px] hover:text-[#385898] cursor-pointer">
                                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                                    <span>{{ $post->totalCommentsCount() }}</span>
                                </div>

                                <button type="button" class="hover:text-[#385898] transition">
                                    <i data-lucide="share-2" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <button type="button" class="hover:text-[#385898] transition">
                                <i data-lucide="bookmark" class="w-5 h-5"></i>
                            </button>
                        </div>

                        <!-- Comments List & Input (Exact match to Screenshot) -->
                        <div :class="mode === 'threads_paper' ? 'bg-[#fafafa] border-[#d5d5d5]' : 'bg-[#efeae2] border-[#e0d9ce]'"
                             class="rounded-[12px] p-3 space-y-2.5 border">
                            @foreach($post->comments as $comment)
                            <div class="flex items-start justify-between gap-2.5 border-b border-[#d5d5d5]/50 pb-2 last:border-0 last:pb-0">
                                <div class="flex-grow text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <span class="text-[11px] text-[#969696]">{{ $comment->time_label }}</span>
                                        <span class="text-[12px] font-semibold text-black" dir="ltr">{{ $comment->user->name }}</span>
                                    </div>
                                    <p class="text-[13px] text-[#1c1917] mt-0.5">{{ $comment->content }}</p>
                                    <div class="flex items-center justify-end gap-3 mt-1 text-[11px] text-[#969696]">
                                        <span class="flex items-center gap-1"><i data-lucide="heart" class="w-3 h-3 text-[#c85a32] fill-current"></i> {{ $comment->likes_count }}</span>
                                    </div>
                                </div>
                                <img src="{{ $comment->user->avatar }}" class="w-7 h-7 rounded-full object-cover border border-[#d5d5d5] shrink-0">
                            </div>
                            @endforeach

                            <!-- Add Comment Input -->
                            <form method="POST" action="{{ route('comments.store', $post) }}" class="flex items-center gap-2 pt-1">
                                @csrf
                                <button type="submit" class="text-[#424242] hover:text-black p-1">
                                    <i data-lucide="send" class="w-4 h-4"></i>
                                </button>
                                <input type="text" name="content" required placeholder="اكتب تعليفك..."
                                       class="w-full bg-white/80 border border-[#d5d5d5] rounded-full px-3.5 py-1.5 text-[12px] text-black placeholder-[#969696] outline-none">
                            </form>
                        </div>

                    </article>
                    @endforeach

                </main>

                <!-- RIGHT COLUMN: Welcome Dark Box + Trending Topics with Thumbnails + Inspiring Quote -->
                <aside class="lg:col-span-3 space-y-4">

                    <!-- Welcome Widget (Matches right dark card in screenshot) -->
                    <div :class="mode === 'threads_paper' ? 'bg-white border border-[#d5d5d5] text-black' : 'bg-[#181614] border border-[#262320] text-white'"
                         class="rounded-[18px] p-5 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-[12px] text-[#969696]" dir="ltr">{{ $settings->site_name }}</span>
                            <div class="w-6 h-6 rounded bg-gradient-to-br from-[#c85a32] to-[#3b7a75] flex items-center justify-center text-white font-bold text-xs">N</div>
                        </div>

                        <div>
                            <h2 class="text-[18px] font-bold mb-1.5">{{ $settings->welcome_title }}</h2>
                            <p class="text-[12px] text-[#969696] leading-relaxed">
                                {{ $settings->welcome_subtitle }}
                            </p>
                        </div>

                        <div class="grid grid-cols-3 gap-2 pt-3 border-t"
                             :class="mode === 'threads_paper' ? 'border-[#d5d5d5]' : 'border-[#262320]'">
                            <div class="text-center">
                                <i data-lucide="users" class="w-4 h-4 mx-auto mb-1 text-[#c85a32]"></i>
                                <span class="block text-[14px] font-bold">{{ $settings->stat_groups }}</span>
                                <span class="text-[11px] text-[#969696]">مجموعة</span>
                            </div>
                            <div class="text-center border-x" :class="mode === 'threads_paper' ? 'border-[#d5d5d5]' : 'border-[#262320]'">
                                <i data-lucide="check-square" class="w-4 h-4 mx-auto mb-1 text-[#3b7a75]"></i>
                                <span class="block text-[14px] font-bold">{{ $settings->stat_posts }}</span>
                                <span class="text-[11px] text-[#969696]">منشور</span>
                            </div>
                            <div class="text-center">
                                <i data-lucide="user-check" class="w-4 h-4 mx-auto mb-1 text-[#3b7a75]"></i>
                                <span class="block text-[14px] font-bold">{{ $settings->stat_users }}</span>
                                <span class="text-[11px] text-[#969696]">مستخدم</span>
                            </div>
                        </div>
                    </div>

                    <!-- Trending Visual Cards Widget -->
                    <div :class="mode === 'threads_paper' ? 'bg-white border border-[#d5d5d5] text-black' : 'bg-[#181614] border border-[#262320] text-white'"
                         class="rounded-[18px] p-4 space-y-3.5">
                        <div class="flex items-center justify-between">
                            <i data-lucide="trending-up" class="w-4 h-4 text-[#c85a32]"></i>
                            <h3 class="text-[14px] font-bold">المشاركات الرائجة</h3>
                        </div>

                        <div class="space-y-3">
                            @foreach(array_slice($popularTags, 0, 4) as $trend)
                            <div class="flex items-center justify-between gap-3 pb-2.5 border-b last:border-0 last:pb-0"
                                 :class="mode === 'threads_paper' ? 'border-[#d5d5d5]' : 'border-[#262320]'">
                                <div class="text-right">
                                    <div class="text-[13px] font-semibold">{{ $trend['tag'] }}</div>
                                    <div class="text-[11px] text-[#969696]">{{ $trend['count'] }}</div>
                                </div>
                                @if($trend['img'])
                                <img src="{{ $trend['img'] }}" class="w-12 h-12 rounded-[8px] object-cover border border-[#d5d5d5]/30 shrink-0">
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Inspiring Quotes Widget -->
                    <div :class="mode === 'threads_paper' ? 'bg-white border border-[#d5d5d5] text-black' : 'bg-[#181614] border border-[#262320] text-white'"
                         class="rounded-[18px] p-5 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-serif text-[#3b7a75] leading-none">“</span>
                            <h3 class="text-[13px] font-bold">اقتباسات ملهمة</h3>
                        </div>
                        <p class="text-[12px] text-[#969696] leading-relaxed pt-1">
                            {{ $settings->quote_text }}
                        </p>
                        <div class="text-[11px] text-[#3b7a75] font-semibold text-left pt-1" dir="ltr">
                            {{ $settings->quote_author }}
                        </div>
                    </div>

                </aside>

            </div>
        </div>

    </div>
</div>
@endsection
