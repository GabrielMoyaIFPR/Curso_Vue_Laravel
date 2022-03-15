<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TarefasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return auth()->user()->tarefas()->get();

    }

    public function headings():array { //declarando o tipo de retorno
        return [
            'Id da Tarefa',
            'Tarefa',
            'Data Limite de Conclusão'
        ];
    }

    //Definindo informações exportadas
    public function map($linha):array {
        return [
            $linha->id,
            $linha->tarefa,
            date('d/m/y', strtotime($linha->data_limite_conclusao))
        ];
    }
}
