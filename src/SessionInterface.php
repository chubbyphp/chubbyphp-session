<?php

declare(strict_types=1);

namespace Chubbyphp\Session;

use Psr\Http\Message\ServerRequestInterface as Request;

interface SessionInterface
{
    const FLASH_KEY = 'f';

    /**
     * @param Request $request
     * @param string  $key
     *
     * @return bool
     */
    public function has(Request $request, string $key): bool;

    /**
     * @param Request $request
     * @param string  $key
     *
     * @return mixed
     */
    public function get(Request $request, string $key);

    /**
     * @param Request $request
     * @param string  $key
     * @param string  $value
     */
    public function set(Request $request, string $key, $value);

    /**
     * @param Request $request
     * @param string  $key
     */
    public function remove(Request $request, string $key);

    /**
     * @param Request      $request
     * @param FlashMessage $flashMessage
     */
    public function addFlash(Request $request, FlashMessage $flashMessage);

    /**
     * @param Request $request
     *
     * @return FlashMessage|null
     */
    public function getFlash(Request $request);
}
