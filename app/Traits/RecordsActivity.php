<?php

namespace App\Traits;

use App\Models\Activity;
use ReflectionClass;

trait RecordsActivity
{
    /**
     * Boot the trait.
     */
    protected static function bootRecordsActivity()
    {
        if (auth()->guest()) return false;

        foreach (static::getActivitesToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }

        static::deleting(function ($model) {
            $model->activity()->delete();
        });
    }

    /**
     * Fetch all model events that require activity recording.
     *
     * @return array
     */
    protected static function getActivitesToRecord()
    {
        return ['created'];
    }

    /**
     * Record new activity for the model.
     *
     * @param string $event
     */
    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type'    => $this->getActivityType($event),
        ]);
    }

    /**
     *  relationFetch the activityship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    /**
     * Determine the activity type.
     *
     * @param  string $event
     * @return string
     */
    protected function getActivityType($event)
    {
        $type = strtolower((new ReflectionClass($this))->getShortName());

        return "{$event}_{$type}";
    }
}
