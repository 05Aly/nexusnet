<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'welcome_title',
        'welcome_subtitle',
        'demo_banner_text',
        'quote_text',
        'quote_author',
        'stat_users',
        'stat_posts',
        'stat_groups',
    ];
}
