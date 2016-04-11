<?php

namespace App\Http\Controllers;

use App\Coluna;
use App\Http\Requests\ColunaFormRequest;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

use App\Http\Requests;

class ColunasController extends Controller
{

    /**
     * @var ImageUploadService
     */
    private $gerenciadorDeImagens;


    public function __construct(ImageUploadService $gerenciadorDeImagens)
    {
        $this->gerenciadorDeImagens = $gerenciadorDeImagens;
    }


    public function create($id)
    {
        return view('colunas.create', [ 'empreendimento_id' => $id ]);
    }


    public function edit($id, $coluna_id)
    {
        $coluna = Coluna::findOrFail($coluna_id);

        return view('colunas.edit', compact('coluna'));
    }


    public function show($id, $coluna_id)
    {
        return Coluna::findOrFail($coluna_id);
    }


    public function store(ColunaFormRequest $request, $id)
    {
        $nomeDoArquivo = $this->gerenciadorDeImagens->salvarPlantaDeColuna($request->file('planta'),
            $request->titulo);

        $coluna = new Coluna;
        $coluna->fill($request->except([ 'planta' ]));
        $coluna->empreendimento_id = $id;
        $coluna->planta = $nomeDoArquivo;

        $coluna->save();

        alert()->success('Coluna cadastrada!', 'Sucesso!')->autoclose(5000);

        return redirect()->route('empreendimentos.edit', [ 'id' => $id ]);
    }


    public function update(ColunaFormRequest $request, $id, $coluna_id)
    {
        $coluna = Coluna::findOrFail($coluna_id);
        $coluna->fill($request->except([ 'planta' ]));

        if ($request->file('planta')) {
            $nomeDoArquivo           = $this->gerenciadorDeImagens->salvarPlantaDeColuna($request->file('planta'),
                $request->titulo);
            $coluna->planta = $nomeDoArquivo;
        }

        $coluna->save();

        alert()->success('Os dados da coluna foram atualizados!', 'Sucesso!')->autoclose(5000);

        return redirect()->route('empreendimentos.edit', [ 'id' => $id ]);
    }


    public function destroy($id, $coluna_id)
    {
        $coluna = Coluna::findOrFail($coluna_id);

        if ($coluna->anuncios()->count() > 0) {
            alert()->error('Não foi possível excluir a coluna, pois já existem anúncios vinculados a ela!',
                'Atenção!')->persistent('Fechar');
        } else {
            $coluna->delete();

            alert()->success('Coluna excluída!', 'Sucesso!')->autoclose(5000);
        }

        return redirect()->route('empreendimentos.edit', [ 'id' => $id ]);
    }

}
