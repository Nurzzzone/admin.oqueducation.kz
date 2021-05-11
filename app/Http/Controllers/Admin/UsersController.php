<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UsersController extends Controller
{

    protected $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        $params = array_merge(['users' => $users], $this->getPageBreadcrumbs(['pages.users']));
        return view('pages.users.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        $params = array_merge(['user' => $user], $this->getPageBreadcrumbs(['pages.users', 'buttons.create']));
        return view('pages.users.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\CreateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $this->service->create($request->validated());
        } catch(\Exception $exception) {
            dd(['message' => $exception->getMessage()]);
        }
        return redirect()
            ->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('pages.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $params = array_merge(['user' => $user], $this->getPageBreadcrumbs(['pages.users']));
        return view('pages.users.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\UpdateUserRequest  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $this->service->update($request->validated(), $user);
        } catch (\Exception $exception) {
            dd(['message' => $exception->getMessage()]);
        }
        return redirect()
            ->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $this->service->delete($user);
        } catch(\Exception $exception) {
            dd(['message' => $exception->getMessage()]);
        }
        return redirect()
            ->route('users.index');
    }
}
