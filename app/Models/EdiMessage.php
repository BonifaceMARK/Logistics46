<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EdiMessage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lms_g46_edimessages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message_type', 'message_body',
    ];

    /**
     * Get the type of the message.
     *
     * @param  string  $value
     * @return string
     */
    public function getMessageTypeAttribute($value)
    {
        return ucfirst(strtolower($value));
    }
}
