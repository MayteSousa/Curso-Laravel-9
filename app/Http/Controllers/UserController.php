<?php

namespace App\Http\Controllers;

use \App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //ESTE É UM EXEMPLO DE REALIZAR PESQUISA ATRAVES DE UM FORMULARIO
        //$users = User::where('name', 'LIKE', "%{$request->search}%")->get();      

        //OUTRA FORMA DE FAZER PESQUISA
        $search = $request->search;
        $users = User::where(function($query) use ($search) {
            if($search){
                $query->where('email', $search);
                $query->orwhere('name', 'LIKE', "%{$search}%");
            }
        })->get();

        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        //$user = User::where('id',$id)->first();
        if ( !$user = User::find($id) )
            return redirect()->route('users.index');
       
        return view('users.show', compact('user'));
    }

    public function create(){
        return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request){
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        
        User::create($data);

        return redirect()->route('users.index');
    }

    public function edit($id){
        if ( !$user = User::find($id) )
            return redirect()->route('users.index');
        
        return view('users.edit', compact('user'));        
    }

    public function update(Request $request, $id){

        if ( !$user = User::find($id) )
            return redirect()->route('users.index');

        $data = $request->only('name', 'email');
        if ($request->password)
            $data['password'] = bcrypt($request->password);
        
            $user->update($data);

            return redirect()->route('users.index');

    }

    public function destroy($id)
    {
        if ( !$user = User::find($id))
            return redirect()->route('users.index');
            
        $user->delete();

        return view('users.show', compact('user'));
    }
}
