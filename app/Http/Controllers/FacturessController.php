<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Exception;
use Illuminate\Http\Request;

class FacturessController extends Controller
{

    public function download(Request $request, $id)
    {
        $factures = Facture::find($id);
        $contenue=json_decode($factures->contenue);
        $total=0;
        foreach ($contenue as$value){
            $total+=$value->itemTotal;
        }
        return view('factures.factures',["factures"=>$factures,"contenue"=>$contenue,"total"=>$total]);
    }



}
