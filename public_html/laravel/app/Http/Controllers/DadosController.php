<?php

namespace App\Http\Controllers;

use App\Jobs\CsvProcesso;
use Illuminate\Http\Request;
use App\Models\Dados;
use Illuminate\Support\Facades\Bus;

class DadosController extends Controller
{
    public function ImportarCSV(Request $request){
        if( $request->has('csv') ) {

            $csv    = file($request->csv);
            // 1000 disparos por job
            $chunks = array_chunk($csv,1000);
            $header = [];
            $batch  = Bus::batch([])->dispatch();

            foreach ($chunks as $key => $chunk) {
            $data = array_map('str_getcsv', $chunk);
                if($key == 0){
                    // monta base de header
                    $header[0] = 'from_postcode';
                    $header[1] = 'to_postcode';
                    $header[2] = 'from_weight';
                    $header[3] = 'to_weight';
                    $header[4] = 'cost';
                    unset($data[0]);
                } else {
                    // Explode os ; para transformar em array a coluna A para criar uma nova coluna para to_postcode
                    $dado = explode(";", $data[$key][0]);
                    unset($dado[2]);
                    unset($data[$key][0]);
                    $final[] = array_merge($dado, $data[$key]);
                    // adiciona a lista de disparo
                    $batch->add(new CsvProcesso($final, $header));
                }
            }
            
            return redirect()->route('send');
        }
        return "Volte e insira um CSV";
    }
}