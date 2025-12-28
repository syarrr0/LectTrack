<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteNotification extends Model
{
    protected $table = 'site_notifications';

    protected $fillable = [
        'title',
        'day',
        'date',
        'content',
    ];
   public function up(): void
{
    Schema::create('site_notifications', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('day');
        $table->date('date');
        $table->text('content');
        $table->timestamps(); // Ini akan cipta created_at dan updated_at
    });
}
}
