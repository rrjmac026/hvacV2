<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'user_id',
        'subject_type',
        'subject_id',
        'action',
        'description',
        'properties'
    ];

    protected $casts = [
        'properties' => 'array'
    ];

    public function subject()
    {
        return $this->morphTo();
    }

    public function causer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getIconClass()
    {
        return match($this->action) {
            'created' => 'text-green-500',
            'updated' => 'text-blue-500',
            'deleted' => 'text-red-500',
            default => 'text-gray-500'
        };
    }

    public function getIcon()
    {
        return match($this->action) {
            'created' => '<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>',
            'updated' => '<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>',
            'deleted' => '<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>',
            default => '<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
        };
    }

    public function getFormattedProperties()
    {
        if (!$this->properties) return [];
        
        $properties = is_string($this->properties) ? json_decode($this->properties, true) : $this->properties;
        $changes = [];
        
        foreach ($properties as $key => $value) {
            // Skip if key is ip_address or user_agent
            if (in_array($key, ['ip_address', 'user_agent'])) continue;
            
            if (is_array($value)) {
                if (isset($value['new'])) {
                    $changes[] = [
                        'field' => ucwords(str_replace('_', ' ', $key)),
                        'new' => is_array($value['new']) ? json_encode($value['new']) : (string)$value['new']
                    ];
                }
            } else {
                $changes[] = [
                    'field' => ucwords(str_replace('_', ' ', $key)),
                    'new' => is_array($value) ? json_encode($value) : (string)$value
                ];
            }
        }
        
        return $changes;
    }
}
