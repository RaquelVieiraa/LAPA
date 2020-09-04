<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;

class Postagem extends Model
{  
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'titulo', 'descricao', 'anexo', 'user_id','tipo_postagem','publicado','data','slug','hora', 'tipo_anexo',

    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
    public function getEnumValues(){
        $listaEnum=['noticia','edital','evento'];
        return $listaEnum;
    }
    /**
    * Get the route key for the model.
    *
    * @return string
    */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
    * Convert a shared image link from drive to an embedable image link.
    *
    * @return string
    */
    public static function convertToEmbedableImageLink($link) {
        $embedableLink = Str::replaceFirst('https://drive.google.com/file/d/', 'https://drive.google.com/thumbnail?id=', $link);
        $embedableLink = Str::replaceFirst('/view?usp=sharing', '', $embedableLink);

        return $embedableLink;
    }
}
