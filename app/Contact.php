<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'contact_status', 'client_type',
    	'salutation', 'name', 'first_name', 'middle_name', 'last_name', 'nationality',
    	'company', 'position',
        'email', 'email2', 'mobile', 'mobile2', 'mobile3', 'phone', 'fax',
        'passport_number', 'id_number',
    	'source', 'notes'
    ];

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_contacts');
    }

    public function interestedIn($properties)
    {
        return $this->properties()->attach($properties);
    }

    public function notInterestedIn($properties)
    {
        return $this->properties()->detach($properties);
    }

    public static function exists($value)
    {
    	if (str_contains($value, '@')) {
	    	return static::where('email', $value)->count() > 0;
    	}
    	
    	return static::where('phone', $value)->count() > 0;
    }
}
