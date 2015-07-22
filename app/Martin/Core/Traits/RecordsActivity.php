<?php

namespace Martin\Core\Traits;

use Martin\Core\Activity;
use ReflectionClass;

trait RecordsActivity
{
    protected static function boot()
    {
        parent::boot();

        foreach(static::getModelEvents() as $event)
        {
            static::$event(function($model) use ($event) {
                $model->addActivity($event);
            });
        }
    }

    protected function getActivityName($model, $action)
    {
        $name = strtolower((new ReflectionClass($model))->getShortName()); // Post -> post

        return "{$action}_{$name}";
    }

    public static function getModelEvents()
    {
        if (isset(static::$recordEvents))
            return static::$recordEvents;

        return [
            'created', 'deleted', 'updated'
        ];
    }

    protected function addActivity($event)
    {
        Activity::create([
            'subject_id' => $this->id,
            'subject_type' => get_class($this),
            'name' => $this->getActivityName($this, $event),
            'user_id' => \Auth::id()
        ]);
    }
}

 