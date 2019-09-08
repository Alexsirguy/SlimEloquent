<?php
namespace Moonsat\Clique\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class accounts extends Eloquent
{
    protected $fillable = ["userid", "fullname", "address", "dob", "gender", "email",
        "phone", "avatar", "country", "password", "role", "address"];
    protected $hidden = array('password');

    public function enroll() {
        return $this->hasOne('Moonsat\Clique\Models\studentclasses', 'userid', 'userid');
    }

    public function messages() {
        return $this->hasMany('Moonsat\Clique\Models\messages', 'tutorid', 'userid');
    }
}
