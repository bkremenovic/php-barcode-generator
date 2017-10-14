<?php

namespace Bkremenovic\Barcode;

class BarcodeGeneratorHTML extends BarcodeGenerator
{
    public function getBarcode($code, $type = BarcodeGenerator::TYPE_CODE_128, $heightFactor = 2, $totalWidth = 65, $color = 'black')
    {
        $barcodeData = $this->getBarcodeData($code, $type);

        $html = '<div style="font-size:0;position:relative;height:' . ($barcodeData['maxWidth'] * $heightFactor) . 'px;width:' . ($totalWidth) . 'px;">' . "\n";

        $positionHorizontal = 0;
        foreach ($barcodeData['bars'] as $bar) {
            $barWidth = round(($bar['width'] * $heightFactor), 3);
            $barHeight = round(($bar['height'] * $totalWidth / $barcodeData['maxHeight']), 3);

            if ($bar['drawBar']) {
                $positionVertical = round(($bar['positionVertical'] * $totalWidth / $barcodeData['maxHeight']), 3);
                // draw a vertical bar
                $html .= '<div style="background-color:' . $color . ';height:' . $barWidth . 'px;width:' . $barHeight . 'px;position:absolute;top:' . $positionHorizontal . 'px;left:' . $positionVertical . 'px;">&nbsp;</div>' . "\n";
            }

            $positionHorizontal += $barWidth;
        }

        $html .= '</div>' . "\n";

        return $html;
    }
}
