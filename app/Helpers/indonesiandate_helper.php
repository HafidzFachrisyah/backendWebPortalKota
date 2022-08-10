<?php
function hari_ini(){
  $hari = date ("D");
 
  switch($hari){
    case 'Sun':
      $hari_ini = "Minggu";
    break;
 
    case 'Mon':			
      $hari_ini = "Senin";
    break;
 
    case 'Tue':
      $hari_ini = "Selasa";
    break;
 
    case 'Wed':
      $hari_ini = "Rabu";
    break;
 
    case 'Thu':
      $hari_ini = "Kamis";
    break;
 
    case 'Fri':
      $hari_ini = "Jumat";
    break;
 
    case 'Sat':
      $hari_ini = "Sabtu";
    break;
    
    default:
      $hari_ini = "Tidak di ketahui";		
    break;
  }
 
  return $hari_ini.',<br><h4>'.date ("d").'</h4>';
}

  function bulan_ini(){
   
    $bulan = date ("m");
    Switch ($bulan){
     case 1 : $bulan="Januari";
     Break;
     case 2 : $bulan="Februari";
     Break;
     case 3 : $bulan="Maret";
     Break;
     case 4 : $bulan="April";
     Break;
     case 5 : $bulan="Mei";
     Break;
     case 6 : $bulan="Juni";
     Break;
     case 7 : $bulan="Juli";
     Break;
     case 8 : $bulan="Agustus";
     Break;
     case 9 : $bulan="September";
     Break;
     case 10 : $bulan="Oktober";
     Break;
     case 11 : $bulan="November";
     Break;
     case 12 : $bulan="Desember";
     Break;
     }
  
    return $bulan.'<h4>'.date ("Y").'</h4>';
   
  }

  function bulan_indo($bulan){
   
    Switch ($bulan){
     case 1 : $bulan="Januari";
     Break;
     case 2 : $bulan="Februari";
     Break;
     case 3 : $bulan="Maret";
     Break;
     case 4 : $bulan="April";
     Break;
     case 5 : $bulan="Mei";
     Break;
     case 6 : $bulan="Juni";
     Break;
     case 7 : $bulan="Juli";
     Break;
     case 8 : $bulan="Agustus";
     Break;
     case 9 : $bulan="September";
     Break;
     case 10 : $bulan="Oktober";
     Break;
     case 11 : $bulan="November";
     Break;
     case 12 : $bulan="Desember";
     Break;
     }
  
    return $bulan;
   
  }

?>