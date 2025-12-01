<?php

namespace App\Http\Livewire\Admin;

use App\Models\Boleta;
use App\Models\Resumen;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ResumenList extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    //public $shopping;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false; //para controlar el preloader inicia en false
    public $company;
    public $igv, $factoricbper;
    public $resumen;



    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];



    public function loadResumens()
    {
        $this->readyToLoad = true;
    }






    public function render()
    {

        if ($this->readyToLoad) {

            $company_id = auth()->user()->employee->company->id; //compania logueada
            $local_id = auth()->user()->employee->local->id; //local logueado



            //lista de comprobantes
            $resumens = Resumen::select('id', 'fechaescogida', 'fechadeenvio', 'ticket', 'numcomprobantes','state', 'serie', 'xml', 'cdr')
                ->where('serie', 'like', '%' . $this->search . '%')
                ->where('company_id', $company_id)
                ->where('local_id', $local_id)
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $resumens = [];
        }

        return view('livewire.admin.resumen-list', compact('resumens'));
    }



    public function downloadXml($resumenId)
    {
        $resumen = Resumen::findOrFail($resumenId);
        $xmlPath = $resumen->xml ?? $resumen->xml;

        if (!$xmlPath) {
            abort(404);
        }

        $fileContent = Storage::disk('s3')->get($xmlPath);
        $fileName = basename($xmlPath);

        return response()->streamDownload(function () use ($fileContent) {
            echo $fileContent;
        }, $fileName, [
            'Content-Type' => 'application/xml',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }



}
