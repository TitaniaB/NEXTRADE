<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index',[
            'products'=>Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formulaire');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "description"=>"required"
        ]);
        
        $request = array(
            "name"=> $request->name,
            "description"=> $request->description,
        );
        if (Auth::user()->profil=='admin') {
            Product::create($request);
            return redirect()->route('products.index')->with('success', 'Le produit a été ajouté avec succès!');
        } else {
            return redirect()->route('products.index')->with("error","Vous n'avez pas les droits requis pour éffectuer cette action");
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $product = Product::find($id);
            return view('edit', ['product' => $product]);
        
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
        $product = Product::find($id);
    
        $request->validate([
            "name" => "required",
            "description" => "required"
        ]);

        if (Auth::user()->profil=='admin') {
            $product->name = $request->name;
            $product->description = $request->description;
            $product->save();
    
            return redirect()->route('products.index')->with('success', 'Le produit a été modifié avec succès !');
           
        } else {
            return redirect()->route('products.index')->with("error","Vous n'avez pas les droits requis pour éffectuer cette action");
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
        if (Auth::user()->profil=='admin') {
            $product = Product::find($id);
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Le produit a bien été supprimé!');
        } else {
            return redirect()->route('products.index')->with("error","Vous n'avez pas les droits requis pour éffectuer cette action");
        }
    }



}
