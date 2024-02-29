<?php

namespace App\Http\Controllers;

use App\Models\SalesOrder;
use Illuminate\Http\Request;

class SalesOrderController extends Controller
{
    //
    public function handlePolling(Request $request){
        $data = $request->all();
        $documento =  $data[0]['cabecera']['documento'];
        $cabecera = $data[0]['cabecera'];
        $detalle = $data[0]['detalle'];
        $doc_rels = $detalle['documentosRelacionados'];
        if ($doc_rels['ordenCompra'] !== null) {
            foreach ($doc_rels['ordenCompra'] as $oc) {
                return $oc;
            }
        }
        if ($doc_rels['sinOrdenCompra'] != null) {
            foreach ($doc_rels['sinOrdenCompra'] as $soc) {
                return $soc;
            }
        }
        $salesOrder = [
            'idDocumento' => $documento['idDocumento'],
            'razonsocialReceptor' => $cabecera['receptor']['razonsocialReceptor'],
            'rutReceptor'=> $cabecera['receptor']['rutReceptor'],
            'centroCosto'=> '',
            'cuentaContable'=>  $documento['codigoCentroGestion']. ' - '. $documento['nombreCentrogestion'],
            'detalle'=> []
        ];
        return $salesOrder;
    }
}
