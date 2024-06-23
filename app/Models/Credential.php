<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory;

    public function credentialtype() {
	   return $this->belongsTo(CredentialType::class,'credential_type_id');
	}
}
