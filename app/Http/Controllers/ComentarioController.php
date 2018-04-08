<?php

namespace App\Http\Controllers;

use App\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Validator;

class ComentarioController extends Controller {

    /**
     * Método de carregamento da página inicial
     * @param null $locale
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale = null) {

        // walkaround para definir sempre o locale chamado
        $this->adjustLocale($locale);

        return view("index");
    }

    /**
     * Método para inserção dos comentários através do formulário
     * @param Request $request
     * @param $locale
     * @return \Illuminate\Http\JsonResponse
     */
    public function insert(Request $request, $locale) {

        $this->adjustLocale($locale);

        $validate = Validator::make($request->all(), [
                "nome" => "required",
                "email" => "required|email",
                "comentario" => "required|max:125",
            ],
            [
                "nome.required" => __("form_error_nome_req"),
                "email.required" => __("form_error_email_req"),
                "email.email" => __("form_error_email_val"),
                "comentario.required" => __("form_error_comentario_req"),
                "comentario.max" => __("form_error_comentario_siz"),
            ]
        );

        $retorno = [];

        if($validate->passes()) {

            $comentario = new Comentario;
            $comentario->nome = htmlentities($request->input("nome"));
            $comentario->email = htmlentities($request->input("email"));
            $comentario->comentario = htmlentities($request->input("comentario"));

            if($comentario->save()) {
                $retorno = ["success" => __("form_success")];
            }
            else {
                $retorno = ["error" => __("form_save_error")];
            }

        }
        else {
            $retorno = ["error" => $validate->errors()->all()];
        }

        return response()->json($retorno);
    }


    /**
     * Retorna todos os comentários cadastrados ou os após a data informada
     * @param $locale
     * @param $date
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function all($locale = null, $date = null) {

        $this->adjustLocale($locale);

        $data_tmp = \DateTime::createFromFormat("Y-m-d H:i:s", $date);

        if(!is_null($date) && !empty($date) && $data_tmp->format("Y-m-d H:i:s") == $date) {
            $date_new = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
            $retorno = Comentario::whereRaw(["created_at" => ['$gt' => $date_new]])->get();
        }
        else {
            $retorno = Comentario::all();
        }

        return response()->json($retorno);
    }


    /**
     * Retorna a quantidade de comentários por data
     * @param null $locale
     * @return \Illuminate\Http\JsonResponse
     */
    public function intervalos($locale = null) {

        $this->adjustLocale($locale);

        $retorno = [];
        // $retorno = ["series" => [], "ticks" => [], "subt" => []];
        $labels = [];
        $valores = [];
        $subt = [];

        // $comentarios = Comentario::all();

        // $result = \DB::collection("comentarios")->raw(function($collection) {
        $result = Comentario::raw(function($collection) {
            return $collection->aggregate([
                ['$group' => [
                        '_id'   => [
                            'dia' => ['$dateToString' =>['format' => '%d/%m/%Y', 'date' => '$created_at']],
                        ],
                        'qtd' => ['$sum' => 1],
                    ],
                ],
                ['$project' => [
                    'dia' => 1,
                    'qtd' => 1,
                    'media-hora' => ['$divide' => ['$qtd', 24]]
                    ],
                ],
                ['$sort' => ['_id' => 1],],
            ]);
        });

        if(count($result) > 0) {

            foreach ($result as $item => $value) {
                $labels[] = $value["_id"]["dia"];
                $valores[] = $value["qtd"];
            }

            $retorno["labels"] = $labels;
            $retorno["valores"] = $valores;

        }

        return response()->json($retorno);

    }


    /**
     * Método para inserção em sessão do Laravel do local (idioma) carregado atualmente
     * @param null $locale
     */
    private function adjustLocale($locale = null) {

        if(!isset($locale) || is_null($locale) || $locale === "") {

            $valor = config("app.locale");

            App::setLocale(config("app.locale"));
        }
        else {
            App::setLocale($locale);
        }

    }

}
