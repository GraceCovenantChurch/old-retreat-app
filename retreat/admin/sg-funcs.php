<?php

function sg_to_name($sg) {
$SG_NAMES = array(
'B01' => 'Accordion',
'B02' => 'Bagpipe',
'B03' => 'Cello',
'B04' => 'Clarinet',
'B05' => 'Guitar',
'B06' => 'Harmonica',
'B07' => 'Oboe',
'B08' => 'Piano',
'B09' => 'Piccolo',
'B10' => 'Saxophone',
'B11' => 'Timpani',
'B12' => 'Trombone',
'B13' => 'Trumpet',
'B14' => 'Violin',
'S01' => 'Acceso',
'S02' => 'Adagio',
'S03' => 'Amoroso',
'S04' => 'Bravura',
'S05' => 'Brilliante',
'S06' => 'Brioso',
'S07' => 'Calore',
'S08' => 'Crescendo',
'S09' => 'Dolce',
'S10' => 'Enfatico',
'S11' => 'Espressivo',
'S12' => 'Fieramente',
'S13' => 'Intimo',
'S14' => 'Liberamente',
'S15' => 'Passionato',
'S16' => 'Risoluto',
'S17' => 'Sempre',
'S18' => 'Sostenuto',
'S19' => 'Unisono',
'Band' => 'Band',
);

  $name = $SG_NAMES[$sg];
  if($name) {
    return $name;
  } else {
    return "";
  }
}

?>