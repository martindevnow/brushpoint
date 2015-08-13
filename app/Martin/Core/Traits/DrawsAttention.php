<?php


namespace Martin\Core\Traits;

use App\Attention;
use ReflectionClass;

trait DrawsAttention {

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

    protected function addAttention($event)
    {
        Attention::create([
            'attentionable_id' => $this->id,
            'attentionable_type' => get_class($this),
            'action' => $this->getActivityName($this, $event),
            'global' => true,
        ]);
    }
} 