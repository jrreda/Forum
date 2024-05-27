<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'channel_id',
    ];
    
    /**
     * boot
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function (Builder $builder) {
            $builder->withCount('replies');
        });
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply($reply) 
    {
        $this->replies()->create($reply);
    }

    /**
     * A thread is assigned a channel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    
    /**
     * Scope a query to filter users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, $filters)
    {
        return $filters->apply($query);
    }
}
