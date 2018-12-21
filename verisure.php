<?php
header('Content-Type: application/json');
$email = $_GET['ma'];
$password = $_GET['pw'];
$doorCode = $_GET['dc'];
$intention = $_GET['int'];
$installationId = $_GET['ins'];
$deviceLabel = $_GET['dev'];
$baseURL = "https://e-api01.verisure.com/xbn/2";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseURL . '/cookie');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "CPE/$email:$password");
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json;charset=UTF-8', 'Accept: application/json']);
$response = curl_exec($ch);

if (!$response)
{
	echo 'Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch);
	die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
}

$cookie = json_decode($response);
$cookie = $cookie->cookie;
curl_close($ch);

if ($intention === "installid")
{
	$urlEmail = urlencode($email);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "$baseURL/webaccount/$urlEmail/installation");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Connection: keep-alive', 'Accept: application/json, text/javascript, */*; q=0.01', 'Content-Type: application/json;charset=UTF-8', 'Cookie: vid=' . $cookie, ]);
	$response = curl_exec($ch);
	if (!$response)
	{
		die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
	}

	echo $response;
	curl_close($ch);
}
elseif ($intention === "lock" || $intention === "unlock")
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "$baseURL/installation/$installationId/device/2ANG%20CCR7/$intention");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Connection: keep-alive', 'Accept: application/json, text/javascript, */*; q=0.01', 'APPLICATION_ID: VS_APP_IPHONE', 'Content-Type: application/json;charset=UTF-8', "Cookie: vid=$cookie", ]);

	// json body

	$json_array = ['code' => $doorCode];
	$body = json_encode($json_array);

	// set body

	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

	// send the request and save response to $response

	$response = curl_exec($ch);

	// stop if fails

	if (!$response)
	{
		die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
	}

	echo $response;

	// close curl resource to free up system resources

	curl_close($ch);
}
elseif ($intention === "status")
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "$baseURL/installation/$installationId/overview");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Cookie: vid=' . $cookie, 'Connection: keep-alive', 'Accept: application/json, text/javascript, */*; q=0.01', 'APPLICATION_ID: VS_APP_IPHONE', 'Content-Type: application/json;charset=UTF-8', ]);
	$response = curl_exec($ch);
	if (!$response)
	{
		die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
		echo 'Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch);
	}

	$response = json_decode($response);
	$response = $response->doorLockStatusList;
	$response = json_encode($response);
	echo $response;
	curl_close($ch);
}
else
{
	echo 'No valid status in "int=" URL parameter. Valid parameters are  installid, status, lock and unlock';
}

?>
