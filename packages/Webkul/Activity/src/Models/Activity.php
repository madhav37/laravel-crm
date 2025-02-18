<?php

namespace Webkul\Activity\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\User\Models\UserProxy;
use Webkul\Activity\Contracts\Activity as ActivityContract;

class Activity extends Model implements ActivityContract
{
    protected $table = 'activities';

    protected $with = ['file', 'user'];

    protected $dates= [
        'schedule_from',
        'schedule_to',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'type',
        'comment',
        'additional',
        'schedule_from',
        'schedule_to',
        'is_done',
        'user_id',
    ];

    /**
     * Get the user that owns the activity.
     */
    public function user()
    {
        return $this->belongsTo(UserProxy::modelClass());
    }

    /**
     * The participants that belong to the activity.
     */
    public function participants()
    {
        return $this->belongsToMany(UserProxy::modelClass(), 'activity_participants');
    }

    /**
     * Get the file associated with the activity.
     */
    public function file()
    {
        return $this->hasOne(FileProxy::modelClass(), 'activity_id');
    }
}
