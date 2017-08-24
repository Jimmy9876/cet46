<?php
$p['ks_xm']=htmlspecialchars($_GET['xm']);
$p['ks_sfz']=htmlspecialchars($_GET['sfzh']);
$p['jb']=htmlspecialchars($_GET['cet']);
$data['action']='';
$data['params']=json_encode($p);

$ip = mt_rand(1,255).".".mt_rand(1,255).".".mt_rand(1,255).".".mt_rand(1,255);
$url="http://app.cet.edu.cn:7066/baas/app/setuser.do?method=UserVerify";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
curl_setopt($curl,CURLOPT_HTTPHEADER,array("CLIENT-IP:".$ip, "X_FORWARD_FOR:".$ip)); 
curl_setopt($curl, CURLOPT_REFERER, 'http://app.cet.edu.cn:7066/baas/app/setuser.do?method=UserVerify');
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$datas = curl_exec($curl);
$bk=json_decode($datas,true);
if(isset($bk['ks_bh'])){
echo "您的准考证号为".$bk['ks_bh'];
}else{
echo "没有找到 ".htmlspecialchars($_GET['xm'])." ".htmlspecialchars($_GET['sfzh'])." 的准考证，请确定您已经输入正确的身份证且正确的选择了四级或六级按钮";
}

?>