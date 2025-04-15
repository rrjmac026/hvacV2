<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;
use App\Mail\VisitNotificationMail;
use App\Traits\LogsActivity;

class Visit extends Model
{
    use LogsActivity;

    protected $fillable = [
        'client_id',
        'pet_id',
        'visit_date',
        'status',
        'diagnosis',
        'treatment',
        'notes'
    ];

    protected $casts = [
        'visit_date' => 'datetime'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    // Trigger email after creating a visit
    protected static function boot()
    {
        parent::boot();

        static::created(function ($visit) {
            // Send email when a visit is created
            Mail::to($visit->client->email)->send(new VisitNotificationMail($visit));
        });

        static::updated(function ($visit) {
            // Send email when a visit is updated
            Mail::to($visit->client->email)->send(new VisitNotificationMail($visit));
        });
    }
}
