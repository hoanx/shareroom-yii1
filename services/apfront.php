<?php
	if (!get_cfg_var("register_globals"))
	{
		$a_id = $_REQUEST["a_id"];
		$m_id = $_REQUEST["m_id"];
		$p_id = $_REQUEST["p_id"];
		$l_id = $_REQUEST["l_id"];
		$l_cd1 = $_REQUEST["l_cd1"];
		$l_cd2 = $_REQUEST["l_cd2"];
		$rd = $_REQUEST["rd"];
		$url = $_REQUEST["url"];
	}

	if (strlen($p_id) == 0)
	{
		$ctime = floor(time() / 60);
		$new_cseq = rand(0, 99);
		$p_id = $ctime."FFFF".sprintf("%02X", $new_cseq);
	}

	if ($a_id == "" || $m_id == "" || $p_id == "" || $l_id == "" || $l_cd1 == "" || $l_cd2 == "" || $rd == "" || $url == "")
	{
		echo "<html><head><script type=\"text/javascript\">
	alert('APMS: You can not connect site. Please contact Adpia');
	history.go(-1);
</script></head></html>";
		exit;
	}

	Header("P3P:CP=\"NOI DEVa TAIa OUR BUS UNI\"");

	if ($rd == 0)
		SetCookie("APINFO", $a_id."|".$p_id."|".$l_id."|".$l_cd1."|".$l_cd2, 0, "/", ".shareroom.vn");
	else
		SetCookie("APINFO", $a_id."|".$p_id."|".$l_id."|".$l_cd1."|".$l_cd2, time() + ($rd * 24 * 60 * 60), "/", ".shareroom.vn");

	Header("Location: ".$url);
?>