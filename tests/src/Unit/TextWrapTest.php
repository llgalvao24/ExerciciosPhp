<?php

namespace Galoa\ExerciciosPhp\Tests\TextWrap;

use Galoa\ExerciciosPhp\TextWrap\Resolucao;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Galoa\ExerciciosPhp\TextWrap\Resolucao.
 *
 * @codeCoverageIgnore
 */
class TextWrapTest extends TestCase {

  /**
   * Test Setup.
   */
  public function setUp() {
    $this->resolucao = new Resolucao();
    $this->baseString = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
    $this->tinyBaseString = "Se me viu e não deu oi, não sei o que foi";
    $this->bigBaseString = "Paralelepípedo é uma palavra grande, mas Oftalmotorrinolaringologista é maior";
  }

  /**
   * Checa o retorno para strings vazias.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForEmptyStrings() {
    $ret = $this->resolucao->textWrap("", 2018);
    $this->assertCount(1, $ret);
    $this->assertEmpty($ret[0]);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallWords() {
    $ret = $this->resolucao->textWrap($this->baseString, 8);
    $this->assertCount(10, $ret);
    $this->assertEquals("Se vi", $ret[0]);
    $this->assertEquals("mais", $ret[1]);
    $this->assertEquals("longe", $ret[2]);
    $this->assertEquals("foi por", $ret[3]);
    $this->assertEquals("estar de", $ret[4]);
    $this->assertEquals("pé", $ret[5]);
    $this->assertEquals("sobre", $ret[6]);
    $this->assertEquals("ombros", $ret[7]);
    $this->assertEquals("de", $ret[8]);
    $this->assertEquals("gigantes", $ret[9]);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallWords2() {
    $ret = $this->resolucao->textWrap($this->baseString, 12);
    $this->assertCount(6, $ret);
    $this->assertEquals("Se vi mais", $ret[0]);
    $this->assertEquals("longe foi", $ret[1]);
    $this->assertEquals("por estar de", $ret[2]);
    $this->assertEquals("pé sobre", $ret[3]);
    $this->assertEquals("ombros de", $ret[4]);
    $this->assertEquals("gigantes", $ret[5]);
  }
  
  /**
   * Testa a quebra de linha para palavras muito curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForTinyWords() {
    $ret = $this->resolucao->textWrap($this->tinyBaseString, 4);
    $this->assertCount(12, $ret);
    $this->assertEquals("Se", $ret[0]);
    $this->assertEquals("me", $ret[1]);
    $this->assertEquals("viu", $ret[2]);
    $this->assertEquals("e", $ret[3]);
    $this->assertEquals("não", $ret[4]);
    $this->assertEquals("deu", $ret[5]);
    $this->assertEquals("oi,", $ret[6]);
    $this->assertEquals("não", $ret[7]);
    $this->assertEquals("sei", $ret[8]);
    $this->assertEquals("o", $ret[9]);
    $this->assertEquals("que", $ret[10]);
    $this->assertEquals("foi", $ret[11]);
  }
  
   /**
   * Testa a quebra de linha para palavras muito curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForTinyWords2() {
    $ret = $this->resolucao->textWrap($this->tinyBaseString, 10);
    $this->assertCount(5, $ret);
    $this->assertEquals("Se me viu", $ret[0]);
    $this->assertEquals("e não deu", $ret[1]);
    $this->assertEquals("oi, não", $ret[2]);
    $this->assertEquals("sei o que", $ret[3]);
    $this->assertEquals("foi", $ret[4]);
  }
  
   /**
   * Testa a quebra de linha para palavras muito longas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForBigWords() {
    $ret = $this->resolucao->textWrap($this->bigBaseString, 7);
    $this->assertCount(11, $ret);
    $this->assertEquals("Paralel", $ret[0]);
    $this->assertEquals("epípedo", $ret[1]);
    $this->assertEquals("é uma", $ret[2]);
    $this->assertEquals("palavra", $ret[3]);
    $this->assertEquals("grande,", $ret[4]);
    $this->assertEquals("mas Oft", $ret[5]);
    $this->assertEquals("almotor", $ret[6]);
    $this->assertEquals("rinolar", $ret[7]);
    $this->assertEquals("ingolog", $ret[8]);
    $this->assertEquals("ista é", $ret[9]);
    $this->assertEquals("maior", $ret[10]);
  }
  
}
