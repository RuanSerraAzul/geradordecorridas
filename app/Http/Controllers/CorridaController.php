<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Corridas;

class CorridaController extends Controller
{
    public function index(){
        return("Bem vindo ao gerador de corridas para o usuario, cheque a documentação para começar a usar! \n");
    }

    public function useCorridasData(){ //listar as corridas
        $corridas = Corridas::get()->toJson(JSON_PRETTY_PRINT);
        return response($corridas, 200);
    }

    public function addCorridasData(Request $request){ //adicionar corridas
        $validator = Validator::make($request->all(),[ //validador para não termos conflitos
            'idUser' =>'required|integer|min:1',
            'idDriver' =>'required|integer|min:1',
            'valor' => 'required|numeric',
            'pagamento' => 'required|string',
        ]);

        if($validator->fails()) { //se o validador falhar retornamos o erro
            $error = $validator->errors();

            return response()->json($error, 400);

        } else { //do contrario, podemos prosseguir com a inserção de dados
            $idUser= $request->input('idUser');
            $idDriver= $request->input('idDriver');
            $valor= $request->input('valor');
            $pagamento= $request->input('pagamento');
            $corrida = Corridas::add($idUser, $idDriver, $valor, $pagamento);

            return response()->json($corrida, 200);
        }
    }

    public function addCorridasPayment (Request $request){ //realizar o pagamento de corridas (apenas as encerradas)
        $validator = Validator::make($request->all(), [
            "id" => 'required|integer|min:1'
        ]);

        if($validator->fails()){
            $error = $validator->errors();

            return response()->json($error, 400);

        } else {
            $idCorrida = $request->input('id');
            $corrida = Corridas::pay($idCorrida);

            return response()->json($corrida, 200);

        }
    }

    public function endCorridas(Request $request){ //encerrar corridas para poder pagar-las
        $validator = Validator::make($request->all(), [
            "id" => 'required|integer|min:1'
        ]);

        if($validator->fails()){
            $error = $validator->errors();

            return response()->json($error, 400);

        } else {
            $idCorrida = $request->input('id');
            $corrida = Corridas::end($idCorrida);

            return response()->json($corrida, 200);
        }
    }

    public function cancelCorridas(Request $request){ //função de cancelar uma corrida
        $validator = Validator::make($request->all(), [
            "id" => 'required|integer|min:1'
        ]);

        if($validator->fails()){
            $error = $validator->errors();

            return response()->json($error, 400);

        } else {
            $idCorrida = $request->input('id');
            $corrida = Corridas::cancel($idCorrida);

            return response()->json($corrida, 200);

        }

    }
}
