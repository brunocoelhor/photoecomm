<?php 

namespace app\classes;

class imagem
{
    private $novoNome;
	private $uploadImage;
	
	public function renomear($foto)
    {
		$explodeFoto = explode('.', $foto);
		$extensao = end($explodeFoto);
		$this->novoNome = uniqid().'.'.$extensao;
		return $this->novoNome;
	}
	
	public static function deletar($imagem)
    {
		if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$imagem)):
			@unlink($_SERVER['DOCUMENT_ROOT'].'/'.$imagem);	
		endif;
	}
	
	public function upload($wide,$pasta,$largura,$altura)
    {
		$this->uploadImagem = $wide->resize($largura,$altura,'fill');
		$this->uploadImagem->savetofile($_SERVER['DOCUMENT_ROOT'].'/'.$pasta.'/'.$this->novoNome, 80);
	}
	
	public static function isImage($foto)
    {
		$extensoesAceitas = array('jpg', 'jpeg', 'png');
		$explodeFoto = explode('.', $foto);
		$extensao = end($explodeFoto);
		
		if(in_array($extensao, $extensoesAceitas)):
			return true;
		else:
			return false;
		endif;
	}

	public function compress_image($source_url, $destination_url, $quality) {
	$info = getimagesize($source_url);
 
	if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
	elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
	elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
 
	//save file
	imagejpeg($image, $destination_url, $quality);
 
	//return destination file
	return $destination_url;
}
}
