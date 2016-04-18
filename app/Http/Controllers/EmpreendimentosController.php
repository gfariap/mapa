<?php

namespace App\Http\Controllers;

use App\Empreendimento;
use App\Http\Requests\EmpreendimentoFormRequest;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

use App\Http\Requests;

class EmpreendimentosController extends Controller
{

    /**
     * @var ImageUploadService
     */
    private $gerenciadorDeImagens;


    public function __construct(ImageUploadService $gerenciadorDeImagens)
    {
        $this->gerenciadorDeImagens = $gerenciadorDeImagens;
    }


    public function index(Request $request)
    {
        $empreendimentos = $this->find($request->all(), 20);

        $searchName = $request->get('nome');

        return view('empreendimentos.index', compact('empreendimentos', 'searchName'));
    }


    private function find($params, $pagination = 10)
    {
        $search = Empreendimento::orderBy($this->getOrderBy($params, 'id'),
            $this->getOrder($params, 'desc'))->select([ 'empreendimentos.*' ]);

        if (isset( $params['nome'] ) && ! empty( $params['nome'] )) {
            $search->where('nome', 'like', '%' . $params['nome'] . '%');
        }
        if ($pagination) {
            return $search->paginate($pagination);
        }

        return $search->get();
    }


    public function create()
    {
        return view('empreendimentos.create');
    }


    public function edit($id)
    {
        $empreendimento = Empreendimento::findOrFail($id);

        return view('empreendimentos.edit', compact('empreendimento'));
    }


    public function show(Request $request, $id)
    {
        $empreendimento = Empreendimento::findOrFail($id);

        if ($request->has('full')) {
            return view('empreendimentos.details', compact('empreendimento'));
        }

        return view('empreendimentos.teaser', compact('empreendimento'));
    }


    public function store(EmpreendimentoFormRequest $request)
    {
        $nomeDoArquivo = $this->gerenciadorDeImagens->salvarFachadaDeEmpreendimento($request->file('fachada'),
            $request->nome);

        $empreendimento = new Empreendimento;
        $empreendimento->fill($request->except([ 'fachada', 'lista_lazer' ]));
        $empreendimento->fachada = $nomeDoArquivo;

        $opcoesLazer = $request->get('lista_lazer', [ ]);
        if ( ! empty( $opcoesLazer )) {
            $empreendimento->lazer = implode(', ', $opcoesLazer);
        }

        $empreendimento->save();

        alert()->success('Empreendimento cadastrado! Inclua os dados das colunas.', 'Sucesso!')->persistent('OK');

        return redirect()->route('empreendimentos.edit', [ 'id' => $empreendimento->id ]);
    }


    public function update(EmpreendimentoFormRequest $request, $id)
    {
        $empreendimento = Empreendimento::findOrFail($id);
        $empreendimento->fill($request->except([ 'fachada', 'lista_lazer' ]));

        if ($request->file('fachada')) {
            $nomeDoArquivo           = $this->gerenciadorDeImagens->salvarFachadaDeEmpreendimento($request->file('fachada'),
                $request->nome);
            $empreendimento->fachada = $nomeDoArquivo;
        }

        $opcoesLazer = $request->get('lista_lazer', [ ]);
        if ( ! empty( $opcoesLazer )) {
            $empreendimento->lazer = implode(', ', $opcoesLazer);
        }

        $empreendimento->save();

        alert()->success('Os dados do empreendimento foram atualizados!', 'Sucesso!')->autoclose(5000);

        return redirect()->route('empreendimentos.index');
    }


    public function destroy($id)
    {
        $empreendimento = Empreendimento::findOrFail($id);

        if ($empreendimento->colunas()->count() > 0) {
            alert()->error('Não foi possível excluir o empreendimento, pois já existem colunas vinculadas a ela!',
                'Atenção!')->persistent('Fechar');
        } else {
            $empreendimento->delete();

            alert()->success('Empreendimento excluído!', 'Sucesso!')->autoclose(5000);
        }

        return redirect()->route('empreendimentos.index');
    }

}
