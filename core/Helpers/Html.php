<?php
namespace Synext\Helpers;
class Html{

    public static function navbaractive(string $name, string $url, string $icon = null): string
    {
        $class = 'nav-link ';
        if ($_SERVER['REQUEST_URI'] === $url) {
            $class .= 'active';
        }

        return <<<HTML
            <li class="nav-item">
                <a class="$class" href="$url"> <i class="fa fa-$icon"> </i> $name </a>
            </li>
HTML;
    }
}
/**
 * <li class="nav-item ">
<a class="nav-link"  href='/link'>Mon compte  <i class=" fa fa-user "> </i>  </a>
</li>
 */
