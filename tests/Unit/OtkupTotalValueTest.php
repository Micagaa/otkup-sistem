<?php

namespace Tests\Unit;

use App\Models\Otkup;
use PHPUnit\Framework\TestCase;

class OtkupTotalValueTest extends TestCase
{
    public function test_total_value_is_calculated_from_quantity_and_price(): void
    {
        $otkup = new Otkup();
        $otkup->kolicina_kg = 25;
        $otkup->cena_po_kg = 650;

        $this->assertEquals(16250.0, $otkup->ukupna_vrednost);
    }
}
