<?php
//-------  retirement date calculation
function ret_dt($dob)
{
//echo $dob;  
$date_elements = explode("-", $dob);
$dd = $date_elements[2];
$mm = $date_elements[1];
$yy = $date_elements[0];

if ((int)$dd > 1)
   {
     $mm = (int)$mm + 1;
     $dd = 1;
   }
else
   {
     $dd = 1;
   } 
if ((int)$mm == 13)
   {
     $mm = 1;
     $yy = $yy + 1;
   }
$yy = $yy + 60;
$mm =  str_pad($mm,2,"0",STR_PAD_LEFT);
$dd =  str_pad($dd,2,"0",STR_PAD_LEFT);

$dt = $yy . "-" . $mm . "-" . $dd; //e.g $dt = 2038-09-01
$r_dt=strtotime($dt);    //$r_dt = 2166892200
$ret_date=date("Y-m-d",strtotime("-1 days", $r_dt)); //$ret_date = 2038-08-31
$date_elements = explode("-", $ret_date);
$dd = $date_elements[2];
$mm = $date_elements[1];
$yy = $date_elements[0];
$ret_dt = $dd . "-" . $mm . "-" . $yy;
return $ret_dt;
}

//-------  Date for a specific yrs of service calculation (dt. of joining + yrs.)
function seryr_dt($doj,$ser_yr)
{
$ser_yr = (int)($ser_yr);

$date_elements = explode("-", $doj);
$dd = $date_elements[0];
$mm = $date_elements[1];
$yy = $date_elements[2];


$yy = $yy + $ser_yr;
$mm =  str_pad($mm,2,"0",STR_PAD_LEFT);
$dd =  str_pad($dd,2,"0",STR_PAD_LEFT);

$dt = $yy . "-" . $mm . "-" . $dd; //e.g $dt = 2038-09-01
$r_dt=strtotime($dt);    //$r_dt = 2166892200
$ret_date=date("Y-m-d",strtotime("-1 days", $r_dt)); //$ret_date = 2038-08-31
$date_elements = explode("-", $ret_date);
$dd = $date_elements[2];
$mm = $date_elements[1];
$yy = $date_elements[0];
$ret_dt = $dd . "-" . $mm . "-" . $yy;
return $ret_dt;
}

//-------  Date for a specific yrs from retirement dt.(dt. of retirement - yrs.)
function yr_fm_ret($dor,$ret_fm_yr)
{

$ret_fm_yr = (int)($ret_fm_yr);

$date_elements = explode("-", $dor);
$dd = $date_elements[0];
$mm = $date_elements[1];
$yy = $date_elements[2];

$yy = $yy - $ret_fm_yr;
$mm =  str_pad($mm,2,"0",STR_PAD_LEFT);
$dd =  str_pad($dd,2,"0",STR_PAD_LEFT);

$dt = $yy . "-" . $mm . "-" . $dd; //e.g $dt = 2038-09-01
$r_dt=date("Y-m-d",strtotime($dt));    //$r_dt = 2166892200
//echo "ttt-",$r_dt,"</br>";
$ret_date=date("Y-m-d",$r_dt); //$ret_date = 2038-08-31
//echo "yyy-",$ret_date,"</br>";
$date_elements = explode("-", $ret_date);
$dd = $date_elements[2];
$mm = $date_elements[1];
$yy = $date_elements[0];
$ret_dt = $dd . "-" . $mm . "-" . $yy;
return $ret_dt;
}
// date is given in dd-mm-yyyy format and converted to yyyy-mm-dd format
function date_conv_reverse($dt)
{
$date_elements = explode("-",$dt);
$dt = trim($date_elements[2]) . "-" . trim($date_elements[1]) ."-" .  trim($date_elements[0]);
return $dt;
}
//-- Calculation of retirement date ends here
//-- conversion  of yyyy-mm-dd to dd-mm-yyyy

function date_conv($dt)
{
$date_elements = explode("-",$dt);
$dt = $date_elements[2] . "-" . $date_elements[1] ."-" .  $date_elements[0];
return $dt;
}
// increment or decrement of particular days from a particular date  dd-mm-yyyy to be sent
// (5,23-04-2010) will return 28-04-2010
function dt_incr($incr_cnt,$st_date)
{
$date_elements = explode("-", $st_date);
$date_from = $date_elements[2] . "/" . $date_elements[1] . "/" . $date_elements[0];
$dt=date("Y-m-d",strtotime($date_from));
$st_dt=strtotime($dt);
$p_date_ymd=date("Y-m-d",strtotime("+$incr_cnt days", $st_dt));
$dt = date("d-m-Y",strtotime($p_date_ymd));
return $dt;
}
// -- Coversion of yyyy-mm-dd to dd/mm/yyyy
function date_conv_yy($dt)
{
$date_elements = explode("-",$dt);
$dt = $date_elements[2] . "/" . $date_elements[1] ."/" .  substr($date_elements[0],0,4);
return $dt;
}
// -- CALCULATION OF NO. OF DAYS BETWEEN TWO DAYS
// -- i.e 23-04-2010 :: 21-04-2010 format to be sent dd-mm-yyyy
function dt_difference($en_date,$st_date)
{
$date_elements = explode("-", $st_date);
$date_from = mktime(0,0,0,$date_elements[1] ,  $date_elements[0] ,  $date_elements[2]);
$date_elements = explode("-", $en_date);
$date_to = mktime(0,0,0,$date_elements[1] ,  $date_elements[0] ,  $date_elements[2]);
$diff = $date_to-$date_from;
//$dt_diff = (int) (($diff/86400)+.5);
$diff_abs = abs($diff);
$dt_diff =  (($diff_abs/86400)+.5);
if ($diff<0)
{
 $dt_diff = (int)(-1 * $dt_diff);
}
else
{
 $dt_diff = (int) $dt_diff;
}
return $dt_diff;
}

//-------  convert numeric value to word -----------------
function retWord($Num) 
{
$Num = (int)$Num;
$out = "N";
$int_amt = 0;
$int_amt1 = 0;
$int_amt2 = 0;

$a = $Num;

while($out== "N")
 {
   
 if ($a > 9999999)
  {
   $int_amt = (int)($a/10000000);
   $a = $a - (int)($int_amt * 10000000);
   if ((int)$int_amt > 10)
    {
     $int_amt2 = (int)($int_amt / 10);
     $int_amt1 = $int_amt -(int)($int_amt2 * 10);
    }
   else
    {
     $int_amt2 = 0;
     $int_amt1 = $int_amt;
    }
   $rem_int  = rem_amt($int_amt2, $int_amt1);
   $cr_rem   = $rem_int . "Crore ";
  }
else
  {
   if ($a > 99999)
     {
      $int_amt = (int)($a/100000);
      $a = $a - (int)($int_amt * 100000);
      if ((int)$int_amt >10)
         {
         $int_amt2 = (int)($int_amt / 10);
         $int_amt1 = $int_amt -(int)($int_amt2 * 10);
         }
	  else
         {
		 $int_amt2 = 0;
         $int_amt1 = $int_amt;
         }
		 
      $rem_int  = rem_amt($int_amt2, $int_amt1);
      $lakh_rem = $rem_int . "Lakh ";
     }
   else
      {
       if ($a > 999)
          {
           $int_amt = (int)($a/1000);
                       
          $a = $a - (int)($int_amt * 1000);
                    
		  if ((int)$int_amt > 10)
            {
             $int_amt2 = (int)($int_amt / 10);
             $int_amt1 = $int_amt -(int)($int_amt2 * 10);
            }
		  else
		    {
             $int_amt2 = 0;
             $int_amt1 = $int_amt;
            }
                
          $rem_int  = rem_amt($int_amt2, $int_amt1);
          
	      $thou_rem = $rem_int . "Thousand ";
             }
       else
       {
		   if ((int)$a > 99)
		    {
		        $int_amt = (int)($a/100);
		        		        
                $a = $a - (int)($int_amt * 100);
              
			  if ((int)$int_amt > 10)
			   {
               $int_amt2 = (int)($int_amt / 10);
               $int_amt1 = $int_amt -((int)$int_amt2 * 10);
               }
			  else
               {
                 
			   $int_amt2 = 0;
               $int_amt1 = $int_amt;
               
               }
                 
              $rem_int  = rem_amt($int_amt2, $int_amt1);
              $hun_rem = $rem_int . "Hundred ";
           }
		   else
		   {
		     
              $int_amt = $a; 
              $int_amt2 = (int)($int_amt/10);
                  if ($int_amt2 == ""){$int_amt2 = 0;}
                  if ($int_amt2 < 1){$int_amt2 = 0;}
              $int_amt1 = $int_amt - ((int)$int_amt2*10);
              $rem_int  = rem_amt($int_amt2, $int_amt1);
              $unit_rem = $rem_int;
              $out = "Y";
              
           }
		} 
    }         
  }
 }
  
$retword = $retword . $cr_rem . $lakh_rem . $thou_rem . $hun_rem . $unit_rem;

$retword = "(Rupees " . $retword . " only) "; 

return $retword;
}


function rem_amt($amt2,$amt1)
{ 
   
IF ((int)$amt2 == 1)
   {
        
   if ($amt1 == 0) { $remword = "Ten ";       }      
   if ($amt1 == 1) { $remword = "Eleven ";    }   
   if ($amt1 == 2) { $remword = "Twelve " ;   }       
   if ($amt1 == 3) { $remword = "Thirteen ";  }      
   if ($amt1 == 4) { $remword = "Fourteen ";  }     
   if ($amt1 == 5) { $remword = "Fifteen " ;  }      
   if ($amt1 == 6) { $remword = "Sixteen " ;  }      
   if ($amt1 == 7) { $remword = "Seventeen "; }     
   if ($amt1 == 8) { $remword = "Eighteen " ; }     
   if ($amt1 == 9) { $remword = "Nineteen " ; }     
   }
ELSE
   {
    
   if ($amt2 == 2) { $remword = "Twenty ";}
   if ($amt2 == 3) { $remword = "Thirty ";}
   if ($amt2 == 4) { $remword = "Forty ";}
   if ($amt2 == 5) { $remword = "Fifty ";}
   if ($amt2 == 6) { $remword = "Sixty ";}
   if ($amt2 == 7) { $remword = "Seventy ";}
   if ($amt2 == 8) { $remword = "Eighty ";}
   if ($amt2 == 9) { $remword = "Ninety ";}
   if ($amt2 == 0) { $remword = "";}
   
   if ($amt1 == 1) { $remword = $remword . "One "   ; }   
   if ($amt1 == 2) { $remword = $remword . "Two "   ; }    
   if ($amt1 == 3) { $remword = $remword . "Three " ; }   
   if ($amt1 == 4) { $remword = $remword . "Four "  ; }   
   if ($amt1 == 5) { $remword = $remword . "Five "  ; }   
   if ($amt1 == 6) { $remword = $remword . "Six "   ; }   
   if ($amt1 == 7) { $remword = $remword . "Seven " ; }   
   if ($amt1 == 8) { $remword = $remword . "Eight " ; }   
   if ($amt1 == 9) { $remword = $remword . "Nine "  ; }   
   if ($amt1 ==10) { $remword = $remword . "Ten "   ; }   
   }



return $remword;

}
//-----------Number to words ends here ---------
//-- to return financial year along with first day,last day of that fin year and starting date of the month of which the date is passed as parameter
function financial_year($dt)
{
  $dd = substr($dt,0,2);  
  $mm = substr($dt,3,2);  
  $yy = substr($dt,6,4);  
  $mm = (int) $mm;
  $m_st_dt = "01-".  str_pad($mm,2,"0",STR_PAD_LEFT) . "-" . $yy;

if ($mm >3 && $mm <= 12)
{
			   $f_day = "01-04-" . $yy;
              
			   $l_day = "31-03-" . ((int) $yy + 1);
               $fin_year = $yy . "-" . ((int) $yy + 1);
}
else
    {
           	   $f_day = "01-04-" . ((int) $yy - 1);
               $l_day = "31-03-" . $yy ;
               $fin_year = ((int) $yy - 1) . "-" . $yy;
	
              
    
           }


$f_year[0] = $f_day;
$f_year[1] = $l_day;
$f_year[2] = $fin_year;
$f_year[3] = $m_st_dt;

return $f_year;
}
// for factory fin year ranges from march to feb since march is paid in april like wise fin yr last day and first day gets modifued 
function financial_year_pay($dt)
{
  $dd = substr($dt,0,2);  
  $mm = substr($dt,3,2);  
  $yy = substr($dt,6,4);  
  $mm = (int) $mm;

   $chk_yy = $yy + 1;

$l_y = "N";
if ($chk_yy % 100 == 0)
 {
  if ($chk_yy % 400 == 0)
   {
     $l_y = "Y";
   }
 }
 else
 {
  if ($chk_yy % 4 == 0)
  {
   $l_y = "Y";
  }
 }
    
  $m_st_dt = "01-".  str_pad($mm,2,"0",STR_PAD_LEFT) . "-" . $yy;
if ($mm >2 && $mm <= 12)
{
			   $f_day = "01-03-" . $yy;
               if ($l_y == "Y")
               {
			   $l_day = "29-02-" . ((int) $yy + 1);
               }
               else
               {
                $l_day = "28-02-" . ((int) $yy + 1);
               }
               $fin_year = $yy . "-" . ((int) $yy + 1);
}
else
    {
    $chk_yy = $yy;
    $l_y = "N";
    if ($chk_yy % 100 == 0)
        {
        if ($chk_yy % 400 == 0)
            {
                $l_y = "Y";
            }
        }
    else
    {
        if ($chk_yy % 4 == 0)
         {
            $l_y = "Y";
        }
    }

               $f_day = "01-03-" . ((int) $yy - 1);
               if ($l_y == "Y")
               {               
               $l_day = "29-02-" . $yy ;
               }
               else
               {
                $l_day = "28-02-" . $yy ;
               }
               $fin_year = ((int) $yy - 1) . "-" . $yy;
	
              
    
           }


$f_year[0] = $f_day;
$f_year[1] = $l_day;
$f_year[2] = $fin_year;
$f_year[3] = $m_st_dt;

return $f_year;
}

function money_break($val)
{
$l = 0;
$i=10;
$sl=1;
while(true)
{

    $rem = fmod($val,10);
    $val = (int)($val / 10);
  //echo $rem,"-",$val,"-",$i,"<br>";
     $l=$sl-1;
	 $arr[$l] = $rem;	
    
    
    if ($val == 0)
       break;
	$sl++;  
    
}
for ($i=$sl;$i<=9;$i++)
{
  $arr[$i]=0;
}

return $arr;
}
function money_break_place($val)
{
$tot_arr = array(
0=>'ZERO',
1=>'ONE',	
2=>'TWO',	
3=>'THREE',	
4=>'FOUR',	
5=>'FIVE',	
6=>'SIX',	
7=>'SEVEN',	
8=>'EIGHT',	
9=>'NINE',	
10=>'TEN',	
11=>'ELEVEN',	
12=>'TWELVE',
13=>'THIRTEEN',	
14=>'FOURTEEN',	
15=>'FIFTEEN',
16=>'SIXTEEN',	
17=>'SEVENTEEN',
18=>'EIGHTEEN',	
19=>'NINETEEN',	
20=>'TWENTY',
30=>'THIRTY',
40=>'FORTY',
50=>'FIFTY',
60=>'SIXTY',
70=>'SEVENTY',
80=>'EIGHTY',
90=>'NINETY',
) ; 

$l = 0;
$i=10;
$sl=1;

while(true)
{

    $rem = fmod($val,10);
    $val = (int)($val / 10);
  
        
    
	if ($sl == 1)         
		$arr[0] = $tot_arr[$rem];
	if ($sl == 2)         
		$arr[1] = $tot_arr[$rem];
	if ($sl == 3)         
		$arr[2] = $tot_arr[$rem];
	if ($sl==4)
	  {
	   $arr[3] = $tot_arr[$rem];
	   $prev_rem = $rem;
	  }
	if ($sl == 5)
	{
	  if ($rem != 0)
	  {
	   $x = $rem * 10;
	   if ($prev_rem != 0)
	   {
	    $words = $tot_arr[$prev_rem];
	    $words = $tot_arr[$x] . "-".$words;  
	    if ($x < 20) // for numbers like 15000 to 19999
	    {
		 $temp_val = $x + $prev_rem;
		 $words = $tot_arr[$temp_val]; 
		}
	   }
	   else
	   {
	    $words = $tot_arr[$x];
	   }
	   $arr[3] = $words;
	  }
	  
	}
	if ($sl==6)
	  {
	   $arr[4] = $tot_arr[$rem];
	   
	   $prev_rem = $rem;
	  }
	if ($sl == 7)
	
	/*{
	  if ($rem != 0)
	  {
	   $x = $rem * 10;
	   if ($prev_rem != 0)
	   {
	    $words = $tot_arr[$prev_rem];
	    $words = $tot_arr[$x] . "-".$words;  
	   }
	   else
	   {
	    $words = $tot_arr[$x];
	   }
	   $arr[4] = $words;
	  }
	  
	}*/
	{
	  if ($rem != 0)
	  {
	   $x = $rem * 10;
	   if ($prev_rem != 0)
	   {
	    $words = $tot_arr[$prev_rem];
	    $words = $tot_arr[$x] . "-".$words;  
	    if ($x < 20) // for numbers like 15000 to 19999
	    {
		 $temp_val = $x + $prev_rem;
		 $words = $tot_arr[$temp_val]; 
		}
	   }
	   else
	   {
	    $words = $tot_arr[$x];
	   }
	   $arr[4] = $words;
	  }
	  
	}
	
	if ($sl==8)
	  {
	   $arr[5] = $tot_arr[$rem];
	   $prev_rem = $rem;
	  }
	if ($sl == 9)
	{
	  if ($rem != 0)
	  {
	   $x = $rem * 10;
	   if ($prev_rem != 0)
	   {
	    $words = $tot_arr[$prev_rem];
	    $words = $tot_arr[$x] . "-".$words;  
	   }
	   else
	   {
	    $words = $tot_arr[$x];
	   }
	   $arr[5] = $words;
	  }
	  $prev_rem1 = $rem;  
	}
	if ($sl == 10)
	{
	  if ($prev_rem == 0 && $prev_rem1 == 0) 
	  {
	    $arr[5] = $tot_arr[$rem]." Hundred";  
	  }
	  else
	  {
	    $arr[5] = $tot_arr[$rem]." Hundred ".$words;  
	  }
	}
//	echo $sl,"-",$rem,"-",$val,"ccc<br>";
	if ($val == 0)
       break;

	$sl++;  
    
}
//echo $sl,"<br>";
$sl++;
for ($i=$sl;$i<=9;$i++)
{
  if ($i == 2 )
  {
    $arr[1] ="ZERO";  
  }
  if ($i == 3 )
  {
    $arr[2] ="ZERO";  
  }
  if ($i == 4 )
  {
    $arr[3] ="ZERO";  
  }
  if ($i == 6 )
  {
    $arr[4] ="ZERO";  
  }
  if ($i == 8   )
  {
    $arr[5] ="ZERO";  
  }
  
}

/*for ($i=0;$i<=5;$i++)
{
  echo $arr[$i],"s<br>";
}
*/
return $arr;
}
function work_day_calc($dt)
{
 global $payroll;
 
$dt__ymd = date_conv_reverse($dt);
 
$i=1;
 while (true)
 {
 $dt_dmy= date('d-m-Y',strtotime("-$i day",strtotime($dt__ymd)));

 $dt_ymd= date('Y-m-d',strtotime("-$i day",strtotime($dt__ymd)));
 $day_name = strtoupper(date('D',strtotime("-$i day",strtotime($dt__ymd))));
 if ($day_name == "SUN")
 {
   $i++;
 }
 else
 {
   $hol_stmt = "select count(*) cnt  from wage_param where typ ='holiday'".
               " and shdes[1,10]='$dt_dmy'";
  // echo $hol_stmt,"<br>";
   $hol_stmt = $payroll -> query($hol_stmt);
   $r_hol = $hol_stmt -> fetch(PDO::FETCH_ASSOC);
   if ($r_hol[CNT] == "")
    {
       $r_hol[CNT] = 0;
    }
   if ($r_hol[CNT] == 0)
   {
     break;
   }
  $i++;
  }
 }
$prev_work_day = $dt_dmy;


$dt__ymd = date_conv_reverse($dt);
$i=1;
 while (true)
 {
 $dt_dmy= date('d-m-Y',strtotime("+$i day",strtotime($dt__ymd)));
 $dt_ymd= date('Y-m-d',strtotime("+$i day",strtotime($dt__ymd)));
 $day_name = strtoupper(date('D',strtotime("+$i day",strtotime($dt__ymd))));
 if ($day_name == "SUN")
 {
   $i++;
  continue;
 }
 else
 {
   $hol_stmt = "select count(*)cnt  from wage_param where typ ='holiday'".
               " and shdes[1,10]='$dt_dmy'";
   
   $hol_stmt = $payroll -> query($hol_stmt);
   $r_hol = $hol_stmt -> fetch(PDO::FETCH_ASSOC);
   if ($r_hol[CNT] == "")
    {
       $r_hol[CNT] = 0;
    }
   if ($r_hol[CNT] == 0)
   {
     break;
   }
  $i++;
  }
 }
$next_work_day = $dt_dmy;
$arr[0]=$prev_work_day;
$arr[1]=$next_work_day;
return $arr;
}
function p_yrmn($yrmn)
{
  $yy = (int)substr($yrmn,0,4);
  $mm = (int)substr($yrmn,4,2);
  $mm--;
  if($mm == 0)
  {
    $mm = 12;
	$yy--;  
  }
  $yrmn = str_pad($yy,4,"0",STR_PAD_LEFT).str_pad($mm,2,"0",STR_PAD_LEFT);
  return $yrmn;
}

function lv_pay_day_calc($this_month_st_dt,$this_month_en_dt,$lv_typ,$lv_from,$lv_to,$stat)
{
global $payroll;
if ($lv_typ == 'SPL')
	{
  		$lv_typ= 'CLV';
	}
/*
$this_month_st_dt = "01-07-2018";
$this_month_en_dt = "31-07-2018";
$stat = "P";
$lv_typ = 'ELV';
$lv_from = '02-07-2018';
$lv_to   = '10-07-2018';
*/
$lv_from_yrmn = (int)(substr($lv_from,6).substr($lv_from,3,2));
$lv_to_yrmn   = (int)(substr($lv_to,6).substr($lv_to,3,2));
$this_yrmn    = (int)(substr($this_month_st_dt,6).substr($this_month_st_dt,3,2));


//CHECKING FOR CROSS OVER OF PAYMENT MONTH
//echo "<br>",$lv_from_yrmn,"-",$lv_to_yrmn,"-",$this_yrmn;

if ($stat == 'P')
{
$stat = "D";
if ((substr($lv_to,3) != substr($this_month_st_dt,3))&&($lv_to_yrmn>$this_yrmn)) //lv_From=120618 lv_to=200918 pay month july 2018
   {
    
   if ($lv_from_yrmn < $this_yrmn)
   { 
    $lv_to = $this_month_en_dt;
	$lv_from = $this_month_st_dt;
    $stat = 'P';
   }
   if ($lv_from_yrmn == $this_yrmn)
   {
    $lv_to = $this_month_en_dt;
	
    $stat = 'P';   
   }
  if ($lv_from_yrmn > $this_yrmn)
   {
    
	
    $stat = 'Y';   
   }

   
 }
 }



//

if ($stat == 'X')
{
$i=0;
$stat= "D";
//echo "<br>$lv_to -$lv_to_yrmn-$this_yrmn-$this_month_st_dt-" ;
if ((substr($lv_to,3) != substr($this_month_st_dt,3))&&($lv_to_yrmn>$this_yrmn)) //lv_From=120618 lv_to=200918 pay month july 2018
   {
     
	 if ($lv_from_yrmn <= $this_yrmn)
	 {
	
	   $lv_to = $this_month_en_dt;
       $stat = "P";
	 }
	 else
	 {
	   
	   $stat = "Y";  
	 }
	 
   } 

}

//stat Y indicated total lv period next month . stat will be changed to P
//CALCULATION OF ARR DAYS AND CURR DAYS

$lv_from_yr = substr($lv_from,6);
$lv_to_yr = substr($lv_to,6);
$this_yrmn = (int)(substr($this_month_st_dt,6).substr($this_month_st_dt,3,2));
$sel_stmt = "select shdes from wage_param where typ = 'holiday' and cd between '$lv_from_yr' and '$lv_to_yr'";
$sel_stmt = $payroll -> query($sel_stmt);
$r_sel = $sel_stmt -> fetch(PDO::FETCH_ASSOC);
$arr[0]="0";
$sl=1;
while ($r_sel)
{
 $arr[$sl] = trim($r_sel[SHDES]) ;
 $sl++;
 $r_sel = $sel_stmt -> fetch(PDO::FETCH_ASSOC); 
}


$lv_from_yrmn = (int)(substr($lv_from,6).substr($lv_from,3,2));
$lv_to_yrmn = (int)(substr($lv_to,6).substr($lv_to,3,2));

$curr_lv_pay_days = 0;
$arr_lv_pay_days = 0;
$intermediate_holiday_arr = 0;
$intermediate_holiday_curr = 0;
if ($stat != 'Y')
{
  
    $dt__ymd = date_conv_reverse($lv_from);
    $i=0;    
    
     while(true)
     {
      $dt_dmy= date('d-m-Y',strtotime("+$i day",strtotime($dt__ymd)));
      $dt_ymd= date('Y-m-d',strtotime("+$i day",strtotime($dt__ymd)));
      $day_nam= strtoupper(date('D',strtotime("+$i day",strtotime($dt__ymd))));
     
	  if (substr($dt_dmy,3) != substr($this_month_st_dt,3))
      {
	    switch ($lv_typ)
	    {
		  case "CLV":
		    if (($day_nam == 'SUN') || (in_array($dt_dmy,$arr)) ) 
	        {
			  if (in_array($dt_dmy,$arr))  
			  {
			    $intermediate_holiday_arr++;  
			  }
			}
		    else
		    {  
		      $arr_lv_pay_days++;
		      
		    }  
		    break;
		  default:
	  	    if ($day_nam == 'SUN')  
	        {}
		    else
		    {  
		      //echo "<br>$dt_dmy";
			  
			  $arr_lv_pay_days++;
			  //echo $this_month_st_dt,$this_month_en_dt,$lv_typ,$lv_from,$lv_to,$stat,"-",$arr_lv_pay_days,"<br>";
			  if (in_array($dt_dmy,$arr))  
			  {
			    $intermediate_holiday_arr++;  
			  }
		    }  
	        break; 
		}
		
		//echo "<br>z",$dt_dmy,"-",$day_nam;
	  }
	  else
	  {
        switch ($lv_typ)
	    {
		  case "CLV":
		    if (($day_nam == 'SUN') || (in_array($dt_dmy,$arr)) ) 
	        {
			  if (in_array($dt_dmy,$arr))  
			  {
			    $intermediate_holiday_curr++;  
			  }
			}
		    else
		    {  
      		  $curr_lv_pay_days++;
		    }  
		    break;
		  default:
	  	    if ($day_nam == 'SUN')  
	        {}
		    else
		    {  
              $curr_lv_pay_days++;
		      if (in_array($dt_dmy,$arr))  
			  {
			    $intermediate_holiday_curr++;  
			  }
			
			}  
	        break; 
		}
	    //echo "<br>y",$dt_dmy,"-",$day_nam;
	  }  
	  if (($dt_dmy == $this_month_en_dt) || ($dt_dmy == $lv_to))
	   {
	     
		 $lv_to = $dt_dmy;  
	     break;
       } 
	   $i++; 
     }
 } 

if ($stat == 'Y')
{
  $arr_lv_pay_days  = 0;
  $curr_lv_pay_days = 0;
  $lv_from="";
  $lv_to = "";
  $stat = 'P';
  $intermediate_holiday_arr = 0;
  $intermediate_holiday_curr = 0;
}

//echo "<br>",$lv_from,"-",$lv_to,"-",$stat,"<br>CURRENT-",$curr_lv_pay_days,"<br>ARR-",$arr_lv_pay_days;
 
$arr[0]=$arr_lv_pay_days;
$arr[1]=$curr_lv_pay_days;
$arr[2]=$stat;  
$arr[3]=$lv_from; //LEAVE PAID DATE RANGE
$arr[4]=$lv_to; 
$arr[5]=$intermediate_holiday_arr;
$arr[6]=$intermediate_holiday_curr;
/*if ((substr($lv_to,3) != substr($this_month_st_dt,3))&&($lv_from_yrmn<$this_yrmn)) //lv_From=120618 lv_to=200618 pay month july 2018
  lv_From and lv_to already catered */
  
//echo "<br>",$lv_from,"-",$lv_to,"-",$stat;
return $arr;
}
function rs_ps($val)
{
  $whole[0] = floor($val);
  //echo $val;
  $whole[1] = $val - $whole[0];
  $whole[1] = str_pad($whole[1],2,"0",STR_PAD_RIGHT);
  return $whole;
}

function last_dt($yrmn)
{
$yr = substr($yrmn,0,4);
$mm = substr($yrmn,4,2);
$dob = $yr."-".str_pad($mm,2,"0",STR_PAD_LEFT)."-01";
$date_elements = explode("-", $dob);
$dd = $date_elements[2];
$mm = $date_elements[1];
$yy = $date_elements[0];
$mm++;
if ((int)$mm == 13)
   {
     $mm = 1;
     $yy = $yy + 1;
   }
$mm =  str_pad($mm,2,"0",STR_PAD_LEFT);
$dd =  str_pad($dd,2,"0",STR_PAD_LEFT);

$dt = $yy . "-" . $mm . "-" . $dd; //e.g $dt = 2038-09-01
$r_dt=strtotime($dt);    //$r_dt = 2166892200
$ret_date=date("Y-m-d",strtotime("-1 days", $r_dt)); //$ret_date = 2038-08-31
$date_elements = explode("-", $ret_date);
$dd = $date_elements[2];
$mm = $date_elements[1];
$yy = $date_elements[0];
$ret_dt = $dd . "-" . $mm . "-" . $yy;
return $ret_dt;
}

function work_days($lv_from,$lv_to)
{
global $payroll;
//function for calculating the days except sundays and holidays
// or working days
//date should come in dd-mm-yyyy format
//echo $lv_from,"-",$lv_to,"<br>";
$lv_from_yr = substr($lv_from,6);
$lv_to_yr   = substr($lv_to,6);

$sel_stmt = "select shdes from wage_param where typ = 'holiday'
             and cd between '$lv_from_yr' and '$lv_to_yr'";
$sel_stmt = $payroll -> query($sel_stmt);
$r_sel = $sel_stmt -> fetch(PDO::FETCH_ASSOC);
$arr[0]="0";
$sl=1;
while ($r_sel)
{
 $arr[$sl] = trim($r_sel[SHDES]) ;
 $sl++;
 $r_sel = $sel_stmt -> fetch(PDO::FETCH_ASSOC);
}
 $dt__ymd = date_conv_reverse($lv_from);
    $i=0;
    $lv_days = 0;
     while(true)
     {
      $dt_dmy= date('d-m-Y',strtotime("+$i day",strtotime($dt__ymd)));
      $dt_ymd= date('Y-m-d',strtotime("+$i day",strtotime($dt__ymd)));
      $day_nam= strtoupper(date('D',strtotime("+$i day",strtotime($dt__ymd))));

          if (($day_nam == 'SUN') || (in_array($dt_dmy,$arr)) )
             {
             }
          else
            {
                $lv_days++;
            }
        if ($dt_dmy == $lv_to)
           {
             
             break;
           }
          // echo $i,"<br>";
        $i++;
     }
return $lv_days;
}

function lvDays($lv_from,$lv_to,$lv_typ)
{
global $payroll;
if ($lv_typ == 'SPL')
	{
  		$lv_typ= 'CLV';
	}
//function for calculating the days except sundays and holidays
// or working days
//date should come in dd-mm-yyyy format
//echo $lv_from,"-",$lv_to,"<br>";

$lv_from_yr = substr($lv_from,6);
$lv_to_yr   = substr($lv_to,6);

$sel_stmt = "select shdes from wage_param where typ = 'holiday'
             and cd between '$lv_from_yr' and '$lv_to_yr'";
$sel_stmt = $payroll -> query($sel_stmt);
$r_sel = $sel_stmt -> fetch(PDO::FETCH_ASSOC);
$arr[0]="0";
$sl=1;
while ($r_sel)
{
 $arr[$sl] = trim($r_sel[SHDES]) ;
 $sl++;
 $r_sel = $sel_stmt -> fetch(PDO::FETCH_ASSOC);
}
 $dt__ymd = date_conv_reverse($lv_from);
    $i=0;
    $lv_days = 0;
     while(true)
     {
      $dt_dmy= date('d-m-Y',strtotime("+$i day",strtotime($dt__ymd)));
      $dt_ymd= date('Y-m-d',strtotime("+$i day",strtotime($dt__ymd)));
      $day_nam= strtoupper(date('D',strtotime("+$i day",strtotime($dt__ymd))));

          if (($day_nam == 'SUN') || (in_array($dt_dmy,$arr)) )
             {
               if ($lv_typ != 'CLV')
               {
			     $lv_days++;     
			   }
             }
          else
            {
                $lv_days++;
            }
        if ($dt_dmy == $lv_to)
           {
             
             break;
           }
          // echo $i,"<br>";
        $i++;
     }
return $lv_days;
}
function month_st_en_dt($yrmn)
{
  
  $yr = substr($yrmn,0,4);
  $mm = substr($yrmn,4,2);
  $st_dt = "01-".str_pad($mm,2,"0",STR_PAD_LEFT)."-".str_pad($yr,4,"0",STR_PAD_LEFT);

  $mm++;
  if ($mm == 13)
  {
    $mm = 1;
	$yr++;  
  }
  $en_dt = str_pad($yr,4,"0",STR_PAD_LEFT)."-".str_pad($mm,2,"0",STR_PAD_LEFT)."-01";

  $en_dt =  date('d-m-Y',strtotime("-1 day",strtotime($en_dt)));

  $arr[0] = $st_dt;
  $arr[1] = $en_dt;
  return $arr;
}

function _e($str)
{
return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}

function select_fin_yr($tag)
{
$dt = date('d-m-Y',time());
$limit_fin_yr = "2021-2022";
$limit_dt = "01-10-2021";
$rem = "<select id='entry-$tag'   name='$tag'   >";
$rem .= "<option value ='S'>--Select--</option>";
while(true)
{
$fin = financial_year($dt);
if ($fin[2]==$limit_fin_yr)
 $fin[0]=$limit_dt;
$dt_range = $fin[0]."-".$fin[1];
$rem .= "<option value ='$dt_range'>$fin[2]</option>";
if ($fin[2] == $limit_fin_yr)
 break;
$dt = dt_incr("-1",$fin[0]);
}
$rem .= "</select>";
return $rem;
}
function select_f_yr($tag)
{
$dt = date('d-m-Y',time());
$limit_fin_yr = "2021-2022";
$limit_dt = "01-10-2021";
$rem = "<select id='entry-$tag'   name='$tag'   >";
$rem .= "<option value ='S'>--Select--</option>";
while(true)
{
$fin = financial_year($dt);
if ($fin[2]==$limit_fin_yr)
 $fin[0]=$limit_dt;
$dt_range = $fin[0]."-".$fin[1];
$rem .= "<option value ='$fin[2]'>$fin[2]</option>";
if ($fin[2] == $limit_fin_yr)
 break;
$dt = dt_incr("-1",$fin[0]);
}
$rem .= "</select>";
return $rem;
}

function select_mnth($tag)
{
$st_dt = "2022-04-01";
$limit_dt = "2023-03-01";
$rem = "<select id='mnth-$tag'   name='mnth-$tag'   >";
$rem .= "<option value ='S'>--Select--</option>";
$mnth = substr($st_dt,5,2);
$yr = substr($st_dt,0,4);
$i=0;
while(true)
{
$mnth += $i;
if ($mnth == 13)
{
  $mnth = 1;
  $yr++;
}
$dt = str_pad($yr,4,"0",STR_PAD_LEFT)."-".str_pad($mnth,2,"0",STR_PAD_LEFT)."-01";
$dt_mnth = date('M',strtotime($dt));
$rem .= "<option value ='$dt_mnth'>$dt_mnth</option>";
if ($dt == $limit_dt)
 break;
$i=1;
}
$rem .= "</select>";

return $rem;
}

?>
