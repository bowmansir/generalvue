<?php
namespace GeneralVue\Message;

use GuzzleHttp\Exception\GuzzleException;
use GeneralVue\Core\ServiceContainer;
use GeneralVue\Core\Traits\HasHttpRequest;
use GeneralVue\GeneralVue;

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
 * @package GeneralVue\Message
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
     * @var GeneralVue
     */
    private $GeneralVue;

    /**
     * Message constructor.
     * @param GeneralVue $GeneralVue
     */
    public function __construct(GeneralVue $GeneralVue)
    {
        $this->GeneralVue = $GeneralVue;

        parent::__construct();
    }

    /**
     * @param array $content
     * @return array
     * @throws GuzzleException
     */
    public function send(array $content): array
    {
        $this->setGuzzleOptions($this->GeneralVue['config']['guzzle_options']);

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
        $query = array_merge($this->GeneralVue->sign->getSignArray(), [
            'access_token' => $this->GeneralVue['config']['access_token'],
        ]);

        return $this->GeneralVue['config']['gateway'] . '?' . http_build_query($query);
    }
}
