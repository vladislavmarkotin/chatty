<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 20.10.2017
 * Time: 8:46
 */

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Statuses extends Model{

    protected $table = 'statuses';

    protected $fillable = [
        'body'
    ];

    public function getId()
    {
        if($this->id){
            return $this->id;
        }
    }

    public function user()
    {
        return $this->belongsTo('App\Statuses', 'user_id');
    }


} 