<?php

namespace Martin\Core\Traits;

use Martin\Core\Attention;
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

        foreach(static::getDrawAttentionEvents() as $event)
        {
            static::$event(function($model) use ($event) {
                $model->drawAttention($event);
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

    public static function getDrawAttentionEvents()
    {
        if (isset(static::$drawAttentionEvents))
            return static::$drawAttentionEvents;

        return [
            'created'
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

    protected function drawAttention($event)
    {
        Attention::create([
            'attentionable_id' => $this->id,
            'attentionable_type' => get_class($this),
            'action' => $this->getActivityName($this, $event),
            'global' => true,
        ]);
    }

    protected function addAttention($event)
    {

    }

}

 