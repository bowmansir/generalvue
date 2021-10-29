<?php
namespace GeneralCode\Message;

use GuzzleHttp\Exception\GuzzleException;
use GeneralCode\Core\ServiceContainer;
use GeneralCode\Core\Traits\HasHttpRequest;
use GeneralCode\GeneralCode;

/**
 * @property Text\Text $text
 * @property Link\Link $link
 * @property Markdown\Markdown $markdown
 * @property ActionCard\ActionCard $actionCard
 * @property FeedCard\FeedCard $feedCard
 *
 * 消息类型详细请见：
 * @link https://ding-doc.dingtalk.com/doc#/serverapi2/qf2nxq/d535db33
 *
 * Class Message
 * @package GeneralCode\Message
 * @author bowser <s4p3r.code@gmail.com>
 */
class Message extends ServiceContainer
{
    use HasHttpRequest;

    /**
     * @var array
     */
    protected $serviceProviders = [
        Text\ServiceProvider::class,
        Link\ServiceProvider::class,
        Markdown\ServiceProvider::class,
        ActionCard\ServiceProvider::class,
        FeedCard\ServiceProvider::class,
    ];

    /**
     * @var GeneralCode
     */
    private $GeneralCode;

    /**
     * Message constructor.
     * @param GeneralCode $GeneralCode
     */
    public function __construct(GeneralCode $GeneralCode)
    {
        $this->GeneralCode = $GeneralCode;

        parent::__construct();
    }

    /**
     * @param array $content
     * @return array
     * @throws GuzzleException
     */
    public function send(array $content): array
    {
        $this->setGuzzleOptions($this->GeneralCode['config']['guzzle_options']);

        $response = $this->request('post', $this->getUrl(), [
            'json' => $content,
        ]);

        return \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return string
     */
    private function getUrl(): string
    {
        $query = array_merge($this->GeneralCode->sign->getSignArray(), [
            'access_token' => $this->GeneralCode['config']['access_token'],
        ]);

        return $this->GeneralCode['config']['gateway'] . '?' . http_build_query($query);
    }
}
