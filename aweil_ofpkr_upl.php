<?php
$typ = 'aweil_inv';
/*
include("aweil_sessionHandler.php");
include("aweil_upl_chkAuthenticity.php");
*/
$usr= $_SESSION['username'];

?>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PL File Upload</title>
</head>
<script type="text/javascript" src="http://mis.rfi.net/jquery-1.11.1.js"></script>
<style type='text/css'>
BODY {
	FONT-SIZE: 11px; FONT-FAMILY: Consolas,sans-serif;
} 
input[type=text],input[type=file],input[type=submit],input[type=button],select,textarea{
  width: 80%;
  padding: 10px 10px;
  margin: 8px 0;
  border: 1px solid #000;
  border-radius: 5px;
  box-sizing: border-box; 
  display: block;
 
  FONT-FAMILY: Consolas,sans-serif;
}
input[type=file]::file-selector-button{
  border: 2px solid #B0CFDE;
  transition : 1s;
  background-color : #79BAEC;
  font-weight:bold;
  border-radius: 5px;
}
input[type=file]::file-selector-button:hover{
   background-color : #E6E6FA;
  border: 2px solid #92C7C7; 
}
	a{text-decoration:none;color:#000000;}
	td { background-color: #F8F6F0;
	padding:8px 15px;
	  border: 2px solid #E1E1E1; }
	
	td:nth-child(4) { text-align: right;font-weight:bold; }
	td:nth-child(10) { text-align: right;font-weight:bold; }
	td { text-align: center;font-weight:bold; }
	tr:hover {background-color: #A5FFFF;}
  
	.fix_table_head{
	  overflow-y: auto;
	  height:110px;
	}
	.fixhd thead th{
	  position:sticky;
	  top:0;
	}
	table{
	  border-collapse:collapse;
	  
	  
	  
	}
	th{
	  padding:8px 15px;
	  border: 2px solid #E1E1E1;
	  background: #A5B05F;
	  align:center;
	}
	
	

</style>
<body>
<center>
<p align='right'><a href='inv_oh_menu.php'>Back To Main Menu</a></p>	
<form name='entry' action='aweil_ofpkr_upl.php' method='POST' enctype="multipart/form-data">


<p align='center'><u><h2>P&L File Uploading for FOH-VOH  Module</h2></u></p>
<table align = 'center' width=40%;>
<tr>
<th align='center'><label for=caih_file>Select File
<input type="file" name = "caih_file" id="caih_file"></th>
</tr>
<tr>
<th align='center'>Extract Excel File from tally File Name Format :[PL-{dd-mm-yyyy}.xls] </th>
</tr>

<tr>
<th  align='center'>
<input type="Submit" name="submit" value="Upload Excel File" /></th>
</table>
</form>
</h3>


<?php
if(!isset($_POST["submit"]))
{
 exit;
} 
include("conn.php");	
include("lib_func.php");		
require_once ("PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");



//	
	$url = "img/";
	$filename = $_FILES["caih_file"]["name"];
	$filedata = $_FILES["caih_file"]["tmp_name"];
	$filesize = $_FILES["caih_file"]["size"];
	$ext = pathinfo($_FILES['caih_file']['name'],PATHINFO_EXTENSION);
	$inputFileName = $url.$filename;
	
	/*
$file_start = basename($inputFileName,".xls");
	$file_start = substr($file_start,3);
*/
        if (file_exists($inputFileName))
        {
          $chk_stmt = "select * from m_tally_pl where dt = '$dt'";
          $chk_stmt = $dbh -> query($chk_stmt);
          $r_chk = $chk_stmt -> fetch(PDO::FETCH_ASSOC);
          if ($r_chk[DT] == "")
          {}
          else
          {
          echo '<script>
        alert("Uploading of Same File is not Permitted!!");
        window.location.href="http://mis.rfi.net/mis/wip_menu.php";
                </script>';
        exit();
         }
        }

	




	if (isset($_FILES['caih_file'])&& !empty($_FILES['caih_file']['tmp_name']))
	{
		if ($ext != 'xls')
	{
	  echo '<script>
    	alert("ONLY .xls file with extension txt is Allowed!!");
        window.location.href="aweil_ofpkr_upl.php";
		</script>';
	exit();}
		$file = fopen($url.$filename,"wb");
		move_uploaded_file($filedata,$url.$filename);
		
			echo "<p>File Name = <strong>" . $filename ."</strong>";
	    	echo "<br />File type = " . $_FILES["caih_file"]["type"];
        	echo "<br />File size = " . $_FILES["caih_file"]["size"];
        	echo "<br />File extension = " . $ext;
        	echo "<br/> File is Transferred into the Server successfully</p>";
   
	   	

		/** Load $inputFileName to a PHPExcel Object  **/
		
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		$getSheet = $objPHPExcel -> getActiveSheet() -> toArray(null);
		//echo '<pre>';
		if (count($getSheet) <= 1)
		{
		 	  echo '<script>
    	alert("File doesnot contain any Record!!");
        window.location.href="aweil_ofpkr_upl.php";
		</script>';
	exit(); 
		}
		//echo count($getSheet);
		 $tab ="<table align = 'center' width=80% >";
		   $tab .= "<tr><th width=15% >".$getSheet[0][0]."</th>
  			<th width=15% >".$getSheet[0][1]."</th>
  			<th width=30% >".$getSheet[0][2]."</th>
  			<th width=15% >".$getSheet[0][3]."</th>
  			<th width=15% >".$getSheet[0][4]."</th>
  			<th width=15% >".$getSheet[0][5]."</th>
  			<th width=15% >".$getSheet[0][6]."</th>
  				  </tr>";
		$tot=0;
		$no_ep = 0;
		$no_gdn =0;
		$rrow=0;
		for ($row = 1;$row < count($getSheet); $row++)
		{
		  $tab .= "<tr> ";
		  	$error_color="";
		$error_color1="";
		  for ($cols = 0; $cols <= 6; $cols++)
		  {
			if (trim($getSheet[$row][$cols]) == "CardNo")
			{
			  $rrow = $row;
			}
			$tab .= "<td width=15% >".$getSheet[$row][$cols]."</td>";
			  }
		 $tot++;
		 
				  $tab .= "</tr> ";	
			}	  		
 		   $tab .= "<tr>
  			<th width=100%  colspan=6>Total Records Given: $tot </th>
  			  </tr>";  	
		 

			if ($tot > 0) 
		
		{//Data insert into m_cwd_stock
		  $dbh-> exec("begin work");
		  
		  $sl=0;
			$ins_stmt = "";
			$prev_per_no ="";
		for ($row = ++$rrow;$row < count($getSheet); $row++)
			{
			  $dt = "";
			  $hh=0;
			  $mm = 0;
			  $per_no = "";
			  
		  $sl++;
		  $ins_stmt = "insert into t_punch_det (per_no,punchdate,hh,mm,readeraddress) values (";
		  for ($cols = 0; $cols <= 6; $cols++)
		  {
		    echo $cols," ",$getSheet[$row][$cols],"<br>";
			if ($cols==1)
		    {
		      $val = $getSheet[$row][$cols];
		      
		      if (is_null($val))
		      {
		       // echo "saikat:",$val,"<br>";
			    $per_no = $prev_per_no;
			  }
			  else
			  {
			  $val = substr(trim($getSheet[$row][$cols]),2);
			  
			  $per_no = trim($val);
			  //echo $per_no,"<br>";
			  
			   $prev_per_no = $per_no; 	
			   }
			   $ins_stmt .= "'".$per_no."',";
			   
			 }
			if ($cols==3)
		    {
		      $val = trim($getSheet[$row][$cols]);
			  $ins_stmt .= "'".$val."',";	  
			  $dt = $val;
			}
			if ($cols==6)
		    {
		      
			  $val = trim($getSheet[$row][$cols]);
			  $ins_stmt .= "'".$val."'";	  
			}
			if ($cols==4)
		    {
			  $val = trim($getSheet[$row][$cols]);
			  $val1 = substr($val,0,2);
			  $val2 = substr($val,3,2);
			  $hh = $val1;
			  $mm = $val2;
			  $ins_stmt .= "$val1,$val2,";	
			}
		  }	
		
				$ins_stmt .= ")";
		   if ($val!="")
		   {
	        $chk_stmt = "select count(*)cnt from t_punch_det where per_no = '$per_no' and punchdate = '$dt' and hh = $hh and mm = $mm";
		// 	echo $chk_stmt,"<br>";
			$chk_stmt = $dbh -> query($chk_stmt);
			$r_chk = $chk_stmt -> fetch(PDO::FETCH_ASSOC);
//echo $ins_stmt;			
				$ins_stmt = $dbh -> prepare($ins_stmt);
				$ins_stmt -> execute();
			}
				
		}
		  
		  $dbh-> exec("commit work");
		 		  $tab .= "<tr><td width=100% colspan=6>Data Uploaded Successfully!! </td>  </tr>";  	  
		}
		else
		{
		  $tab .= "<tr><td width=100% colspan=6 ><font color=red><h2>DATA NOT UPLOADED!!! Correct the data and Upload</h2> </font></td>  </tr>";  	
		}
$tab .= "</table>";
echo $tab;
}
   	
 ?>
</center>
</body>
</html>
