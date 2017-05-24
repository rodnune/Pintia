<?php


return [
        //enums de unidad estratigrafica
    'unidad_accion' => [
        'natural'       => "Natural",
        'zoologica'     => "Zoologica",
        'antropica'     => "Antropica",
        'indeterminado' => "Indeterminado"
    ],

    'tipos_unidad_accion' => [
    'estrato'    => "Estrato",
    'superficie' => "Superficie"
],
    'tipos_estrato1' => [
        'compacta' => "Compacta",
        'suelta'   => "Suelta"
    ],

    'tipos_estrato2' => [
        'homogenea' => "Homogenea",
        'suelta'    => "Heterogenea"
    ],

    'tipo_excavada' => [
        'no_excavada' => "No excavada",
        'parcialmente'=> "Parcialmente",
        'totalmente'  => "Totalmente",
    ],

    'tipo_alzada' => [
        'alzada_unica' => "Alzada unica",
        'varias'       => "Varias alzadas"
    ],

    'fiabilidad_estratigrafia' => [
        'completa'     => "Completa",
        'problematica' => "Problematica"
    ],

    'relaciones_estratigraficas' => [
         'igual_a'            => "igual a",
         'se_corresponde_con' => "se corresponde con",
         'cubre_a'            => "cubre a",
         'rellena_a'          => "rellena a",
         'corta_a'            => "corta a",
         'se_yuxtapone_a'     => "se yuxtapone a",
         'contiene_a'         => "contiene a",
         'se_apoya_en'        => "se apoya en",
         'cubierta_por'       => "cubierta por",
         'rellena_por'        => "rellena por",
         'cortada_por'        => "cortada por",
         'se_le_yuxtapone'    => "se le yuxtapone",
         'contenida_en'       => "contenida en",
         'se_le_apoya'        => "se le apoya"

    ],


    'bool' => [
        'no' => "No",
        'si' => "Si"
    ],

    'inhumacion_conservacion' => [
        'completa' => "Completa",
        'parcial'  =>  "Parcial"
     ],

    'inhumacion_conexion_anatomica' => [
        'articulado'       => "Articulado",
        'desarticulado'    => "Desarticulado"
    ],

    'inhumacion_posicion' => [
        'supino'             => "Decubito supino",
        'prono'              => "Decubito prono",
        'lateral_derecho'    => "Decubito lateral derecho",
        'lateral_izqdo'      => "Decubito lateral izquierdo",
        'otros'              => "Otros"
    ],

    'inhumacion_actitud' => [
        'extension'         => "En extension",
        'flexion'           => "En flexion",
        'flexion_extrema'   => "En flexion extrema",
        'contorsionado'     => "Contorsionado"
    ],

    'sexo' => [
        'hombre'    => "Hombre",
        'mujer'     => "Mujer",
        'infante'   => "Alofiso (infante)",
        'masculino' => "Alofiso (masculino)",
        'femenino'  => "Alofiso (femenino)"
    ],

    'multimedia' => [

        'foto'      => "Fotografia",
        'plano'     => "Planimetria",
        'dibujo'    => "Dibujo",
        'documento' => "Documento"

    ]




];