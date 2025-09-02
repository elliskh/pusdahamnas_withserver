<?php
function getRomawi($bln){
   switch ($bln){
      case 1:
      return "I";
      break;
      case 2:
      return "II";
      break;
      case 3:
      return "III";
      break;
      case 4:
      return "IV";
      break;
      case 5:
      return "V";
      break;
      case 6:
      return "VI";
      break;
      case 7:
      return "VII";
      break;
      case 8:
      return "VIII";
      break;
      case 9:
      return "IX";
      break;
      case 10:
      return "X";
      break;
      case 11:
      return "XI";
      break;
      case 12:
      return "XII";
      break;
   }
}
function get_day($month) {
   switch ($month) {
      case 'Sun':
      $d = 'Minggu';
      break;
      case 'Mon':
      $d = 'Senin';
      break;
      case 'Tue':
      $d = 'Selasa';
      break;
      case 'Wed':
      $d = 'Rabu';
      break;
      case 'Thu':
      $d = 'Kamis';
      break;
      case 'Fri':
      $d = 'Jumat';
      break;
      case 'Sat':
      $d = 'Sabtu';
      break;
      default:
      $d = '';
      break;
   }
   return $d;
}
function selisih_tanggal($date1,$date2)
{
   $datetime1 = new DateTime($date1);
   $datetime2 = new DateTime($date2);
   $difference = $datetime1->diff($datetime2);
   return $difference->days;
}
function tambah_tanggal($date,$plus)
{
$newdate = strtotime ( '+'.$plus.' days' , strtotime ( $date ) ) ;//menambahkan x hari
$newdate = date ( 'Y-m-d' , $newdate ); //untuk menyimpan ke dalam variabel baru
return $newdate;
}
function nama_hari($tanggal)
{
   $tgl=substr($tanggal,8,2);
   $bln=substr($tanggal,5,2);
   $thn=substr($tanggal,0,4);
   $info=date('w', mktime(0,0,0,$bln,$tgl,$thn));
   switch($info){
      case '0': return "Minggu"; break;
      case '1': return "Senin"; break;
      case '2': return "Selasa"; break;
      case '3': return "Rabu"; break;
      case '4': return "Kamis"; break;
      case '5': return "Jumat"; break;
      case '6': return "Sabtu"; break;
   };
}
function bilangan($waktu){
   switch($waktu){
      case '0': return "nol"; break;
      case '1': return "satu"; break;
      case '2': return "dua"; break;
      case '3': return "tiga"; break;
      case '4': return "empat"; break;
      case '5': return "lima"; break;
      case '6': return "enam"; break;
      case '7': return "tujuh"; break;
      case '8': return "delapan"; break;
      case '9': return "sembilan"; break;
      case '10': return "sepuluh"; break;
      case '11': return "sebelas"; break;
      case '12': return "dua belas"; break;
      case '13': return "tiga belas"; break;
      case '14': return "empat belas"; break;
      case '15': return "lima belas"; break;
      case '16': return "enam belas"; break;
      case '17': return "tujuh belas"; break;
      case '18': return "delapan belas"; break;
      case '19': return "sembilan belas"; break;
      case '20': return "dua puluh"; break;
      case '21': return "dua puluh satu"; break;
      case '22': return "dua puluh dua"; break;
      case '23': return "dua puluh tiga"; break;
      case '24': return "dua puluh empat"; break;
      case '25': return "dua puluh lima"; break;
      case '26': return "dua puluh enam"; break;
      case '27': return "dua puluh tujuh"; break;
      case '28': return "dua puluh delapan"; break;
      case '29': return "dua puluh sembilan"; break;
      case '30': return "tiga puluh"; break;
      case '31': return "tiga puluh satu"; break;
      case '32': return "tiga puluh dua"; break;
      case '33': return "tiga puluh tiga"; break;
      case '34': return "tiga puluh empat"; break;
      case '35': return "tiga puluh lima"; break;
      case '36': return "tiga puluh enam"; break;
      case '37': return "tiga puluh tujuh"; break;
      case '38': return "tiga puluh delapan"; break;
      case '39': return "tiga puluh sembilan"; break;
      case '40': return "empat puluh"; break;
   };
}
function ubah($date){
   list($tgl, $bln, $thn) = explode('-', $date);
   return $thn."-".$bln."-".$tgl;
}
function addDate($date, $step){
   list($tahun, $bulan, $tanggal) = explode('-', $date);
   $tanggal=$tanggal+$step;
   if(($tahun%4==0) && ($tahun%100!=0) || ($tahun%400==0 && $bulan==2))
   {
      $tglakh=$tanggal%29;
      if($tanggal>=29)
      {
         $bulan+=1;
      }
   }
   else
   {
      if($bulan==2)
      {
         $tglakh=$tanggal%28;
         if($tanggal>=28)
         {
            $bulan+=1;
         }
      }
      else if(($bulan==4) || ($bulan==6) || ($bulan==9) || ($bulan==11))
      {
         $tglakh=$tanggal%30;
         if($tglakh == 0) $tglakh = 30;
         if($tanggal>30)
         {
            $bulan+=1;
         }
      }
      else
      {
         $tglakh=$tanggal%31;
         if($tglakh == 0) $tglakh = 31;
         if($tanggal>31)
         {
            $bulan+=1;
         }
      }
   }
   return $tglakh."-".$bulan."-".$tahun;
}
function nmonth($month){
   $thn_kabisat = date("Y") % 4;
   ($thn_kabisat==0)?$feb=29:$feb=28;
   $init_month = array(1=>31,    // Januari
   2=>$feb,  // Feb
   3=>31,    // Mar
   4=>30,    // Apr
   5=>31,    // Mei
   6=>30,    // Juni
   7=>31,    // Juli
   8=>31,    // Aug
   9=>30,    // Sep
   10=>31,   // Oct
   11=>30,   // Nov
   12=>31);  // Des
   $nmonth = $init_month[$month];
   return $nmonth;
}
function frmDate($date,$code){
   $explode = explode("-",$date);
   $year  = $explode[0];
   $month = (substr($explode[1],0,1)=="0")?str_replace("0","",$explode[1]):$explode[1];
   $dated = $explode[2];
   $explode_time = explode(" ",$dated);
   $dates = $explode_time[0];
   switch($code){
   // Per Object
      case 4: $format = $dates; break;
      case 5: $format = $month; break;
      case 6: $format = $year; break;
   }
   return $format;
}
function getRange($start,$end){
   $xdate = frmDate($start,4);
   $ydate = frmDate($end,4);
   $xmonth = frmDate($start,5);
   $ymonth = frmDate($end,5);
   $xyear = frmDate($start,6);
   $yyear = frmDate($end,6);
   if($xyear==$yyear){
      if($xmonth==$ymonth){
         $nday=$ydate+1-$xdate;
      } else {
         $r2=NULL;
         $nmonth = $ymonth-$xmonth;
         $r1 = nmonth($xmonth)-$xdate+1;
         for($i=$xmonth+1;$i<$ymonth;$i++){
            $r2 = $r2+nmonth($i);
         }
         $r3 = $ydate;
         $nday = $r1+$r2+$r3;
      }
   } else {
      $r2=NULL; $r3=NULL;
      $r1=nmonth($xmonth)-$xdate+1;
      for($i=$xmonth+1;$i<13;$i++){
         $r2 = $r2+nmonth($i);
      }
      for($i=1;$i<$ymonth;$i++){
         $r3 = $r3+nmonth($i);
      }
      $r4 = $ydate;
      $nday = $r1+$r2+$r3+$r4;
   }
   return $nday;
}
//tambahan end
function daterange_to_id($date1, $date2) {
   $a = explode('-', $date1);
   $b = explode('-', $date2);
   if (empty($date1) || empty($date2)) {
      return '';
   }
   if ($date1 == $date2) {
      $m = get_month($b[1]);
      return "{$a[2]} $m {$a[0]}";
   } else if (($a[1] == $b[1]) && ($a[0] == $b[0])) {
      $m = get_month($b[1]);
      return "{$a[2]} s.d {$b[2]} $m {$a[0]}";
   } else if (($a[1] != $b[1]) && ($a[0] == $b[0])) {
      $m = get_month($a[1]);
      $m2 = get_month($b[1]);
      return "{$a[2]} $m s.d {$b[2]} $m2 {$a[0]}";
   } else {
      $m = get_month($a[1]);
      $m2 = get_month($b[1]);
      return "{$a[2]} $m {$a[0]} s.d {$b[2]} $m2 {$b[0]}";
   }
}
function daterange_to_id_short($date1, $date2) {
   $a = explode('-', $date1);
   $b = explode('-', $date2);
   if (empty($date1) || empty($date2)) {
      return '';
   }
   if ($date1 == $date2) {
      $m = get_month($b[1]);
      return "{$a[2]} $m {$a[0]}";
   } else {
      $m = get_month($b[1]);
      return "{$a[2]} s.d {$b[2]} $m";
   }
}
function daterange_to_id_br($date1, $date2) {
   $a = explode('-', $date1);
   $b = explode('-', $date2);
   if (empty($date1) || empty($date2)) {
      return '';
   }
   if ($date1 == $date2) {
      $m = get_month($b[1]);
      return "{$a[2]} $m {$a[0]}";
   } else if (($a[1] == $b[1]) && ($a[0] == $b[0])) {
      $m = get_month($b[1]);
      return "{$a[2]} s.d {$b[2]}<br>$m {$a[0]}";
   } else if (($a[1] != $b[1]) && ($a[0] == $b[0])) {
      $m = get_month($a[1]);
      $m2 = get_month($b[1]);
      return "{$a[2]} $m s.d<br>{$b[2]} $m2 {$a[0]}";
   } else {
      $m = get_month($a[1]);
      $m2 = get_month($b[1]);
      return "{$a[2]} $m {$a[0]} s.d<br>{$b[2]} $m2 {$b[0]}";
   }
}
function daterange_to_id2($date1, $date2) {
   $a = explode('-', $date1);
   $b = explode('-', $date2);
   if (($a[1] == $b[1]) && ($a[0] == $b[0])) {
      $m = get_month2($b[1]);
      return "{$a[2]} s.d {$b[2]} $m {$a[0]}";
   } else if (($a[1] != $b[1]) && ($a[0] == $b[0])) {
      $m = get_month2($a[1]);
      $m2 = get_month2($b[1]);
      return "{$a[2]} $m s.d {$b[2]} $m2 {$a[0]}";
   } else {
      $m = get_month2($a[1]);
      $m2 = get_month2($b[1]);
      return "{$a[2]} $m {$a[0]} s.d {$b[2]} $m2 {$b[0]}";
   }
}
function daterange_to_bahasa($date1, $date2) {
   $a = explode('-', $date1);
   $b = explode('-', $date2);
   if (($a[1] == $b[1]) && ($a[0] == $b[0])) {
      $m = get_month($b[1]);
      return "{$a[2]} s.d {$b[2]} bulan $m tahun {$a[0]}";
   } else if (($a[1] != $b[1]) && ($a[0] == $b[0])) {
      $m = get_month($a[1]);
      $m2 = get_month($b[1]);
      return "{$a[2]} bulan $m s.d {$b[2]} bulan $m2 tahun {$a[0]}";
   } else {
      $m = get_month($a[1]);
      $m2 = get_month($b[1]);
      return "{$a[2]} bulan $m tahun {$a[0]} s.d {$b[2]} bulan $m2 tahun {$b[0]}";
   }
}
function daterange_to_sertif($date1, $date2) {
   $a = explode('-', $date1);
   $b = explode('-', $date2);
   if (($a[1] == $b[1]) && ($a[0] == $b[0])) {
      $m = get_month($b[1]);
      return "{$a[2]} sampai dengan {$b[2]} $m {$a[0]}";
   } else if (($a[1] != $b[1]) && ($a[0] == $b[0])) {
      $m = get_month($a[1]);
      $m2 = get_month($b[1]);
      return "{$a[2]} $m sampai dengan {$b[2]} $m2 {$a[0]}";
   } else {
      $m = get_month($a[1]);
      $m2 = get_month($b[1]);
      return "{$a[2]} $m {$a[0]} sampai dengan {$b[2]} $m2 {$b[0]}";
   }
}
function datetime_to_id($datetime = NULL) {
   if ($datetime == NULL) {
      return '';
   } else {
      $a = explode(' ', $datetime);
      $b = explode('-', $a[0]);
      $m = get_month($b[1]);
   }
   return "{$b[2]} $m {$b[0]} Pukul ".substr($a[1], 0, 5);
}
function datetime_to_date($datetime = NULL) {
   if ($datetime == NULL) {
      return '';
   } else {
      $a = explode(' ', $datetime);
      $b = explode('-', $a[0]);
      $m = get_month($b[1]);
   }
   return "{$b[2]} $m {$b[0]}";
}
function datetime_to_jam($datetime = NULL) {
   if ($datetime == NULL) {
      return '';
   } else {
      $a = explode(' ', $datetime);
      $b = explode('-', $a[0]);
   }
   return substr($a[1], 0, 5);
}
function date_to_id($date = NULL) {
   if ($date == NULL) {
      return '';
   } else {
      $a = explode('-', $date);
      $m = get_month($a[1]);
   }
   return "{$a[2]} $m {$a[0]}";
}
function date_to_hariid($date = NULL) {
   if ($date == NULL) {
      return '';
   } else {
      $a = explode('-', $date);
      $m = get_month($a[1]);
      $h = get_day($a[2]);
   }
   return nama_hari($date).", ".$a[2]." ".$m." ".$a[0];
}
function date_to_hari($date1 = NULL,$date2 = NULL) {
   if ($date1 == NULL || $date2 == NULL) {
      return '';
   } else {
      $a = explode('-', $date1);
      $m = get_month($a[1]);
      $h = get_day($a[2]);
   }
   if ($date1 == $date2) {
      return nama_hari($date1);
   }else{
      return nama_hari($date1)." s.d ".nama_hari($date2);
   }
}
function get_month($month) {
   switch ($month) {
      case '01':
      $m = 'Januari';
      break;
      case '02':
      $m = 'Februari';
      break;
      case '03':
      $m = 'Maret';
      break;
      case '04':
      $m = 'April';
      break;
      case '05':
      $m = 'Mei';
      break;
      case '06':
      $m = 'Juni';
      break;
      case '07':
      $m = 'Juli';
      break;
      case '08':
      $m = 'Agustus';
      break;
      case '09':
      $m = 'September';
      break;
      case '10':
      $m = 'Oktober';
      break;
      case '11':
      $m = 'November';
      break;
      default:
      $m = 'Desember';
      break;
   }
   return $m;
}
function get_bulan($month) {
   switch ($month) {
      case '01':
      $m = 'Januari';
      break;
      case '02':
      $m = 'Februari';
      break;
      case '03':
      $m = 'Maret';
      break;
      case '04':
      $m = 'April';
      break;
      case '05':
      $m = 'Mei';
      break;
      case '06':
      $m = 'Juni';
      break;
      case '07':
      $m = 'Juli';
      break;
      case '08':
      $m = 'Agustus';
      break;
      case '09':
      $m = 'September';
      break;
      case '10':
      $m = 'Oktober';
      break;
      case '11':
      $m = 'November';
      break;
      case '12':
      $m = 'Desember';
      break;
      default:
      $m = '';
      break;
   }
   return $m;
}
function get_month2($month) {
   switch ($month) {
      case '01':
      $m = 'Jan';
      break;
      case '02':
      $m = 'Feb';
      break;
      case '03':
      $m = 'Mar';
      break;
      case '04':
      $m = 'Apr';
      break;
      case '05':
      $m = 'Mei';
      break;
      case '06':
      $m = 'Juni';
      break;
      case '07':
      $m = 'Juli';
      break;
      case '08':
      $m = 'Agustus';
      break;
      case '09':
      $m = 'Sep';
      break;
      case '10':
      $m = 'Okt';
      break;
      case '11':
      $m = 'Nov';
      break;
      default:
      $m = 'Desember';
      break;
   }
   return $m;
}
function arr_month() {
   $bulan = array(
      "01"=>"Januari",
      "02"=>"Februari",
      "03"=>"Maret",
      "04"=>"April",
      "05"=>"Mei",
      "06"=>"Juni",
      "07"=>"Juli",
      "08"=>"Agustus",
      "09"=>"September",
      "10"=>"Oktober",
      "11"=>"November",
      "12"=>"Desember"
   );
   return $bulan;
}