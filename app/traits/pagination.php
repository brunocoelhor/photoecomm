<?php

namespace app\traits;

trait pagination
{

    private $totalRegistros;
    private $limite;
    private $offset;
    private $pagina;
    private $totalPaginas;
    private $numeroPagina;
    private $segmentoLink;
    private $serverUrl;
    private $paginaAtual;
    private $links;

    static $nextLabel = '>>';
    static $prevLabel = '<<';
    static $siteUrl = 'http://twig.localhost.com.br:8888';


    public function getTotalRegistros() 
    {
        return $this->totalRegistros;
    }

    public function setTotalRegistros($totalRegistros) 
    {
        $this->totalRegistros = $totalRegistros;
    }

    public function getLimite() 
    {
        return $this->limite;
    }

    public function setLimite($limite) 
    {
        $this->limite = $limite;
    }

    public function getTotal_paginas() 
    {
        return $this->totalPaginas;
    }

    public function setTotal_paginas($totalPaginas) 
    {
        $this->totalPaginas = $totalPaginas;
    }

    public function setPaginaAtual($paginaAtual) 
    {
        $this->paginaAtual = $paginaAtual;
    }

    public function getPaginaAtual() 
    {
        return $this->paginaAtual;
    }

    private function verificarNumeroDaPagina($urlVerificarNuemro) 
    {
        $this->numeroPagina = (preg_match('/[0-9]/', $urlVerificarNuemro)) ? $urlVerificarNuemro : 1;
        return $this->numeroPagina;
    }

    public function numeroPaginaAtual() 
    {
        $this->pagina = $this->getPaginaAtual();
        return $this->pagina;
    }

    public function offset() 
    {
        return $this->offset = ($this->numeroPaginaAtual() * $this->getLimite()) - $this->getLimite();
    }

    private function nextLink() 
    {
        if ($this->pagina < $this->totalDePaginas()) 
        {
            return '<a href="'.self::$siteUrl.$this->segmentoLink.'pag/' . ($this->pagina + 1) . '">' . self::$nextLabel . '</a>';
        }
    }

    private function prevLink() 
    {
        if ($this->pagina <= $this->totalDePaginas() && $this->pagina > 1) 
        {
            return '<a href="'.self::$siteUrl.$this->segmentoLink.'pag/' . ($this->pagina - 1) . '">' . self::$prevLabel . '</a>';
        }
    }

    private function totalDePaginas() 
    {
        return $this->totalPaginas = ceil($this->getTotalRegistros() / $this->getLimite());
    }

    private function segmentoUrl()
    {
        $numeroBarras = substr_count($_SERVER['REQUEST_URI'],'/');
        if($numeroBarras > 1)
        {
            $explodeBarras = explode("/",$_SERVER['REQUEST_URI']);
            $posicaoPagina = array_search('pag',$explodeBarras);

            if(!$posicaoPagina)
            {
                foreach($explodeBarras as $barra)
                {
                    if(!empty($barra))
                    {
                        $this->segmentoLink.= '/'.$barra.'/';
                    }
                }
            }
            else
            {
                for($i = 0;$i<$posicaoPagina;$i++)
                {
                    $this->segmentoLink.= $explodeBarras[$i].'/';
                }
            }
        }
        return $this->segmentoLink;
    }

    public function gerarLinks() 
    {
       $this->segmentoUrl();
       $this->links.= '<div>';
       $this->links.=  '<ul class="pagination">';
       $this->links.=  '<li>'.$this->prevLink().'</li>';
        for ($i = 1; $i <= $this->totalDePaginas(); $i++):
            ?>
            <?php  $this->links.= "<li".($i == $this->numeroPaginaAtual() ? ' class="active"' : '').">"."<a href=".self::$siteUrl.$this->segmentoLink.'pag/' . $i.">".$i."</a></li>"; ?>
            <?php
        endfor;
        $this->links.=  '<li>'.$this->nextLink().'</li>';
        $this->links.=  '</ul>';
        $this->links.=  '</div>';
        return $this->links;
    }

}