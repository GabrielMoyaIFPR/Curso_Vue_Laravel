<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TarefasExport;
use PDF;

class TarefaController extends Controller
{
    // Authentication
    public function __construct(){
        $this->middleware('auth');
    }
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $tarefas = Tarefa::where('user_id', $user_id)->paginate(10);
        return view('tarefa.index', ['tarefas' => $tarefas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all('tarefa','data_limite_conclusao');
        $dados['user_id'] = auth()->user()->id;


        if($request->input('_token') != '' && $request->input('id') == '') {
            $regras = [
            'tarefa'=> 'required|min:3|max:40',
            'data_limite_conclusao' => 'required'
            ];

            $feedback = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'tarefa.min' => 'A tarefa deve ter no mínimo 3 caracteres',
            'tarefa.max' => 'A tarefa deve ter no máximo 40 caracteres',
            ];

            $request->validate($regras, $feedback);
        }


        $tarefa = Tarefa::create($dados);
        $destinatario = auth()->user()->email;// Email do usuário logado
        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));
        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        $user_id = auth()->user()->id;
        $tarefa->user_id;
        if($tarefa->user_id == $user_id) {
            return view('tarefa.edit', ['tarefa' => $tarefa]);
        }

        return view('acesso-negado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {

        if($request->input('_token') != '' && $request->input('id') == '') {
            $regras = [
            'tarefa'=> 'required|min:3|max:40',
            'data_limite_conclusao' => 'required'
            ];

            $feedback = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'tarefa.min' => 'A tarefa deve ter no mínimo 3 caracteres',
            'tarefa.max' => 'A tarefa deve ter no máximo 40 caracteres',
            ];

            $request->validate($regras, $feedback);
        }

        if(!$tarefa->user_id == auth()->user()->id) {
            return view('acesso-negado');
        }
        $tarefa->update($request->all());
        return redirect()->route('tarefa.show', ['tarefa' => $tarefa]);
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        if(!$tarefa->user_id == auth()->user()->id) {
            return view('acesso-negado');
        }
        $tarefa->delete();
        return redirect()->route('tarefa.index');
    }

    public function exportacao($extensao){

        if(in_array($extensao, ['xlsx', 'csv', 'pdf'])){
            return Excel::download(new TarefasExport, 'lista_de_tarefas.'.$extensao);
        }

        return redirect()->route('tarefa.index');
        
    }

    public function exportar() {
        $tarefas = auth()->user()->tarefas()->get();
        $pdf = PDF::loadView('tarefa.pdf', ['tarefas' => $tarefas]);

        $pdf->setPaper('a4', 'landscape'); // definindo tipo de papel e orientação da imagem

        //return $pdf->download('lista_de_tarefas.pdf'); //Baixar o conteudo
        return $pdf->stream('lista_de_tarefas.pdf'); //Abrir no navegador
    }
}
