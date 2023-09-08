<?php

namespace App\Http\Controllers\Api;

use App\Domains\Auth\AuthGate;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\AllRequest;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\ShowRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\DeleteRequest;
use App\Http\Resources\MeResource;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    /**
     * @param AllRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(AllRequest $request)
    {
        $pagination = $request->get('paginate', 10);
        $users = User::query()->paginate($pagination);
        return UserResource::collection($users);
    }

    /**
     * @param CreateRequest $request
     * @return UserResource
     */
    public function store(CreateRequest $request)
    {
        $attributes = $request->validated();

        $user = User::query()->firstOrCreate([
            'username' => $attributes['username'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
        ]);

        $user->info()->create([
            'first_name' => $attributes['firstName'],
            'last_name' => $attributes['lastName'],
            'birthday' => $attributes['birthday'],
            'gender' => $attributes['gender'],
        ]);
        return UserResource::make($user);
    }

    /**
     * @param ShowRequest $request
     * @param $id
     * @return UserResource
     */
    public function show(ShowRequest $request, $id)
    {
        $user = User::query()->with(['info', 'roles'])->where('uuid', $id)->firstOrFail();
        return UserResource::make($user);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return UserResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $attributes = $request->validated();
        $user = User::query()->with(['info', 'roles'])->where('uuid', $id)->firstOrFail();
        $user->info()->update([
            'first_name' => $attributes['firstName'],
            'last_name' => $attributes['lastName'],
            'birthday' => $attributes['birthday'],
            'gender' => $attributes['gender'],
        ]);
        if (isset($attributes['role'])){
            /** @var User $user */
            $this->setRole($user, $attributes['role']);
        }
        return UserResource::make($user);
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DeleteRequest $request, $id)
    {
        $user = User::query()->where('uuid', $id)->firstOrFail();
        $user->delete();
        return response()->json([
            'status' => true,
        ],200);
    }

    /**
     * @param Request $request
     * @return MeResource
     */
    public function me(Request $request)
    {
        $user = AuthGate::me();
        return MeResource::make($user);
    }

    protected function setRole(User $user, $roleId)
    {
        $user->roles()->detach();
        $role = Role::query()->where('uuid', $roleId)->firstOrFail();
        $user->assignRole($role);
    }
}
