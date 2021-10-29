<?php
namespace GeneralCode\Sign;

use GeneralCode\GeneralCode;

/**
 * Class Sign
 * @package GeneralCode\Sign
 * @author bowser <s4p3r.code@gmail.com>
 */
class Sign
{
    /**
     * @var GeneralCode
     */
    private $GeneralCode;

    /**
     * Sign constructor.
     * @param GeneralCode $GeneralCode
     */
    public function __construct(GeneralCode $GeneralCode)
    {
        $this->GeneralCode = $GeneralCode;
    }

    /**
     * @return array
     */
    public function getSignArray(): array
    {
        $signArray = [];

        if (! empty($this->GeneralCode['config']['secret'])) {
            $timestamp = $this->getCurrentMillisecond();
            $sign = $this->generate($timestamp, $this->GeneralCode['config']['secret']);

            $signArray = [
                'timestamp' => $timestamp,
                'sign' => $sign,
            ];
        }

        return $signArray;
    }

    /**
     * @param int $timestamp
     * @param string $secret
     * @return string
     */
    public function generate(int $timestamp, string $secret): string
    {
        $stringToSign = $timestamp . "\n" . $secret;
        $sign = hash_hmac('sha256', $stringToSign, $secret, true);

        return base64_encode($sign);
    }

    /**
     * 验签规则
     * 1. 时间戳有效期 1 小时
     * 2. 签名匹配
     *
     * @param int $timestamp
     * @param string $sign
     * @return bool
     */
    public function verify(int $timestamp, string $sign): bool
    {
        $nowTimestamp = $this->getCurrentMillisecond();
        if ($nowTimestamp - $timestamp > 3600000) {
            return false;
        }

        $signGenerated = $this->generate($timestamp, $this->GeneralCode['config']['app_secret']);
        if ($signGenerated !== $sign) {
            return false;
        }

        return true;
    }

    /**
     * @return int
     */
    private function getCurrentMillisecond(): int
    {
        return (int) round(microtime(true) * 1000);
    }
}
