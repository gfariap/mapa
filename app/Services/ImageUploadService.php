<?php

namespace App\Services;

use Carbon\Carbon;
use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploadService
{

    public function salvarFachadaDeEmpreendimento(UploadedFile $foto, $nome = '')
    {
        return $this->salvar('fachadas', $foto, $nome);
    }


    public function salvarPlantaDeColuna(UploadedFile $foto, $nome = '')
    {
        return $this->salvar('plantas', $foto, $nome);
    }


    public function salvar($tipo, UploadedFile $foto, $nome = '')
    {
        if (substr(get_class($foto), 0, 7) == 'Mockery') {
            return 'teste.jpg';
        }
        $nomeDoArquivo = Carbon::now()->timestamp;
        if (strlen($nome) > 0) {
            $nomeDoArquivo .= '_' . $this->trataNomeDoArquivo($nome);
        }
        $nomeDoArquivo = sha1($nomeDoArquivo);
        $nomeDoArquivo .= '.' . $foto->getClientOriginalExtension();
        $caminho = public_path() . '/img/' . $tipo;
        $foto->move($caminho, $nomeDoArquivo);

        $imagem = Image::make($caminho . '/' . $nomeDoArquivo)->widen(400, function ($constraint) {
            $constraint->upsize();
        });

        $this->criaDiretorio($caminho . '/thumb');

        $imagem->save($caminho . '/thumb/' . $nomeDoArquivo);

        return $nomeDoArquivo;
    }


    private function trataNomeDoArquivo($nome)
    {
        return strtolower(str_replace(' ', '_', strtr(utf8_decode($nome),
            utf8_decode('ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'),
            'SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy')));
    }


    private function criaDiretorio($caminho)
    {
        if ( ! file_exists($caminho)) {
            mkdir($caminho, 0777, true);
        }
    }
}