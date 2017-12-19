<?php

/**
 * JSONTOKENS
 */
class Token
{
  protected $secret = "graderTheBest";

  public static function createToken($id,$clearance) {
    $header = [
      "typ" => "JWT",
      "alg" => "HS256"
    ];

    $header = json_encode($header);
    $header = base64_encode($header);

    $payload = [
      "id" => $id,
      "clearance" => $clearance
    ];
    $payload = json_encode($payload);
    $payload = base64_encode($payload);

    $signature = hash_hmac('sha256', "$header.$payload", $secret, true);
    $signature = base64_encode($signature);

    $token = "$header.$payload.$signature";

    return $token;
  }

  public static function isValid($receivedToken) {
    $jwt_values = explode(".", $receivedToken);
    $receivedSignature = $jwt_values[2];
    $receivedHeaderAndPayload = $jwt_values[0] . "." . $jwt_values[1];
    $resultedSignature = base64_encode(hash_hmac('sha256', $receivedHeaderAndPayload, $secret, true));

    if ($resultedSignature == $receivedSignature) {
      return true;
    } else {
      return false;
    }
  }

}

?>
