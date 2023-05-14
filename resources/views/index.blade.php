@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                @if (session('success'))
                <div class="alert alert-2 alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif  
                @if (session('error'))
                <div class="alert alert-2 alert-warning alert-dismissible fade show" role="alert">
                    {{session('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                 @endif
                <div class="card-body">
                    {{ __('Liste des produits') }}
                    @if (Auth::user()->profil=='admin')
                    <a class="btn btn-primary float-end" href="{{ route('products.create') }}">Ajouter un nouveau produit</a>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                @if (Auth::user()->profil=='admin')
                                <th scope="col">Options</th> 
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>

                            @if (Auth::user()->profil=='admin')
                            
                            <td class="d-flex">
                                <a class="btn btn-primary me-2" href="{{ route('products.edit', ['product' => $product->id]) }}">Modifier</a>
                                        <form method="POST" action="{{ route('products.destroy', ['product' => $product->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Supprimer</button>
                                        </form>
                                        <script>
                                            function confirmDelete() {
                                                return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');
                                            }
                                            </script>
                            </td>
                        @endif
                        </tr>
                        @endforeach          
                        </tbody>
                      </table>
                   {{--   <table>
                        <tr>
                            <td><b>{{ $product->name }}</b></td>
                                    <td>{{ $product->description }}</td>
                                    <td class="d-flex">
                                <h2>{{ $product->name }}</h2>
                                <p>{{ $product->description }}</p>
                               <a class="btn btn-primary" href="{{ route('products.edit') }}">Modifier le produit</a> 
                                        
                                    </td>
                                </tr>
                            
                        </table>--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




