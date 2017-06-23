<?php

use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: qinshuguo
 * Date: 2017/6/23
 * Time: 17:37
 */
class WxappTest extends TestCase
{
    public function testDecryptOpenGId()
    {
        $appId = 'wxadae2a180d1cac5b';
        $sessionKey = 'VOhls2/qYnTeAWW+TNTi6w==';
        $encryptedData = "/2TQrybylVEgdW+971caPVqidhgVIxWCv71ureeumqUfvrqosQekilOMqnRqPD504mnRTXR5WgyQnS4JHbDVkePDqHyPW3xU8W8lsV3OwtdgKnmMSC9dBCo2oI2PZw1hZ0G2B1BE00jeVQRevKj/KQ==";
        $iv = "KlJ8xceZsosLxYN7bbbpUw==";
        $openGId = \Rocky\Wxapp\Wxapp::decryptOpenGId($appId, $sessionKey, $encryptedData, $iv);
        $this->assertEquals('GwE4N0erb9ctI1i0nFmG8ifcQV_4', $openGId);
    }
}