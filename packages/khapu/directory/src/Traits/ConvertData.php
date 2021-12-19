<?php

namespace Khapu\Directory\Traits;

trait ConvertData
{
    public function convertByteToOther(int $value, int $size = 1)
    {
        $da = $value;
        $i = 0;
        $si = $size;
        $unit = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB', 'BB', 'GB'];
        if ($da === 0) {
            return [
                'value' => $da,
                'unit' => $unit[$i]
            ];
        }
        while (($da / 1024) >= $size) {
            $da = $da / 1024;
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