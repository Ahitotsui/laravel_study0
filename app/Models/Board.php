<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Illuminate\Database\Eloquent\Builder;
// use App\Scopes\ScopePerson;

class Board extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'person_id' => 'required',
        'title' => 'required',
        'message' => 'required'
    );

    public function person()
    {
        return $this->belongsTo('App\Models\Person');
    }

    public function getData()
    {
        // 参考
        //https://qiita.com/jacoloves/items/72d425d1b790bfa9b6c2
        return $this->id . ':' . $this->title . '(' . $this->person['name'] . ')';
    }

}
