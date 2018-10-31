<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'description', 'status', 'priority'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function statusFormatHtml($value) {
        switch ($value) {
            case 0:
                return '<h5><span class="badge badge-danger">Not started</span></h5>';
            case 1:
                return '<h5><span class="badge badge-info">In progress...</span><h5>';
            default:
                return '<h5><span class="badge badge-success">Completed</span><h5>';
        }
    }

    public static function priorityFormatHtml($value) {
        switch ($value) {
            case 0:
                return '<h5><span class="badge badge-success">Low</span><h5>';
            case 1:
                return '<h5><span class="badge badge-warning">Medium</span><h5>';
            default:
                return '<h5><span class="badge badge-danger">High</span><h5>';
        }
    }
}
