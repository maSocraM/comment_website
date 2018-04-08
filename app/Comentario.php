<?php

namespace App;

// utiliza o fabric Model para o MongoDB
// use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

// class Comentario extends Eloquent {
class Comentario extends Eloquent {

    protected $collection = "comentarios";
}
