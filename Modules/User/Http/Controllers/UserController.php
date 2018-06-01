<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\UserRequest;
use Modules\User\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * Repositório de dados.
     *
     * @var \Modules\User\Repositories\UserRepository
     */
    protected $users;

    /**
     * Quantidade de recursos por página.
     *
     * @var int
     */
    static public $perPage = 10;

    /**
     * Inicializa o controlador com a instância do repositório de dados.
     *
     * @param \Modules\User\Repositories\UserRepository $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $perPage = self::$perPage;
        $query = $request->get('q');
        $users = $this->users
            ->index($user, $perPage, $query);

        return view('user::pages.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $request->user();
        
        if ($user->cant('create', User::class)) {
            abort(403);
        }
        $roles = Role::all();

        return view('user::pages.users.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\User\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $request->user();
        $inputs = $request->all();
        $store = $this->users
            ->store($user, $inputs);
        $redirectTo = $store->success ?
            "/users/{$store->data['userCreated']->id}" :
            '/users/create';

        return redirect($redirectTo)
            ->with('snackbar', $store->message);
    }

    /**
     * Show the specified resource.
     *
     * @param   \Illuminate\Http\Request  $request
     * @param   string  $id
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();
        $userToShow = User::findOrFail($id);

        if ($user->cant('view', $userToShow)) {
            abort(403);
        }

        return view('user::pages.users.show', [
            'userToShow' => $userToShow,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user::pages.users.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  string  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    }
}
