<?php
require("classproduit.php");
class Gauss extends Matrice{
	private $matriceG1 = array();
	private $matriceA2 = array();
	private $matriceY2 = array();
	private $matriceG2 = array();
	private $matriceA3 = array();
	private $matriceY3 = array();
	private $matriceG3 = array();
	private $matriceA4 = array();
	private $matriceY4 = array();
	function __construct($matA, $matB){
		$this->matriceA = $matA;
		$this->matriceB = $matB;
		for ($i = 0; $i < count($matA); ++$i){
			for ($j = 0; $j < count($matA[0]); ++$j){
				if ($i == $j)
				{
					$this->matriceG1[$i][$j] = 1;
					$this->matriceG2[$i][$j] = 1;
					$this->matriceG3[$i][$j] = 1;
				}
				else
				{
					$this->matriceG1[$i][$j] = 0;
					$this->matriceG2[$i][$j] = 0;
					$this->matriceG3[$i][$j] = 0;
				}
			}
		}
	}

	function verif_a11(){
		if ($this->matriceA[0][0] == 0){
			for ($i = 1; $i < count($this->matriceA); ++$i){
				if ($this->matriceA[$i][0] != 0){
					$tmp = $this->matriceA[0][0];
					$this->matriceA[0][0] = $this->matriceA[$i][0];
					$this->matriceA[$i][0] = $tmp;
					break;
				}
			}
		}
	}

	function verif_b22(){
		if ($this->matriceA2[1][1] == 0){
			for ($i = 2; $i < count($this->matriceA2); ++$i){
				if ($this->matriceA2[$i][1] != 0){
					$tmp = $this->matriceA2[1][1];
					$this->matriceA2[1][1] = $this->matriceA2[$i][1];
					$this->matriceA2[$i][1] = $tmp;
					break;
				}
			}
		}
	}

	function verif_c33(){
		if ($this->matriceA3[2][2] == 0){
			$tmp = $this->matriceA3[2][2];
			$this->matriceA3[2][2] = $this->matriceA3[3][2];
			$this->matriceA2[3][2] = $tmp;
		}
	}

	function calcul_G1(){
		for ($i = 1; $i < count($this->matriceA); ++$i){
			$this->matriceG1[$i][0] = (-($this->matriceA[$i][0]) / $this->matriceA[0][0]);
		}
	}

	function calcul_G2(){
		for ($i = 2; $i < count($this->matriceA2); ++$i){
			$this->matriceG2[$i][1] = (-($this->matriceA2[$i][1]) / $this->matriceA2[1][1]);
		}
	}

	function calcul_G3(){
		$this->matriceG3[3][2] = (-($this->matriceA3[3][2]) / $this->matriceA3[2][2]);
	}

	function calcul_A2_Y2()
	{
		$a2 = new Produit($this->matriceG1, $this->matriceA);
		$a2->operation();
		$this->matriceA2 = $a2->getMatriceProduit();
		$y2 = new Produit($this->matriceG1, $this->matriceB);
		$y2->operation();
		$this->matriceY2 = $y2->getMatriceProduit();
	}

	function calcul_A3_Y3()
	{
		$a3 = new Produit($this->matriceG2, $this->matriceA2);
		$a3->operation();
		$this->matriceA3 = $a3->getMatriceProduit();
		$y3 = new Produit($this->matriceG2, $this->matriceY2);
		$y3->operation();
		$this->matriceY3 = $y3->getMatriceProduit();
	}

	function calcul_A4_Y4()
	{
		$a4 = new Produit($this->matriceG3, $this->matriceA3);
		$a4->operation();
		$this->matriceA4 = $a4->getMatriceProduit();
		$y4 = new Produit($this->matriceG3, $this->matriceY3);
		$y4->operation();
		$this->matriceY4 = $y4->getMatriceProduit();
	}

	function operation(){
	}

	function getMatriceG1(){
		return $this->matriceG1;
	}

	function getMatriceA2(){
		return $this->matriceA2;
	}
	function getMatriceY2(){
		return $this->matriceY2;
	}
	function getMatriceG2(){
		return $this->matriceG2;
	}
	function getMatriceA3(){
		return $this->matriceA3;
	}
	function getMatriceY3(){
		return $this->matriceY3;
	}
	function getMatriceG3(){
		return $this->matriceG3;
	}
	function getMatriceA4(){
		return $this->matriceA4;
	}
	function getMatriceY4(){
		return $this->matriceY4;
	}
}