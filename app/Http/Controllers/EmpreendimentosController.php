<?php

namespace App\Http\Controllers;

use App\Empreendimento;
use App\Http\Requests\EmpreendimentoFormRequest;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;

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


    public function search(Request $request)
    {
        $empreendimentos = $this->find($request->all(), false);

        return str_replace("'", "\\u0027", json_encode($empreendimentos));
    }


    private function find($params, $pagination = 10)
    {
        $search = Empreendimento::leftJoin('colunas', 'colunas.empreendimento_id', '=', 'empreendimentos.id')
            ->leftJoin('anuncios', 'anuncios.coluna_id', '=', 'colunas.id')
            ->orderBy($this->getOrderBy($params, 'id'), $this->getOrder($params, 'desc'))
            ->select([ 'empreendimentos.*' ]);

        if (isset( $params['nome'] ) && ! empty( $params['nome'] )) {
            $search->where('nome', 'like', '%' . $params['nome'] . '%');
        }
        if (isset( $params['quartos'] ) && ! empty( $params['quartos'] )) {
            $search->where(function ($query) use ($params) {
                $query->where('colunas.quartos', '=', $params['quartos'])
                    ->orWhere('anuncios.quartos', '=', $params['quartos']);
            });
        }
        if (isset( $params['area_menor'] )) {
            $search->where('colunas.area', '>=', $params['area_menor']);
        }
        if (isset( $params['area_maior'] )) {
            $search->where('colunas.area', '<=', $params['area_maior']);
        }
        if (isset( $params['valor_menor'] )) {
            $search->where('anuncios.valor', '>=', $params['valor_menor']);
        }
        if (isset( $params['valor_maior'] )) {
            $search->where('anuncios.valor', '<=', $params['valor_maior']);
        }
        if (isset( $params['suites'] ) && ! empty( $params['suites'] )) {
            $search->where(function ($query) use ($params) {
                $query->where('colunas.suites', '=', $params['suites'])
                    ->orWhere('anuncios.suites', '=', $params['suites']);
            });
        }
        if (isset( $params['vagas'] ) && ! empty( $params['vagas'] )) {
            $search->where(function ($query) use ($params) {
                $query->where('colunas.garagem', '=', $params['vagas'])
                    ->orWhere('anuncios.garagem', '=', $params['vagas']);
            });
        }
        if (isset( $params['idade'] ) && ! empty( $params['idade'] )) {
            $year = Carbon::now()->year;
            switch ($params['idade']) {
                case 1:
                    $search->where('construido_em', '>', $year - 10);
                    break;
                case 2:
                    $search->where('construido_em', '>', $year - 20)
                        ->where('construido_em', '<=', $year - 10);
                    break;
                case 3:
                    $search->where('construido_em', '>', $year - 30)
                        ->where('construido_em', '<=', $year - 20);
                    break;
                case 4:
                    $search->where('construido_em', '<=', $year - 30);
                    break;
            }
        }
        if (isset( $params['aptos_andar'] ) && ! empty( $params['aptos_andar'] )) {
            $search->where('apartamentos_andar', '=', $params['aptos_andar']);
        }
        if (isset( $params['finalidade'] ) && ! empty( $params['finalidade'] )) {
            $search->where('finalidade', '=', $params['finalidade']);
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
