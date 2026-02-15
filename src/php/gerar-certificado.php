<?php
    error_reporting(E_ALL);
ini_set('display_errors', 1);

    require 'conexao.php';
    require 'fpdf/fpdf.php';


    $nome = urldecode($_GET['nome']);
    $tipo = urldecode($_GET['tipo']);
    $nivel = urldecode($_GET['nivel']);
    $acertos =urldecode($_GET['acertos'])." de 50";
   

    $imagem = imagecreatefrompng("../../src/templates/".$nivel."/".$tipo.".png");
    /* @Parametros
     * "foto.jpg" - Caminho relativo ou absoluto da imagem a ser carregada.
     */

    $fontName = '../../src/fonts/Italianno-Regular.ttf';//imageloadfont('./OpenSans-Bold.ttf')
    $fontNumber = '../../src/fonts/Poppins-Bold.ttf';//imageloadfont('./OpenSans-Bold.ttf')
    // Cor de saída
    $cores = [
      1 => imagecolorallocate($imagem, 19,88, 161),
      2 => imagecolorallocate($imagem, 192,156, 82),
      3 => imagecolorallocate($imagem, 60,81, 39),
    ];
$nome = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $nome);


$larguraImagem = imagesx($imagem);

$box = imagettfbbox(45, 0, $fontName, $nome);

// largura real do texto
$larguraTexto = $box[2] - $box[0];

// posição X corrigida
$x = ($larguraImagem - $larguraTexto) / 2 - $box[0];




    // /* @Parametros
    //  * $_GET['nome'] - Texto que será escrito
    //  */

        imagettftext($imagem, 45, 0, $x, 260, $cores[$nivel], $fontName,$nome);
        imagettftext($imagem, 10, 0, 485, 420, $cores[$nivel], $fontNumber,$acertos);

         
// salva imagem temporária
$tmp = "temp_certificado.png";
imagepng($imagem, $tmp, 0); // ← qualidade máxima (0 = sem compressão)

// pega dimensões reais
list($w, $h) = getimagesize($tmp);

// converte para mm (300 DPI)
$mm_w = $w * 25.4 / 300;
$mm_h = $h * 25.4 / 300;

// cria PDF
$pdf = new FPDF('L', 'mm', [$mm_w, $mm_h]);
$pdf->AddPage();
$pdf->Image($tmp, 0, 0, $mm_w, $mm_h);

// remove arquivo temporário
unlink($tmp);

// envia pro navegador
$pdf->Output("D", "certificado.pdf");


