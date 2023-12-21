<?php
if (str_contains($_SERVER['HTTP_USER_AGENT'], "bot")) { //Lazy fix
  die();
}
if (str_contains($_SERVER['HTTP_USER_AGENT'], "OPR/")) { //Lazy check
die('<h1>Hey, You little shit</h1><p>Why would you use OperaGX or spoof it\'s user agent</p>');
function format_uuidv4($data)
{
  assert(strlen($data) == 16);

  $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
  $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

  return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://api.discord.gx.games/v1/direct-fulfillment");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"partnerUserId\": \"{format_uuidv4(random_bytes(16))}\"}");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$headers = [
  "authority: api.discord.gx.games",
  "accept: */*",
  "accept-language: en-US,en;q=0.9",
  "content-type: application/json",
  "origin: https://www.opera.com",
  "referer: https://www.opera.com/",
  'sec-ch-ua: "Opera GX"; v="105", "Chromium"; v="119", "Not?A_Brand"; v="24"',
  "sec-ch-ua-mobile: ?0",
  'sec-ch-ua-platform: "Windows"',
  "sec-fetch-dest: empty",
  "sec-fetch-mode: cors",
  "sec-fetch-site: cross-site",
  "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 OPR/105.0.0.0"
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$server_output = curl_exec ($ch);
curl_close ($ch);
$a = json_decode($server_output);
if (isset($a->token)) {
  $code = $a->token;
  header("Location: https://discord.com/billing/partner-promotions/1180231712274387115/{$code}");
  die();
} else {?>
<h2>Oh shit...</h2>
<p>It appears that it couldn't fetch a new code</p>
<p>This could be because they have fixed the bug or the promonation is no longer running</p>
<small>Or it could be simply a issue with my own site, but let's not talk about that :)</small>
<?php } ?>