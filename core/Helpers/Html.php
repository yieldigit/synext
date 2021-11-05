<?php
namespace Synext\Helpers;
class Html{

    public static function navbaractive(string $name, string $url): string
    {
        $class = '';
        if ($_SERVER['REQUEST_URI'] === $url) {
            $class .= 'current';
        }

        return <<<HTML
            <li class="$class" >
                <a href="$url"> $name </a>
            </li>
HTML;
    }
}

