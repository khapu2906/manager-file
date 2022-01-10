<?php

namespace Khapu\Directory\Traits;

trait ConvertData
{
    /**
     * @param int $value - value be needed to convert
     * @param int $size - size of desired data
     * @param bool $binary - if binary is false 
     */
    public function convertByteToOther(int $value, int $size = 1, bool $binary = true)
    {
        $da = $value;
        $i = 0;
        $convert = ($binary) ? 1024 : 1000;
        $unit = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB', 'BB', 'GB'];
        if ($da === 0) {
            return [
                'value' => $da,
                'unit' => $unit[$i]
            ];
        }
        while (($da / $convert) >= $size) {
            $da = $da / $convert;
            $i ++;
        }
        return [
            'value' => ceil($da),
            'unit' => $unit[$i]
        ];
    }

    public function convertOthertoByte(int $value, int $size, string $unit)
    {
        $da = $value;
    }
}