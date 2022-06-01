<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TransitPlans;
use Illuminate\Http\Request;

class TransitPlansController extends Controller
{

    /**
     * @OA\Get(
     *     tags={"/Transit/seachByUserId"},
     *     path="/Transit/seachByUserId",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Retorna a lista completa de viagens. Ajustar")
     * )
     */
    public function index()
    {

        try {

            $travels = TransitPlans::get();

            return response()->json($travels, 200);//Retorno lista de viagens

        }catch (\Exception $e){

            return response()->json(['status'=>0, 'message'=>$e->getMessage(), 'code'=>$e->getCode()], 400); //Retorno mensagem de erro

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Não se aplica na API
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $data = $request->all();

            $validator = Validator::make($data, [
                'user_id' => 'require',
                'transit_number' => 'require|max:45',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'message'   => 'Falha na validação',
                    'errors'    => $validator->errors()->all()
                ], 422);
            }

            $add = TransitPlans::create($data);

            return response()->json($add, 200);

        }catch (\Exception $e){

            return response()->json(['status'=>0, 'message'=>$e->getMessage(), 'code'=>$e->getCode()], 400); //Retorno mensagem de erro

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {

            $travel = TransitPlans::findOrFail($id);

            return response()->json($travel, 200);

        }catch (\Exception $e){

            return response()->json(['status'=>0, 'message'=>$e->getMessage(), 'code'=>$e->getCode()], 400); //Retorno mensagem de erro

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
        //Não se aplica na API
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

        try {

            $data = $request->all();

            $validator = Validator::make($data, [
                'user_id' => 'require',
                'transit_number' => 'require|max:45|min:1',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'message'   => 'Falha na validação',
                    'errors'    => $validator->errors()->all()
                ], 422);
            }

            $up = TransitPlans::findOrFail($id);
            $up->fill($data);
            $up->save();

        }catch (\Exception $e){

            return response()->json(['status'=>0, 'message'=>$e->getMessage(), 'code'=>$e->getCode()], 400); //Retorno mensagem de erro

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @OA\Get(
     *     tags={"/Transit/seachByUserId"},
     *     path="/Transit/seachByUserId",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Retorna a lista de viagens pelo ID do usuário.")
     * )
     */
    public function seachByUserId($user_id){

        try {

            $travels = TransitPlans::where('user_id','=',$user_id)->get();

            return response()->json($travels, 200);//Retorno lista de viagens pelo ID do usuário

        }catch (\Exception $e){

            return response()->json(['status'=>0, 'message'=>$e->getMessage(), 'code'=>$e->getCode()], 400); //Retorno mensagem de erro

        }

    }

}
