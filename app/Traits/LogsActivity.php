<?php

namespace App\Traits;

use App\Services\ActivityLogger;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function ($model) {
            $description = match(get_class($model)) {
                'App\Models\Client' => "Added new client: {$model->name}",
                'App\Models\Pet' => "Added new pet: {$model->name} (Owner: {$model->client->name})",
                'App\Models\Appointment' => "Scheduled new appointment for {$model->client->name}'s pet {$model->pet->name}",
                'App\Models\Visit' => "Recorded new visit for {$model->pet->name}",
                'App\Models\Invoice' => "Created new invoice #{$model->id} for {$model->client->name}",
                default => "Created new {$model->getTable()} record: #{$model->id}"
            };

            app(ActivityLogger::class)->log(
                $model,
                'created',
                $description,
                $model->getAttributes()
            );
        });

        static::updated(function ($model) {
            $modelType = match(get_class($model)) {
                'App\Models\Client' => "client {$model->name}",
                'App\Models\Pet' => "pet {$model->name}",
                'App\Models\Appointment' => "appointment for {$model->client->name}",
                'App\Models\Visit' => "visit record for {$model->pet->name}",
                'App\Models\Invoice' => "invoice #{$model->id}",
                default => "{$model->getTable()} record #{$model->id}"
            };

            $changes = array_intersect_key($model->getOriginal(), $model->getDirty());
            $changedFields = array_keys($model->getDirty());
            
            $description = "Updated " . $modelType . " - Changed: " . implode(', ', $changedFields);

            app(ActivityLogger::class)->log(
                $model,
                'updated',
                $description,
                [
                    'old' => $changes,
                    'new' => $model->getDirty(),
                    'fields' => $changedFields
                ]
            );
        });

        static::deleted(function ($model) {
            $description = match(get_class($model)) {
                'App\Models\Client' => "Removed client: {$model->name}",
                'App\Models\Pet' => "Removed pet: {$model->name}",
                'App\Models\Appointment' => "Cancelled appointment for {$model->client->name}",
                'App\Models\Visit' => "Deleted visit record for {$model->pet->name}",
                'App\Models\Invoice' => "Deleted invoice #{$model->id}",
                default => "Deleted {$model->getTable()} record #{$model->id}"
            };

            app(ActivityLogger::class)->log(
                $model,
                'deleted',
                $description,
                $model->getOriginal()
            );
        });
    }
}
