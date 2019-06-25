<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function formataDataBr($data=NULL) 
{
  /* 
    FORMATO DO BANCO => 2019-06-08
    FORMATO BRASIL   => 08/06/2019
  */

  if($data) {

    // Separa a data em 3 partes
    $data_funcao = explode('-', $data);

    /*
      $data_funcao[2] = 08
      $data_funcao[1] = 06
      $data_funcao[0] = 2019
    */

    // Retorno a data pronta dia/mes/ano
    return $data_funcao[2].'/'.$data_funcao[1].'/'.$data_funcao[0];        
  } 
}

function formataMoeda($valor=NULL) 
{
   /*
      No Banco: $valor = 10.00
    */
  if($valor) {

    // Retorno o valor R$ 10,00
    return 'R$ '.number_format($valor, 2, ',', '.');   // 2 = quantidade de casas decimais, virgula para separar dezenas e ponto para milhares
  }
}
