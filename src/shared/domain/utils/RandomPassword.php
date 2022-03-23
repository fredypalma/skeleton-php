<?php declare(strict_types=1);

namespace CP\shared\domain\utils;

final class RandomPassword
{
    /**
     * @var string
     * @var array
     */
    private static string $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    private static array $password;

    /**
     * @return string
     */
    public static function get()
    {
        self::$password = [];
        self::setFistLowerCase();
        self::setFistUpperCase();
        self::setFistNumber();
        self::setPassword();
        return implode(self::$password);
    }

    /**
     * @return void
     */
    private static function setFistLowerCase(): void
    {
        for ($i = 0; $i < 1; $i++) {
            $n = rand(0 , 26);
            self::$password[] = self::$alphabet[$n];
        }
    }

    /**
     * @return void
     */
    private static function setFistUpperCase(): void
    {
        for ($i = 0; $i < 1; $i++) {
            $n = rand(26 , 52);
            self::$password[] = self::$alphabet[$n];
        }
    }

    /**
     * @return void
     */
    private static function setFistNumber(): void
    {
        $alphaLength = strlen(self::$alphabet) - 1;
        for ($i = 0; $i < 1; $i++) {
            $n = rand(52 , $alphaLength);
            self::$password[] = self::$alphabet[$n];
        }
    }

    /**
     * @return void
     */
    private static function setPassword(): void
    {
        $alphaLength = strlen(self::$alphabet) - 1;
        for ($i = 0; $i < 5; $i++) {
            $n = rand(0 , $alphaLength);
            self::$password[] = self::$alphabet[$n];
        }
    }
}