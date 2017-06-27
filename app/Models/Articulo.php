<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Articulo extends Model
{
    protected $table = 'articulos';
    protected $primaryKey = 'idarticulo';
    public $timestamps = false;







    public function autoresArticulo(){
        $autores  = DB::select(DB::raw('SELECT 
							Nombre, Apellido, Autor.IdAutor
						FROM
							Autor
							JOIN Autoria
								ON Autor.IdAutor = Autoria.IdAutor
						WHERE
							Autoria.IdArticulo = ' . $this->IdArticulo . '
						ORDER BY
							OrdenFirma ASC'));

        return $autores;
    }

    public function palabrasClaveAsociadas(){
     $asociadas =   DB::select(DB::raw('SELECT 
							PalabraClave.IdPalabraClave, PalabraClave
						FROM
							PalabraClave
							JOIN KeywordsArticulo
							ON PalabraClave.IdPalabraClave = KeywordsArticulo.IdPalabraClave
						WHERE
							KeywordsArticulo.IdArticulo = ' . $this->IdArticulo . ' '
                ));

     return $asociadas;
    }


public function palabrasClaveNoAsociadas(){
    $no_asociados = DB::select(DB::raw('SELECT * 
								FROM
									PalabraClave a
								WHERE a.IdPalabraClave  NOT IN
								(
                                    SELECT b.IdPalabraClave 
                                    FROM KeywordsArticulo b
                                    WHERE b.IdArticulo = ' . $this->IdArticulo . ' 
                                  )
								'));

    return $no_asociados;
}

public function autoresAsociados(){

    $asociados = DB::select(DB::raw('SELECT 
							Nombre, Apellido,Filiacion, Autor.IdAutor,Autoria.OrdenFirma
						FROM
							Autor
							JOIN Autoria
								ON Autor.IdAutor = Autoria.IdAutor
						WHERE
							Autoria.IdArticulo = ' . $this->IdArticulo . '
						ORDER BY
							OrdenFirma ASC'));

    return $asociados;
}

public function autoresNoAsociados(){

    $no_asociados = DB::select(DB::raw('SELECT * 
								FROM
									Autor a
								WHERE a.IdAutor  NOT IN
								(
                                    SELECT b.IdAutor
                                    FROM Autoria b
                                    WHERE b.IdArticulo = ' . $this->IdArticulo . ' 
                                  )
								'));

    return $no_asociados;
}


public function multimediaAsociado(){

    $asociados = DB::table('almacenmultimedia')->where('IdMutimedia',$this->IdArticulo)->get();

    return $asociados;
    
}

public function notaArticulo(){

    $nota = DB::table('notasarticulo')
        ->where('idarticulo','=',$this->IdArticulo)
        ->get()
        ->first();

    return $nota;
}

}