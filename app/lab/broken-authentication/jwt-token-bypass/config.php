<?php
class JWT
{
    /**
     * Headers for JWT.
     *
     * @var array
     */
    private $headers;

    /**
     * Secret for JWT.
     *
     * @var string
     */
    private $secret;

    public function __construct()
    {
        $this->headers = [
            'alg' => 'HS256', // we are using a SHA256 algorithm
            'typ' => 'JWT', // JWT type
            'iss' => 'test.jwt', // token issuer
            'aud' => 'test.jwt' // token audience
        ];
        $this->secret = '1234';
    }

    /**
     * Generate JWT using a payload.
     *
     * @param array $payload
     * @return string
     */
    public function generate(array $payload): string
    {
        $headers = $this->encode(json_encode($this->headers)); // encode headers
        $payload["exp"] = time() + 3600; // add expiration to payload
        $payload = $this->encode(json_encode($payload)); // encode payload
        $signature = hash_hmac('SHA256', "$headers.$payload", $this->secret, true); // create SHA256 signature
        $signature = $this->encode($signature); // encode signature

        return "$headers.$payload.$signature";
    }

    /**
     * Encode JWT using base64.
     *
     * @param string $str
     * @return string
     */
    private function encode(string $str): string
    {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '='); // base64 encode string
    }

    /**
     * Check if JWT is valid, return true | false.
     *
     * @param string $jwt
     * @return boolean
     */
    public function is_valid(string $jwt): bool
    {
        $token = explode('.', $jwt); // explode token based on JWT breaks
        if (!isset($token[1]) && !isset($token[2])) {
            return false; // fails if the header and payload is not set
        }
        $headers = base64_decode($token[0]); // decode header, create variable
        $payload = base64_decode($token[1]); // decode payload, create variable
        $clientSignature = $token[2]; // create variable for signature

        if (!json_decode($payload)) {
            return false; // fails if payload does not decode
        }

        if ((json_decode($payload)->exp - time()) < 0) {
            return false; // fails if expiration is greater than 0, setup for 1 minute
        }

        if (isset(json_decode($payload)->iss)) {
            if (json_decode($headers)->iss != json_decode($payload)->iss) {
                return false; // fails if issuers are not the same
            }
        } else {
            return false; // fails if issuer is not set 
        }

        if (isset(json_decode($payload)->aud)) {
            if (json_decode($headers)->aud != json_decode($payload)->aud) {
                return false; // fails if audiences are not the same
            }
        } else {
            return false; // fails if audience is not set
        }

        $base64_header = $this->encode($headers);
        $base64_payload = $this->encode($payload);

        $signature = hash_hmac('SHA256', $base64_header . "." . $base64_payload, $this->secret, true);
        $base64_signature = $this->encode($signature);

        return ($base64_signature === $clientSignature);
    }
    public function get_username(string $jwt): string{
        $token = explode('.', $jwt);
        if (!isset($token[1]) && !isset($token[2])) {
            return false;
        }
        $payload = json_decode(base64_decode($token[1]));
        return $payload->username;
        
    }
    public function get_userid(string $jwt): string{
        $token = explode('.', $jwt);
        if (!isset($token[1]) && !isset($token[2])) {
            return false;
        }
        $payload = json_decode(base64_decode($token[1]));
        return $payload->id;
        
    }
}