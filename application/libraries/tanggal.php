<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tanggal
{
    function konversi($tgl)
	{
		$tanggal=explode("-", $tgl);
		$bln=$tanggal[1];
		switch($bln)
		{
			case 1 :
				$bulan="Jan";
				break;
			case 2 :
				$bulan="Feb";
				break;
			case 3 :
				$bulan="Maret";
				break;
			case 4 :
				$bulan="April";
				break;
			case 5 :
				$bulan="Mei";
				break;
			case 6 :
				$bulan="Juni";
				break;
			case 7 :
				$bulan="Juli";
				break;
			case 8 :
				$bulan="Agustus";
				break;
			case 9 :
				$bulan="Sep";
				break;
			case 10 :
				$bulan="Okt";
				break;
			case 11 :
				$bulan="Nov";
				break;
			case 12 :
				$bulan="Des";
				break;
			default:
				$bulan="NAN";
			break;
		}
		//pake 0 didepan tanggal yang kurang dari 10
		$tgls = ($tanggal[2] < 10 ? ''.$tanggal[2] : $tanggal[2]);
		return $tgls." ".$bulan." ".$tanggal[0];
	}
}

?>