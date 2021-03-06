<?php
namespace GeneralVue\Message\Text;

use GeneralVue\Core\AbstractContent;
use GeneralVue\Core\Exceptions\InvalidArgumentException;

/**
 * Class Text
 * @package GeneralVue\Message\Text
 * @author bowser <s4p3r.code@gmail.com>
 */
class Text extends AbstractContent
{
    /**
     * @return array
     */
    public function getDefaultContent(): array
    {
        return [
            'msgtype' => 'text',
            'text' => [
                'content' => '',
            ],
            'at' => [
                'atMobiles' => [],
                'isAtAll' => false,
            ],
        ];
    }

    /**
     * @throws InvalidArgumentException
     */
    protected function checkContent(): void
    {
        if (empty($this->content['text']['content'])) {
            throw new InvalidArgumentException('content could not be empty');
        }
    }

    /**
     * @param string $textContent
     * @return $this
     */
    public function setTextContent(string $textContent): self
    {
        $this->content['text']['content'] = $textContent;

        return $this;
    }

    /**
     * @param string $mobile
     * @return $this
     */
    public function addAtMobile(string $mobile): self
    {
        array_push($this->content['at']['atMobiles'], $mobile);

        return $this;
    }

    /**
     * @param array $mobiles
     * @return $this
     */
    public function addAtMobiles(array $mobiles): self
    {
        $this->content['at']['atMobiles'] = $mobiles;

        return $this;
    }

    /**
     * @return $this
     */
    public function atAll(): self
    {
        $this->content['at']['isAtAll'] = true;

        return $this;
    }
}
