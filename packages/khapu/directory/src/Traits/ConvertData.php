<?php

namespace Khapu\Directory\Traits;
use Exception;
trait ConvertData
{
    private static $_unit = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB', 'BB', 'GB'];

    /**
     * @param int $value - value be needed to convert
     * @param int $size - size of desired data
     * @param bool $binary - if binary is false 
     */
    public function formatSizeData(int $value, int $size = 1, bool $binary = true)
    {
        $da = $value;
        $i = 0;
        $convert = ($binary) ? 1024 : 1000;
        if ($da === 0) {
            return [
                'value' => $da,
                'unit' => self::$_unit[$i]
            ];
        }
        while (($da / $convert) >= $size) {
            $da = $da / $convert;
            $i++;
        }
        return [
            'value' => ceil($da),
            'unit' => self::$_unit[$i]
        ];
    }

    /**
     * @param int $convertValue - value be needed to convert
     * @param string $from - unit before converting, belong list ('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB', 'BB', 'GB')
     * @param string $to - unit after converting, belong list ('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB', 'BB', 'GB')
     * @param bool $binary - if binary is false
     */
    public function convert(int $convertValue, string $from = 'B', string $to = 'MB', bool $binary = true)
    {
        $indexFrom = -1;
        $indexTo = -1;
        $convert = ($binary) ? 1024 : 1000;
        for ($i = 0; $i < count(self::$_unit); $i ++) {
            if ($from == self::$_unit[$i]) {
                $indexFrom = $i;
            }

            if ($to == self::$_unit[$i]) {
                $indexTo = $i;
            }
        }

        if ($indexFrom == -1 || $indexTo == -1) {
            throw new Exception("Unit size not found!");
        }

        $different = $indexFrom - $indexTo;
        $space = abs($different);
        
        if ($different < 0) {
            return $convertValue * $convert * $space;
        } elseif ($different > 0) {
            return $convertValue / ($convert * $space);
        }

        return $convertValue;
    }

}
