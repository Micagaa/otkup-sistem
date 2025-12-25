<?php

namespace Tests\Unit;

use App\Models\SerijaPrerade;
use PHPUnit\Framework\TestCase;

class SerijaPreradeQualityStatusTest extends TestCase
{
    public function test_quality_status_helpers(): void
    {
        $serija = new SerijaPrerade();

        $serija->status_kvaliteta = 'ispravno';
        $this->assertTrue($serija->isQualityApproved());
        $this->assertFalse($serija->isQualityRejected());

        $serija->status_kvaliteta = 'neispravno';
        $this->assertTrue($serija->isQualityRejected());
        $this->assertFalse($serija->isQualityApproved());
    }
}
