<?php

namespace App\Http\Controllers;

use App\Anuncio;
use App\Http\Requests\AnuncioFormRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class AnunciosController extends Controller
{

    public function index(Request $request)
    {
        $anuncios = $this->find($request->all(), 20);

        $searchTitulo = $request->get('titulo');

        return view('anuncios.index', compact('anuncios', 'searchTitulo'));
    }


    private function find($params, $pagination = 10)
    {
        $search = Anuncio::orderBy($this->getOrderBy($params, 'id'),
            $this->getOrder($params, 'desc'))->select([ 'anuncios.*' ]);

        if (isset( $params['titulo'] ) && ! empty( $params['titulo'] )) {
            $search->where('titulo', 'like', '%' . $params['titulo'] . '%');
        }
        if ($pagination) {
            return $search->paginate($pagination);
        }

        return $search->get();
    }


    public function create()
    {
        return view('anuncios.create');
    }


    public function edit($id)
    {
        $anuncio = Anuncio::findOrFail($id);

        return view('anuncios.edit', compact('anuncio'));
    }


    public function store(AnuncioFormRequest $request)
    {
        $anuncio = new Anuncio;
        $anuncio->fill($request->all());
        $anuncio->save();

        alert()->success('Anúncio cadastrado.', 'Sucesso!')->autoclose(5000);

        return redirect()->route('anuncios.index');
    }


    public function update(AnuncioFormRequest $request, $id)
    {
        $anuncio = Anuncio::findOrFail($id);
        $anuncio->fill($request->all());
        $anuncio->save();

        alert()->success('Os dados do anúncio foram atualizados!', 'Sucesso!')->autoclose(5000);

        return redirect()->route('anuncios.index');
    }


    public function destroy($id)
    {
        $anuncio = Anuncio::findOrFail($id);
        $anuncio->delete();

        alert()->success('Anúncio excluído!', 'Sucesso!')->autoclose(5000);

        return redirect()->route('anuncios.index');
    }

}
