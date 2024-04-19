<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repository\UserRepository;
use App\Http\Requests\{UserStoreRequest, UserUpdateRequest};

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $userRepository = UserRepository::find($request);
      $users = $userRepository
        ->paginate($request->get('paginate') ?? 15);

      return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
      $params = $request->all();
      $params['cpf_cnpj'] = $request->get('cpf') ?? $request->get('cnpj');
      $user = User::create($params);
      return response()->json("Usuário {$user->nome} criado(a).");      
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
      $user->fill($request->all());
      $user->save();

      return response()->json("Usuário {$user->nome} atualizado(a).");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
      $user->delete();
      return response()->json("Usuário {$user->nome} excluído(a).");
    }
}
