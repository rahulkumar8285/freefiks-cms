<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketStatusLog extends Model
{
    use HasFactory;

    protected $table = 'ticket_status_logs';

    protected $fillable = [
        'session_id',
        'ticket_id',
        'status',
        'remarks',
        'created_at',
    ];
}
