<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use App\Models\Drivers;

class Corridas extends Model
{
    public $timestamps = false;

    protected $table = 'corridas';

    protected $fillable = [
        "idUser","idDriver","valor","status","pagamento", "pagamento_status"
    ];

    public static function add($idUser, $idDriver, $valor, $pagamento){

        $idUserExst = Users::where('id', $idUser)
        ->get('corridas_feitas');


            if($idUserExst->isEmpty()){
                die("Usuario nao existe no banco de dados");

            } else {
                $registroUpdate = Users::find($idUser);
                $corridasFeitas = $registroUpdate->corridas_feitas+1;

                Users::where('id',$idUser)
                    ->update(['corridas_feitas'=>$corridasFeitas]);

                    
                $idDriverExst = Drivers::where('id', $idDriver)
                ->get('corridas_feitas');

                    if($idDriverExst==""){
                        die("Motorista nao existe no banco de dados");

                    } else {
                        $registroUpdate = Drivers::find($idDriver);
                        $corridasFeitas = $registroUpdate->corridas_feitas+1;

                        Drivers::where('id',$idDriver)
                            ->update(['corridas_feitas'=>$corridasFeitas]);


                        Corridas::insert([
                            'idUser' => $idUser,
                            'idDriver' => $idDriver,
                            'valor' => $valor,
                            'status' => 'em andamento',
                            'pagamento' => $pagamento,
                        
                        ]);

                        return("Corrida adicionada com sucesso");
                    } 
            }
    }

    public static function pay($id){
        

        $registroUpdate = Corridas::find($id);
        $pagamento_status = $registroUpdate ->pagamento_status;
        $status = $registroUpdate->status;

        if($status=="cancelada"){
            die("voce não pode pagar uma corrida cancelada");
        }

        if($status == "em andamento"){
            die("voce nao pode pagar uma corrida em andamento, encerre a corrida primeiro para poder pagar");

        } elseif($status=="encerrada") {

            if($pagamento_status=="pago"){

                return("A corrida ja esta paga!");

            } else {

                $valorCorrida=$registroUpdate->valor;
                $idDriver= $registroUpdate->idDriver;

                $motoristaUpdate = Drivers::find($idDriver);
                $saldo = $motoristaUpdate->saldo;
                $novoSaldo = $saldo + $valorCorrida;

                Corridas::where('id',$id)
                    ->update(['pagamento_status'=>'pago']);

                Drivers::where('id', $idDriver)
                    ->update(['saldo'=>$novoSaldo]);

                return("O pagamento da corrida foi efetuado e o saldo do motorista foi atualizado");
            }

        }

    }

    public static function end($id){
        $registroUpdate = Corridas::find($id);
        $status = $registroUpdate->status;

        if($status == "em andamento"){
            Corridas::where('id',$id)
                ->update(['status'=>'encerrada']);

            return("Corrida encerrada com sucesso!");

        } elseif($status == "cancelada") {
            return("a corrida foi cancelada");

        } elseif($status =="encerrada"){
            return("a corrida foi finalizada");
        }

    }

    public static function cancel($id){
        $registroUpdate = Corridas::find($id);
        $status = $registroUpdate->status;

        if($status == "em andamento"){
            Corridas::where('id',$id)
                ->update(['status'=>'cancelada']);

            return("Corrida cancelada com sucesso!");

        } elseif($status == "cancelada") {
            return("a corrida ja foi encerrada, nao e possivel cancelar novamente");

        } else {
            return("a corrida ja foi encerrada, nao e possivel cancelar");
        }

    }

    
}
