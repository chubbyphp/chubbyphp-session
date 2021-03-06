<?php

declare(strict_types=1);

namespace Chubbyphp\Session;

final class FlashMessage implements \JsonSerializable
{
    /**
     * @var string
     */
    private $type;

    const TYPE_PRIMARY = 'p';
    const TYPE_SUCCESS = 's';
    const TYPE_INFO = 'i';
    const TYPE_WARNING = 'w';
    const TYPE_DANGER = 'd';

    /**
     * @var string
     */
    private $longType;

    /**
     * @var string
     */
    private $message;

    const JSON_KEY_TYPE = 't';
    const JSON_KEY_MESSAGE = 'm';

    /**
     * @param string $type
     * @param string $message
     */
    public function __construct(string $type, string $message)
    {
        $this->type = $type;
        $this->longType = $this->getLongTypeFromType($type);
        $this->message = $message;
    }

    /**
     * @param string $type
     *
     * @return string
     */
    private function getLongTypeFromType(string $type): string
    {
        $reflection = new \ReflectionObject($this);
        foreach ($reflection->getConstants() as $const => $value) {
            if (0 === strpos($const, 'TYPE_')) {
                if ($type === $value) {
                    return strtolower(substr($const, 5));
                }
            }
        }

        return 'info';
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getLongType(): string
    {
        return $this->longType;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            self::JSON_KEY_TYPE => $this->type,
            self::JSON_KEY_MESSAGE => $this->message,
        ];
    }
}
