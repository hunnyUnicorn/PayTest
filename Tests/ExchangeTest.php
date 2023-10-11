<?php
namespace Win\Test;
use PHPUnit\Framework\TestCase;

final class ExchangeTest extends TestCase
{
  public function testEU() {
    $this->assertEquals(true, Exchange::isEu('AT'));
    $this->assertEquals(true, Exchange::isEu('DK'));
    $this->assertEquals(true, Exchange::isEu('IE'));
    $this->assertEquals(true, Exchange::isEu('MT'));
    $this->assertEquals(true, Exchange::isEu('SK'));
    $this->assertEquals(false, Exchange::isEu('AAA'));
    $this->assertEquals(false, Exchange::isEu('TTT'));
  }

  public function testRound() {
    $this->assertEquals(0.45, Exchange::round_up('0.45'));
    $this->assertEquals(0.45, Exchange::round_up('0.445'));
    $this->assertEquals(0.45, Exchange::round_up('0.444'));
    $this->assertEquals(0.45, Exchange::round_up('0.4445'));
  }
}
?>