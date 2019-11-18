<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Resources\ContatoResource;
use App\Contato;
use App\Endereco;
use App\Http\Requests;
use Canducci\ZipCode\Facades\ZipCode;
use Response;

// 17/11/2019 às 15h30

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp = Contato::all();
        return ContatoResource::collection($emp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cont = new Contato;

        $cont->nome = $request->input('nome');
        $cont->telefone = $request->input('telefone');
        $cont->email = $request->input('email');
        //$cont->CEP = $request->input('CEP');

        $zipCodeInfo = ZipCode::find($request->input('CEP'));

        if ($zipCodeInfo) {
            $cont->CEP = $request->input('CEP');
            $cont->save();

            $jsonendereco = json_decode($zipCodeInfo->getJson(), true);

            $endereco = Endereco::firstOrCreate($jsonendereco);

            return [
                "Novo contato criado com sucesso",
                Response::json($cont),
                //"Endereço salvo na base de dados",
                //Response::json($endereco),
                $this->check($endereco),
            ];

        } else {
            return "Este CEP não é válido";
        }
    }

    public function check($endereco) {
        if ($endereco->wasRecentlyCreated) {
            return [
                "Novo endereço salvo na base de dados",
                $endereco,
            ];
        } else {
            return "Este endereço já consta na base de dados";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showId($id)
    {
        $contato = Contato::find($id);

        if ($contato){
            return Response::json($contato);
        }

        return "Contato não encontrado";
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $nome
     * @return \Illuminate\Http\Response
     */
    public function showNome($nome)
    {
        $column = 'nome';
        $contato = Contato::where($column , 'like', '%'.$nome.'%')->get();

        if ($contato) {
            return Response::json($contato);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $nome
     * @return \Illuminate\Http\Response
     */
    public function showEmail($email)
    {
        $column = 'email';
        $contato = Contato::where($column , 'like', '%'.$email.'%')->get();

        if ($contato){
            return Response::json($contato);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cont = Contato::findOrfail($id);
        
        if($cont->delete()){
            return [
                "Contato deletado com sucesso", 
                Response::json($cont)
            ];
        }
    }
}
