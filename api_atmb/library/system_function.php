<?php

function getUsernameSession()
{
	return $_SESSION['username'];
}


function save_info_reservation($no_booking)
{
	$_SESSION['no_booking'] = $no_booking;
}


function save_payment_code($bankcode,$payment_code)
{
	$_SESSION['payment_code'] = $bankcode.$payment_code;
}


function checkStateUser($id_reg,$con)
{
	$respons = null;

	$checkValidateState = mysqli_query($con,"SELECT id_reg,state FROM tbl_user WHERE id_reg='$id_reg'");
	
	while($getValidateState = mysqli_fetch_object($checkValidateState))
	{
		if($getValidateState)
		{
			$respons[0] = $getValidateState->state;
		}
		else
		{
			$respons = null;
		}
	}
	return $respons;
}



function random_code($length) 
{
    #$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $chars = "0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length);
    return $password;
}


function competition_code($length) 
{
    #$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $special_char = "C";
    $chars = "0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length);
    return $special_char."-".$password;
}


function getUsername($u_session,$con)
{
	$respons = "";
	$username = $u_session;
	$searchIdUser = mysqli_query($con,"SELECT username,name FROM tbl_user WHERE username='$username'");

	while($getIDUser=mysqli_fetch_object($searchIdUser))
	{
		if($getIDUser)
		{
			$respons = $getIDUser->name;
		}
		else
		{
			$respons = "";
		}
	}
	return $respons;
}


function getUsernameFromDetailMember($u_session,$con)
{
	$respons = "";
	$email = $u_session;
	$searchIdUser = mysqli_query($con,"SELECT email,name FROM tbl_detail_member WHERE email='$email'");

	while($getIDUser=mysqli_fetch_object($searchIdUser))
	{
		if($getIDUser)
		{
			$respons = $getIDUser->name;
		}
		else
		{
			$respons = "";
		}
	}
	return $respons;
}


function getIdReg($u_session,$con)
{
	$respons = "";

	$username = $u_session;
	$searchIdReg = mysqli_query($con,"SELECT username,id_reg FROM tbl_user WHERE username='$username'");

	while($getIDReg=mysqli_fetch_object($searchIdReg))
	{
		if($getIDReg)
		{
			$respons = $getIDReg->id_reg;
		}
		else
		{
			$respons = "";
		}
	}
	return $respons;
}



function getIdUser($u_session,$con)
{
	$respons = "";

	$username = $u_session;
	$searchIdUser = mysqli_query($con,"SELECT username,id_user FROM tbl_user WHERE username='$username'");

	while($getIDUser=mysqli_fetch_object($searchIdUser))
	{
		if($getIDUser)
		{
			$respons = $getIDUser->id_user;
		}
		else
		{
			$respons = "";
		}
	}
	return $respons;
}


function getClientInfo($u_session,$con)
{
	$respons 	= null;
	$username 	= $u_session;

	$searchIDClient = mysqli_query($con,"SELECT * FROM tbl_user WHERE username='$username'");

	while($getIDClient = mysqli_fetch_object($searchIDClient))
	{
		if($getIDClient)
		{
			$respons[0] = $getIDClient->id_user;
			$respons[1] = $getIDClient->password;
			$respons[2] = substr($getIDClient->name, 0, 23);
		}
		else
		{
			$respons[0] = null;
			$respons[1] = null;
			$respons[2] = null;
		}
	}

	return $respons;
}


function getLevelUserFirstTime($u_session,$con)
{
	$username = $u_session;
	$searchLevel = mysqli_query($con,"SELECT username,level FROM tbl_user WHERE username='$username'");
	$getLevel = mysqli_fetch_object($searchLevel);

	$level = $getLevel->level;
	return $level;
}



function getFirstTimeState($u_session,$con)
{
	$username = $u_session;
	$searchState = mysqli_query($con,"SELECT username,state FROM tbl_user WHERE username='$username'");
	$getState = mysqli_fetch_object($searchState);

	$state = $getState->state;
	return $state;
}



function checkDetailOwnerAndFieldInformation($id_reg,$con)
{
	$respons 				= null;

	$searchDetailMember 	= mysqli_query($con,"SELECT id_reg FROM tbl_detail_owner_futsal WHERE id_reg='$id_reg'");
	while($getDetailMember 	= mysqli_fetch_object($searchDetailMember))
	{
		if($getDetailMember)
		{
			$respons['0']	= "1";
		}
		else
		{
			$respons['0']	= "0";
		}
	}

	$searchFieldInformation	= mysqli_query($con,"SELECT court_reg FROM tbl_field_information WHERE court_reg='$id_reg'");
	while($getFieldInformation = mysqli_fetch_object($searchFieldInformation))
	{
		if($getFieldInformation)
		{
			$respons[1]	= "1";
		}
		else
		{
			$respons[1]	= "0";
		}
	}
	return $respons;
}



function checkDetailMemberAndFieldInformation($id_reg,$con)
{
	//$respons 				= null;
	$respons[0]	= "0";

	$searchDetailMember 	= mysqli_query($con,"SELECT id_reg FROM tbl_detail_member WHERE id_reg='$id_reg'");
	while($getDetailMember 	= mysqli_fetch_object($searchDetailMember))
	{
		if($getDetailMember)
		{
			$respons[0]	= "1";
		}
		else
		{
			$respons[0]	= "0";
		}
	}

	return $respons;
}




function checkDetailEOAndFieldInformation($id_reg,$con)
{
	$respons[0]	= "0";

	$searchDetailEO 	= mysqli_query($con,"SELECT id_reg FROM tbl_detail_eo WHERE id_reg='$id_reg'");
	while($getDetailEO 	= mysqli_fetch_object($searchDetailEO))
	{
		if($getDetailEO)
		{
			$respons[0]	= "1";
		}
		else
		{
			$respons[0]	= "0";
		}
	}

	return $respons;
}




function getDetailEOInfo($id_reg,$con)
{
	$respons = null;

	$searchDetailEO 	= mysqli_query($con,"SELECT id_reg,id_eo_detail,prov_penyelenggara,kota_penyelenggara,alamat,no_telp FROM tbl_detail_eo WHERE id_reg='$id_reg'");
	while($getDetailEO 	= mysqli_fetch_object($searchDetailEO))
	{
		if($getDetailEO)
		{
			$respons[0]	= $getDetailEO->id_eo_detail;
			$respons[1]	= $getDetailEO->prov_penyelenggara;
			$respons[2]	= $getDetailEO->kota_penyelenggara;
			$respons[3] = $getDetailEO->alamat;
			$respons[4] = $getDetailEO->no_telp;
		}
		else
		{
			$respons	= null;
		}
	}

	return $respons;
}




function checkValidates($u_session, $i_session, $con)
{
	$permission_access = "false";
	$checkDataUser = mysqli_query($con,"SELECT username, id_reg FROM tbl_user WHERE username='$u_session' AND id_reg='$i_session'");

	while($q = mysqli_fetch_row($checkDataUser))
	{
		if($q)
		{
			$permission_access = "true";
		}
		else
		{
			$permission_access = "false";	
		}
	}
	return $permission_access;
}


function getLevelUser($u_session,$i_session,$con)
{
	$level_user = "null";
	$checkUserLevel = mysqli_query($con,"SELECT username, id_reg, level FROM tbl_user WHERE username='$u_session' AND id_reg='$i_session'");

	if($checkUserLevel==true)
	{
		$getUserLevel = mysqli_fetch_object($checkUserLevel);

		if($getUserLevel==true)
		{
			$level_user = $getUserLevel->level;
		}
	}
	else
	{
		$level_user = "null";
	}

    return $level_user;
}



function storeSameArea($u_session,$state_dat,$con)
{
	$respons = "0";

	$searchProvAndCity = mysqli_query($con,"SELECT prov,kota FROM tbl_detail_member WHERE email='$u_session'");

	while($getDataProAndCity = mysqli_fetch_object($searchProvAndCity))
	{
		if($getDataProAndCity)
		{
			$province = $getDataProAndCity->prov;
			$city = $getDataProAndCity->kota;

			$_SESSION['provinsi'] = $province;
			$_SESSION['city'] = $city;
			$_SESSION['state'] = $state_dat;

			if($_SESSION['provinsi']==$province && $_SESSION['city']==$city && $_SESSION['state']==$state_dat)
			{
				$respons = "1";
			}
			else
			{
				$respons = "0";
			}
		}
		else
		{
			$respons = "0";
		}
	}
	return $respons;
}


function storeDifferentArea($pro_dat,$city_dat,$state_dat)
{
	$respons = "0";

	$_SESSION['provinsi'] = $pro_dat;
	$_SESSION['city'] = $city_dat;
	$_SESSION['state'] = $state_dat;

	if($_SESSION['provinsi']==$pro_dat && $_SESSION['city']==$city_dat && $_SESSION['state']==$state_dat)
	{
		$respons = "1";
	}
	else
	{
		$respons = "0";
	}

	return $respons;
}



function storeInfoId($info)
{
	$respons = "0";
	$_SESSION['info_id'] = $info;

	if($_SESSION['info_id']==$info)
	{
		$respons = "1";
	}
	else
	{
		$respons = "0";
	}

	return $respons;
}


function storeIdPrice($infoID)
{
	$respons = "0";
	$_SESSION['idprice'] = $infoID;

	if($_SESSION['idprice']==$infoID)
	{
		$respons = "1";
	}
	else
	{
		$respons = "0";
	}
	$infoID="";
	return $respons;
}


function storeIdComp($infoID)
{
	$respons = "0";
	$_SESSION['idcomp'] = $infoID;

	if($_SESSION['idcomp']==$infoID)
	{
		$respons = "1";
	}
	else
	{
		$respons = "0";
	}
	$infoID="";
	return $respons;
}



function storeCodeBook($data)
{
	$respons = "0";
	$_SESSION['infoBook'] = $data;

	if($_SESSION['infoBook']==$data)
	{
		$respons = "1";
	}
	else
	{
		$respons = "0";
	}
	$data="";
	return $respons;
}



function storeCodeBookForConfirm($data)
{
	$respons = "0";
	$_SESSION['no_booking'] = $data;

	if($_SESSION['no_booking']==$data)
	{
		$respons = "1";
	}
	else
	{
		$respons = "0";
	}
	$data="";
	return $respons;
}



function storeIDCompetition($data)
{
	$respons = "0";
	$_SESSION['idcomp'] = $data;

	if($_SESSION['idcomp']==$data)
	{
		$respons = "1";
	}
	else
	{
		$respons = "0";
	}
	$data="";
	return $respons;
}



function storeIDFriendly($id)
{
	$respons 	= "0";

	$_SESSION['id_friendly'] = $id;

	if($_SESSION['id_friendly']==$id)
	{
		$respons = "1";
	}
	else
	{
		$respons = "0";
	}

	return $respons;
}


function getNameCompetition($id,$con)
{
	$respons = null;

	$searchCompetitionData = mysqli_query($con, "SELECT * FROM tbl_kompetisi WHERE id_kompetisi='$id'");
	while($getCompetitionData = mysqli_fetch_object($searchCompetitionData))
	{
		if($getCompetitionData)
		{
			$respons[0] = $getCompetitionData->nama_kompetisi;
			$respons[1] = $getCompetitionData->tanggal_mulai;
			$respons[2] = $getCompetitionData->tanggal_akhir;
			$respons[3] = $getCompetitionData->biaya;
			$respons[4] = $getCompetitionData->jenis_kompetisi;
			$respons[5] = $getCompetitionData->id_kompetisi;
			$respons[6] = $getCompetitionData->futsal;
			$respons[7] = $getCompetitionData->alamat_futsal;
			$respons[8] = $getCompetitionData->kota;
			$respons[9] = $getCompetitionData->biaya;
			$respons[10] = $getCompetitionData->genre;
			$respons[11] = $getCompetitionData->prov;
			$respons[12] = $getCompetitionData->id_eo_detail;

		}
		else
		{
			$respons = null;
		}
	}
	return $respons;
}



function getIDCompetition($id,$con)
{
	$respons = null;

	$searchCompetitionData = mysqli_query($con, "SELECT * FROM tbl_kompetisi WHERE id_eo_detail='$id'");
	while($getCompetitionData = mysqli_fetch_object($searchCompetitionData))
	{
		if($getCompetitionData)
		{
			$respons[0] = $getCompetitionData->id_kompetisi;
		}
		else
		{
			$respons = null;
		}
	}
	return $respons;
}



function getInfoMemberCompetition($id_kompetisi, $id_reg_member, $con)
{
	$respons = null;

	$searchMemberComp = mysqli_query($con,"SELECT id_kompetisi,id_reg_member,code_reg,tanggal,id_member_kompetisi FROM tbl_member_kompetisi 
		WHERE id_kompetisi='$id_kompetisi' AND id_reg_member='$id_reg_member'");

	while($getMemberComp=mysqli_fetch_object($searchMemberComp))
	{
		if($getMemberComp)
		{
			$respons[0] = $getMemberComp->code_reg;
			$respons[1] = $getMemberComp->tanggal;
			$respons[2] = $getMemberComp->id_member_kompetisi;
		}
		else
		{
			$respons = null;
		}
	}

	return $respons;
}


function storeInfoMemberComp($id_member_kompetisi,$id_reg,$code_reg)
{
	$_SESSION['idmembercomp'] 	= $id_member_kompetisi;
	$_SESSION['idreg'] 			= $id_reg;
	$_SESSION['idcodereg'] 		= $code_reg;
}


function calculateTransaction($id_comp,$con)
{
	$respons = null;

	$total = 0;
	$payment_code = 0;

	$calculateTransaction = mysqli_query($con,"SELECT * FROM tbl_booking_lapangan WHERE id_kompetisi='$id_comp'");

	while($startCalculate = mysqli_fetch_object($calculateTransaction))
	{
		if($startCalculate)
		{
			$price = $startCalculate->price;
			$total = $total + $price;
			$respons[0] = $total;
			$respons[1] = $startCalculate->payment_code;
		}
		else
		{
			$total = 0;
			$respons[0] = $total;
			$respons[1] = $payment_code;
		}
	}
	return $respons;
}





function getCourtReg($iduser,$con)
{
	$respons = null;

	$idUser = $iduser;
	$searchCourtReg = mysqli_query($con,"SELECT court_reg,id_user FROM tbl_field_information WHERE id_user='$idUser'");
	while($getCourtReg = mysqli_fetch_object($searchCourtReg))
	{
		if($getCourtReg )
		{
			$respons = $getCourtReg->court_reg;
		}
		else
		{
			$respons = null;
		}
	}
	return $respons;
}



function infoCourtField($info_session,$con)
{
	$respons=null;

	$searchCourtInformation = mysqli_query($con,"SELECT nama_lapangan, jam_ops, alamat FROM tbl_field_information 
		WHERE court_reg='$info_session'");

	while($getCourtInformation = mysqli_fetch_object($searchCourtInformation))
	{
		if($getCourtInformation)
		{
			$respons['0'] = $getCourtInformation->nama_lapangan;
			$respons['1'] = $getCourtInformation->jam_ops;
			$respons['2'] = $getCourtInformation->alamat;
		}
		else
		{
			$respons=null;
		}
	}
	return $respons;
}


function getNameFieldFromID($id,$con)
{
	$respons = null;

	$searchNameField = mysqli_query($con, "SELECT nama_lapangan,jam_ops,alamat,id_prov,id_kota FROM tbl_field_information WHERE id_field_information='$id'");

	while($getNameField = mysqli_fetch_object($searchNameField))
	{
		if($getNameField)
		{
			$respons['0'] = $getNameField->nama_lapangan;
			$respons['1'] = $getNameField->jam_ops;
			$respons['2'] = $getNameField->alamat;
			$respons['3'] = $getNameField->id_prov;
			$respons['4'] = $getNameField->id_kota;
		}
		else
		{
			$respons = null;
		}
	}
	return $respons;
}



function explodeFieldInfoFromData($data)
{
	$respons = null;
	$respons = explode(",",$data);
	return $respons;
}



function getNameField($court_reg,$con)
{
	$respons = null;

	$searchNameField = mysqli_query($con, "SELECT nama_lapangan,jam_ops,alamat,id_prov,id_kota,id_field_information FROM tbl_field_information WHERE court_reg='$court_reg'");

	while($getNameField = mysqli_fetch_object($searchNameField))
	{
		if($getNameField)
		{
			$respons['0'] = $getNameField->nama_lapangan;
			$respons['1'] = $getNameField->jam_ops;
			$respons['2'] = $getNameField->alamat;
			$respons['3'] = $getNameField->id_prov;
			$respons['4'] = $getNameField->id_kota;
			$respons['5'] = $getNameField->id_field_information;
		}
		else
		{
			$respons = null;
		}
	}
	return $respons;
}


function getMemberInfo($u_session,$con)
{
	$respons = null;

	$username = $u_session;
	$searchInfoMember = mysqli_query($con,"SELECT name, address, email, photo, phone, prov, kota, genre
		FROM tbl_detail_member 
		WHERE email='$username'");

	while($getInfoMember = mysqli_fetch_object($searchInfoMember))
	{
		if($getInfoMember)
		{
			$respons['0'] = $getInfoMember->name;
			$respons['1'] = $getInfoMember->address;
			$respons['2'] = $getInfoMember->email;
			$respons['3'] = $getInfoMember->photo;
			$respons['4'] = $getInfoMember->phone;
	        $respons['5'] = $getInfoMember->prov;
	        $respons['6'] = $getInfoMember->kota;
	        $respons['7'] = $getInfoMember->genre;
		}
		else
		{

		}
	}
	return $respons;
}


function getProvinceAndCity($id_prov, $id_city, $con)
{
	$respons = null;

	$searchProvinceData = mysqli_query($con,"SELECT provinsi_id, provinsi_nama FROM tbl_provinsi WHERE provinsi_id='$id_prov'");
	while($getProvinceData=mysqli_fetch_object($searchProvinceData))
	{
		if($getProvinceData)
		{
			$respons['0'] = $getProvinceData->provinsi_nama;
		}
		else
		{

		}
	}


	$searchCityData = mysqli_query($con,"SELECT kota_id, kokab_nama FROM tbl_city WHERE kota_id='$id_city'");
	while($getCityData=mysqli_fetch_object($searchCityData))
	{
		if($getCityData)
		{
			$respons['1'] = $getCityData->kokab_nama;
		}
		else
		{

		}
	}
	return $respons;
}


function getFieldInformation($id_harga, $con)
{
	$respons = null;

	$dataRespons;
	$idHarga 	= $id_harga;
	
	$searchInfo = mysqli_query($con,"SELECT court_reg, name_field, pricelist FROM tbl_harga_lapangan WHERE id_harga='$idHarga'");

	while($getInfo = mysqli_fetch_object($searchInfo))
	{
		if($getInfo)
		{
			$respons['0'] 	= $getInfo->name_field;
			$respons['1'] 	= $getInfo->court_reg; 
			$respons['2'] 	= $getInfo->pricelist; 
		}
		else
		{
			
		}
	}
	return $respons;
}



function getFieldInformationForOnline($id_harga, $con)
{
	$respons = null;

	$dataRespons;
	$idHarga 	= $id_harga;
	
	$searchInfo = mysqli_query($con,"SELECT court_reg, name_field, pricelist_online FROM tbl_harga_lapangan WHERE id_harga='$idHarga'");

	while($getInfo = mysqli_fetch_object($searchInfo))
	{
		if($getInfo)
		{
			$respons['0'] 	= $getInfo->name_field;
			$respons['1'] 	= $getInfo->court_reg; 
			$respons['2'] 	= $getInfo->pricelist_online; 
		}
		else
		{
			
		}
	}
	return $respons;
}



function getCompareTime($start_time, $end_time, $start_time_db, $end_time_db)
{
	$respons = null;

	if($start_time>=$start_time_db && $start_time<$end_time_db)
	{
		$respons[0]	= '4';
		$respons[1]	= '-';
		
		//echo'4';
		//echo'<br>';
	}
	else if($start_time<$start_time_db)
	{
		$respons[0]	= '1';

		//echo'1';
		//echo'<br>';

		if($end_time>$start_time_db && $end_time<$end_time_db)
		{
			$respons[1]	= '4';
			//echo '4';
		}
		else if($end_time<$start_time_db)
		{
			$respons[1]	= '2';
			//echo '2';
		}

		else if($end_time==$start_time_db)
		{
			$respons[1]	= '3';
			//echo '3';
		}

		else if($end_time>$end_time_db)
		{
			$respons[1]	= '7';
			//echo '7';
		}
		else if($end_time==$end_time_db)
		{
			$respons[1]	= '5';
			//echo '5';
		}
		else
		{
			// nothing
		}
	}
	else if($start_time>$end_time_db)
	{
		$respons[0]	= '6';
		
		//echo'6';
		//echo'<br>';

		if($end_time>$start_time_db && $end_time<$end_time_db)
		{
			$respons[1]	= '4';
			//echo '4';
		}
		else if($end_time<=$start_time_db)
		{
			$respons[1]	= '2';
			//echo '2';
		}

		else if($end_time==$start_time_db)
		{
			$respons[1]	= '3';
			//echo '3';
		}

		else if($end_time>$end_time_db)
		{
			$respons[1]	= '7';
			//echo '7';
		}
		else if($end_time==$end_time_db)
		{
			$respons[1]	= '5';
			//echo '5';
		}
		else
		{
			//
		}
	}

	else if($start_time==$end_time_db)
	{
		$respons[0]	= '5';
		
		//echo'6';
		//echo'<br>';

		if($end_time>$start_time_db && $end_time<$end_time_db)
		{
			$respons[1]	= '4';
			//echo '4';
		}
		else if($end_time<=$start_time_db)
		{
			$respons[1]	= '2';
			//echo '2';
		}

		else if($end_time==$start_time_db)
		{
			$respons[1]	= '3';
			//echo '3';
		}

		else if($end_time>$end_time_db)
		{
			$respons[1]	= '7';
			//echo '7';
		}
		else if($end_time==$end_time_db)
		{
			$respons[1]	= '5';
			//echo '5';
		}
		else
		{
			//
		}
	}

	else
	{
		// nothing
	}

	return $respons;
}


function getTemporaryCondition($respons_one, $respons_two)
{
	$result=null;

	if($respons_one=="4" AND $respons_two=="-")
	{
		return $result	= "N";
	}

	if($respons_one=="1" AND $respons_two=="2")
	{
		return $result	= "Y";
	}

	if($respons_one=="1" AND $respons_two=="3")
	{
		return $result	= "Y";
	}

	if($respons_one=="1" AND $respons_two=="4")
	{
		return $result	= "N";
	}

	if($respons_one=="1" AND $respons_two=="5")
	{
		return $result	= "N";
	}

	if($respons_one=="1" AND $respons_two=="6")
	{
		return $result	= "N";
	}

	if($respons_one=="1" AND $respons_two=="7")
	{
		return $result	= "N";
	}


	if($respons_one=="5" AND $respons_two=="7")
	{
		$result	= "Y";
	}

	if($respons_one="6" AND $respons_two="7")
	{
		$result	= "Y";
	}
}



function getAnalysisSchedulle($data_tracker)
{
	$respons = null;

	$max_loop = sizeof($data_tracker)-1;
	$loop = 0;

	$count_no 	= 0;
	$count_yes	= 0;

	for($loop;$loop<=$max_loop;$loop++)
	{
		$checkData = $data_tracker[$loop];

		if($checkData=="N")
		{
			$count_no++;
		}
		else
		{
			$count_yes++;
		}
	}

	#echo $count_no."-".$count_yes;

	if($count_no>0)
	{
		$respons = 0;
	}
	else
	{
		$respons = 1;
	}

	return $respons;
}


function checkCompetitionCondition($id_reg,$id_kompetisi,$con)
{
	$respons = null;

	$searchCondition = mysqli_query($con,"SELECT id_reg_member,id_kompetisi,verification FROM tbl_member_kompetisi WHERE id_reg_member='$id_reg' AND id_kompetisi='$id_kompetisi'");
	while($getCondition = mysqli_fetch_object($searchCondition))
	{
		if($getCondition)
		{
			$verify = $getCondition->verification;

			if($verify=="0")
			{
				$respons[0] = $verify;
				break;
			}

			else if($verify=="1")
			{
				$respons[0] = $verify;
				break;
			}

			else if($verify=="2")
			{
				$respons[0] = $verify;
				break;
			}

			else if($verify=="4")
			{	
				$respons[0] = $verify;
				break;
			}

			else
			{
				$respons[0] = "error";
				break;
			}

		}	
		else
		{
			$respons[0] = null;
			break;
		}
	}

	return $respons;
}

function getCompetitionFromIdReg($id_reg,$con)
{
	$respons = null;
	
	$searchCompInfo = mysqli_query($con,"SELECT * FROM tbl_member_kompetisi WHERE id_reg_member='$id_reg'");
	while($getCompInfo = mysqli_fetch_object($searchCompInfo))
	{
		if($getCompInfo)
		{
			$respons[0] = $getCompInfo->tanggal;
			$respons[1] = $getCompInfo->code_reg;
			$respons[2] = $getCompInfo->payment_method;
			$respons[3] = $getCompInfo->bank_name;
			$respons[4] = $getCompInfo->account_no;
			$respons[5] = $getCompInfo->account_name;
			$respons[6] = $getCompInfo->id_kompetisi;
			$respons[7] = $getCompInfo->nama_team;
			$respons[8] = $getCompInfo->verification;
		}
		else
		{

		}
	}

	return $respons;
}




function checkCompetitionCreated($id_reg,$con)
{
	$respons = null;
	$checkCompetitionCreated = mysqli_query($con, "SELECT * FROM tbl_detail_eo WHERE id='$id_reg'");
	while($getCompetition = mysqli_fetch_object($checkCompetitionCreated))
	{
		if($getCompetition)
		{
			$respons['0'] = 1;
		}
		else
		{
			$respons['0'] = 0;
		}
	}

	return $respons;
}


function checkPaymentReservEO($id_kompetisi,$con)
{
	$respons = null;
	$checkPaymentReservEO = mysqli_query($con,"SELECT * FROM tbl_reqnotification_eo WHERE booking_id='$id_kompetisi'");

	while($getPaymentReservEO = mysqli_fetch_object($checkPaymentReservEO))
	{
		if($getPaymentReservEO)
		{
			$respons[0] = 1;
		}
		else
		{
			$respons[0] = 0;
		}
	}

	return $respons;
}


function getGenreFromID($id,$con)
{
	$respons = null;
	$searchGenre = mysqli_query($con,"SELECT nama_genre,id_genre FROM tbl_genre WHERE id_genre='$id'");

	while($getGenre = mysqli_fetch_object($searchGenre))
	{
		if($getGenre)
		{
			$respons['0'] = $getGenre->nama_genre;
		}
		else
		{
			$respons['0'] = null;
		}
	}

	return $respons;
}


function getInformationFriendlyMatch($joiner,$id,$con)
{
	$respons = null;

	$searchFriendlyMatchInfo = mysqli_query($con,"SELECT * FROM tbl_friendly_match 
		WHERE id_friendly='$id' AND joiner='$joiner'");

	while($getFriendlyMatchInfo = mysqli_fetch_object($searchFriendlyMatchInfo))
	{
		if($getFriendlyMatchInfo)
		{
			$respons['0'] = $getFriendlyMatchInfo->nama_tim;
			$respons['1'] = $getFriendlyMatchInfo->created;
			$respons['2'] = $getFriendlyMatchInfo->tempat;
		}
		else
		{
			$respons = null;
		}
	}
	return $respons;
}


function getKindFieldInfo($id,$con)
{
	$respons = null;

	$searchKindField = mysqli_query($con,"SELECT * FROM tbl_jenis_lapangan WHERE id_jenis_lapangan='$id'");

	while($getKindField = mysqli_fetch_object($searchKindField))
	{
		if($getKindField)
		{
			$respons['0'] = $getKindField->jenis_lapangan;
		}
		else
		{
			$respons = null;
		}
	}
	return $respons;
}


function getDayInfo($start_day,$end_day,$con)
{
	$respons = null;

	$searchForStartDay = mysqli_query($con,"SELECT * FROM tbl_day WHERE id_day='$start_day'");
	
	while($getForStartDay = mysqli_fetch_object($searchForStartDay))
	{
		if($getForStartDay)
		{
			$respons[0] = $getForStartDay->name_day;
		}
		else
		{
			$respons[0] = null;
		}
	}



	$searchForEndDay = mysqli_query($con,"SELECT * FROM tbl_day WHERE id_day='$end_day'");
	
	while($getForEndDay = mysqli_fetch_object($searchForEndDay))
	{
		if($getForEndDay)
		{
			$respons[1] = $getForEndDay->name_day;
		}
		else
		{
			$respons[1] = null;
		}
	}

	return $respons;
}


function getInfoCourtRegFromIdArenaKind($id,$con)
{
	$respons = null;

	$searchInformation = mysqli_query($con,"SELECT * FROM tbl_arena_futsal WHERE id_arean='$id'");
	
	while($getInformation = mysqli_fetch_object($searchInformation))
	{
		if($getInformation)
		{
			$respons[0] = $getInformation->nama_arena;
			$respons[1] = $getInformation->jenis_lapangan;
			$respons[2] = $getInformation->code_arena;
			$respons[3] = $getInformation->court_reg;
		}
		else
		{

		}
	}

	return $respons;
}


function getInfoNameFieldFromCodeArena($code_arena,$con)
{

	$respons = null;
	$searchInformation = mysqli_query($con,"SELECT * FROM tbl_arena_futsal WHERE code_arena='$code_arena'");
	
	while($getInformation = mysqli_fetch_object($searchInformation))
	{
		if($getInformation)
		{
			$respons[0] = $getInformation->nama_arena;
			$respons[1] = $getInformation->jenis_lapangan;
			$respons[2] = $getInformation->code_arena;
			$respons[3] = $getInformation->court_reg;
		}
		else
		{

		}
	}

	return $respons;
}


function getBasicPriceForSaveBooking($court_reg,$arena_kind,$start_time, $end_time,$day_number,$con)
{
	$status_price		= "1";
	$status_perubahan 	= "0";
	$respons 		= null;

	$searchCourtPrice = mysqli_query($con,"SELECT pricelist, pricelist_online, register,court_reg,status_price,status_perubahan,arena_kind,start_day, end_day FROM tbl_harga_lapangan 
		WHERE court_reg = '$court_reg' AND status_price='$status_price' AND status_perubahan='$status_perubahan' AND arena_kind='$arena_kind'");

	while($getCourtPrice = mysqli_fetch_object($searchCourtPrice))
	{
		if($getCourtPrice)
		{
			$start_day	= $getCourtPrice->start_day;
			$end_day 	= $getCourtPrice->end_day;
				
			if($day_number>=$start_day && $day_number<=$end_day)
			{
				
				$register 	= $getCourtPrice->register;
				
				$start_time_db 	= substr($register,0,4);
				$end_time_db 	= substr($register,4,4);
					
				/*additional code for check spesifiect time*/
				if($start_time>=$start_time_db && $start_time<=$end_time_db)
				{
					$pricelist			= $getCourtPrice->pricelist;
					$pricelist_online 	= $getCourtPrice->pricelist_online;
					
					$respons[0] = $pricelist;
					$respons[1] = $pricelist_online;
				}
				else
				{
					//do nothing here....
				}
			}
			else
			{

			}
		}
		else
		{

		}
	}
	return $respons;
}



function getUserFieldCategory($id,$con)
{
	$respons = null;

	$searchCategoryName = mysqli_query($con,"SELECT id,nama_kategori FROM tbl_category WHERE code_kategori='$id'");
	while($getCategoryName = mysqli_fetch_object($searchCategoryName))
	{
		if($getCategoryName)
		{
			$respons[0] = $getCategoryName->nama_kategori;
		}
		else
		{
			//do nothing here...
		}
	}

	return $respons;
}



function classificationGenre($genre,$con)
{
	$respons = null;

	if($genre==1 || $genre==2 || $genre==3)
	{
		//Pelajar
		$respons[0]="1";
	}

	else if($genre==4)
	{
		//Mahasiswa
		$respons[0]="2";
	}

	else if($genre==5 || $genre==6)
	{
		//Umum
		$respons[0]="3";
	}
	else
	{
		//do nothing here...
	}

	return $respons;
}



function aliasUserCategory($cat,$con)
{
	$respons = null;

	$searchUserCat = mysqli_query($con, "SELECT * FROM tbl_category WHERE code_kategori='$cat'");
	while($getUserCat = mysqli_fetch_object($searchUserCat))
	{
		if($getUserCat)
		{
			$respons[0] = $getUserCat->nama_kategori;
		}
		else
		{
			$respons[0] = null;
		}
	}

	return $respons;
}



function getBankInfo($id_bank,$con)
{
	$respons =  null;

	$searchBankInfo = mysqli_query($con,"SELECT * FROM tbl_bank WHERE id_bank='$id_bank'");
	while($getBankInfo=mysqli_fetch_object($searchBankInfo))
	{
		if($getBankInfo)
		{
			$respons[0] = $getBankInfo->nama_bank;
			$respons[1] = $getBankInfo->id_bank;
		}
		else
		{
			$respons = null;
		}
	}
	return $respons;
}



function getPaymentInfoFromBooking($no_book,$con)
{
	$respons = null;

	$searchTransferInfo = mysqli_query($con, "SELECT nomor_booking,payment_method,id_bank FROM tbl_booking_lapangan WHERE nomor_booking='$no_book'");

    while($getTransferInfo = mysqli_fetch_object($searchTransferInfo))
    {
        if($getTransferInfo)
        {
            $respons[0] = $getTransferInfo->payment_method;
            $respons[1] = $getTransferInfo->id_bank;
        }
        else
        {

        }
    }

    return $respons;
}



function getBookingInformation($no_book,$username,$register,$con)
{
	$respons = null;

	$searchBookingData = mysqli_query($con,"SELECT * FROM tbl_booking_lapangan WHERE nomor_booking='$no_book' AND id_user_member='$username' AND register='$register'");

	while($getBookingData = mysqli_fetch_object($searchBookingData))
	{
		if($getBookingData)
		{
			$respons[0] = $getBookingData->id_booking;
			$respons[1] = $getBookingData->court_reg;
			$respons[2] = $getBookingData->code_arena;
		}
		else
		{
			$respons[0] = null;
			$respons[1] = null;
			$respons[2] = null;
		}
	}
	return $respons;
}



function getBookingInfoDetail($id_booking,$con)
 {
 	$respons = null;

	$searchBookingData = mysqli_query($con,"SELECT * FROM tbl_booking_lapangan WHERE id_booking='$id_booking'");

	while($getBookingData = mysqli_fetch_object($searchBookingData))
	{
		if($getBookingData)
		{
			$respons[0] = $getBookingData->id_booking;
			$respons[1] = $getBookingData->court_reg;
			$respons[2] = $getBookingData->code_arena;
		}
		else
		{
			$respons[0] = null;
			$respons[1] = null;
			$respons[2] = null;
		}
	}
	return $respons;
 }



function getIDMemberKompetisi($code_reg,$id_reg_member,$id_kompetisi,$con)
{
	$respons = null;

	$searchMemberKompetisi = mysqli_query($con,"SELECT * FROM tbl_member_kompetisi WHERE code_reg='$code_reg' AND id_reg_member='$id_reg_member' AND id_kompetisi='$id_kompetisi'");

	while($getMemberKompetisi = mysqli_fetch_object($searchMemberKompetisi))
	{
		if($getMemberKompetisi)
		{
			$respons[0] = $getMemberKompetisi->id_member_kompetisi;
		}
		else
		{
			$respons[0] = null;
		}
	}
	return $respons;
}


function getBankAccountInfo($id_bank,$con)
{
	$respons = null;

	$searchBankInfo     = mysqli_query($con,"SELECT * FROM tbl_bank_account WHERE id_bank='$id_bank'");
                                                    
    while($getBankInfo = mysqli_fetch_object($searchBankInfo))
    {
        if($getBankInfo)
        {
            $respons[0]	= $getBankInfo->account_no;
            $respons[1]	= $getBankInfo->account_name;
        }
    }
	return $respons;
}


function checkPaymentState($id_booking,$con)
{
	$respons = null;

	$searchCheckTransaction = mysqli_query($con,"SELECT * FROM tbl_reqnotification WHERE booking_id='$id_booking'");

	while($getCheckTransaction = mysqli_fetch_object($searchCheckTransaction))
	{
		if($getCheckTransaction)
		{
			$respons[0] = "1";
		}
		else
		{
			$respons[0] = NULL;
		}
	}

	return $respons;
}


function ackResPaymentCode($data)
{
	$respons = null;
	
	if($data=="00")
	{
		$respons[0] = "Transaction Success";
	}
	else if($data=="01")
	{
		$respons[0] = "Transaction Success";
	}
	else
	{

	}

	return $respons;
}

function usernameATMB()
{
	$respons = "ramlan.hutapea@gmail.com";
	return $respons;
}


function passwordATMB()
{
	$respons = "Amanda2528";
	return $respons;
}


function secretKey()
{
	$respons = "h5J43l6V";
	return $respons;
}


function productRegEO()
{
	$respons = "000";
	return $respons;
}


function productReservEO()
{
	$respons = "0000";
	return $respons;
}


function productAgent()
{
	$respons = "00000";
	return $respons;
}


function signatureATMB($username,$password,$id_booking)
{
	$respons = MD5($username.$password.$id_booking);
	return $respons;
}


function signatureATMBAlt($username,$password,$secretkey)
{
	$respons = MD5($username.$password.$id_booking);
	return $respons;
}


function signatureATMBAlt2($username,$secretkey,$id_booking)
{
	$respons = MD5($username.$secretkey.$id_booking);
	return $respons;
}

function endPointRequestPaymentCodeBersamaID()
{
	$respons = "https://bersama.id/portal/index.php/api/tfp/generatePaymentCode";
	return $respons;
}


function endPointTransactionStatusInquery()
{
	$respons = "https://bersama.id/portal/index.php/api/tfp/inquiryStatus";
	return $respons;
}


function requestPaymentCodeBersamaID($id_booking,$id_client,$cust_name,$amount,$username,$password,$date_transaction,$id_product, $signature)
{
	//$signature 	= md5($username.$password[1].$id_booking[0]);
	$id_user 	= $id_client;
	$interval	= 120;

	$data="<?xml version=\"1.0\" ?>
	<data>
	    <type>reqpaymentcode</type>
	    <bookingid>$id_booking</bookingid>
	    <clientid>$id_user</clientid>
	    <customer_name>$cust_name</customer_name>
	    <amount>$amount</amount>
	    <productid>$id_product</productid>
	    <interval>$interval</interval>
	    <username>$username</username>
	    <booking_datetime>$date_transaction</booking_datetime>
	    <signature>$signature</signature>
	</data>";

	return $data;
}



function notifyPayment($ack,$id_booking, $signature)
{
	$type = "resnotification";

	$data ="<?xml version=\"1.0\" ?>
	<return>
	    <type>$type</type>
	    <ack>$ack</ack>
	    <bookingid>$id_booking</bookingid>
	    <signature>$signature</signature>
	</return>";

	return $data;
}

function parserXMLResponsePaymentCode($data)
{
	$respons = null;
	$xml 	=simplexml_load_string($data);
	$ack 	= $xml->ack[0];

	$ack_info = ackResPaymentCode($ack);

	if($ack_info[0]=="Transaction Success")
	{
		$respons[0] = $xml->amount[0];
		$respons[1]	= $xml->vaid[0];
		$respons[2] = $xml->bankcode[0];
		$respons[3] = $xml->bookingid[0];
		$respons[4] = $xml->signature[0];
	}
	else
	{
		$respons = null;
	}

	return $respons;
}


function parserXMLNotifyPayment($data)
{
	$respons = null;
	$xml = simplexml_load_string($data);

	$respons[0] = $xml->bookingid[0];
	$respons[1] = $xml->signature[0];
	$respons[2] = $xml->clientid[0];
	$respons[3] = $xml->customer_name[0];
	$respons[4] = $xml->issuer_bank[0];
	$respons[5] = $xml->issuer_name[0];
	$respons[6] = $xml->amount[0];
	$respons[7] = $xml->productid[0];
	$respons[8] = $xml->trxid[0];
	$respons[9] = $xml->trx_date[0];
	$respons[10]= $xml->username[0];
	$respons[11]= $xml->notification_datetime[0];
	$respons[12]= $xml->type[0];

	return $respons;
}


?>