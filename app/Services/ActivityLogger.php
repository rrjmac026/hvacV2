<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ActivityLogger
{
    public function log(Model $subject, string $action, string $description, array $properties = [])
    {
        try {
            Activity::create([
                'user_id' => auth()->id(),
                'subject_type' => get_class($subject),
                'subject_id' => $subject->id,
                'action' => $action,
                'description' => $description,
                'properties' => array_merge($properties, [
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent()
                ])
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log activity: ' . $e->getMessage(), [
                'subject' => get_class($subject),
                'subject_id' => $subject->id,
                'action' => $action
            ]);
        }
    }
}
