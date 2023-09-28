<?php
namespace Ushahidi\Core\Extension;

/**
 * ExtensionBase allows for "private traits"
 *
 */
class ExtensionBase
{
    use ExtensionTrait;

    public static function extend(callable $callback)
    {
        self::extensionExtendCallback($callback);
    }
}
