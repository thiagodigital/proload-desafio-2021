<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Feed extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $keyType = 'string';

    protected static function booted()
    {
        static::creating(fn(Feed $feed) => $feed->id = (string) Uuid::uuid4());
    }

    public static function findOrCreate($title)
    {
        $feed = static::where('title', $title)->first();
        return $feed ? $feed : new static;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'pubDate',
        'image',
        'guid',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'pubDate' => 'datetime',
    ];


    public function subscribers()
    {
        return $this->hasMany(Subscriber::class);
    }
}
