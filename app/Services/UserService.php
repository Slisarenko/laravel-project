<?php

namespace App\Services;

use App\Exceptions\UserFilterException;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\DeleteRequest;
use App\Http\Requests\User\GetAllRequest;
use App\Http\Requests\User\GetRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class UserService
{
    public function create(CreateRequest $request): int
    {
        $user = new User();
        $user->name = $request->input('data.name');
        $user->email = $request->input('data.email');
        $user->email_verified_at = Carbon::now();
        $user->password = Hash::make($request->input('data.password'));

        $user->save();
        $user->attachRole(Role::USER);

        return $user->id;
    }

    public function update(UpdateRequest $request): int
    {
        $user = User::query()->find($request->id);
        $user->name = $request->input('data.name');

        $user->save();

        return $user->id;
    }

    public function get(GetRequest $request): Model
    {
        return User::query()->find($request->id);
    }

    public function delete(DeleteRequest $request): bool
    {
        $user = User::query()->find($request->id);

        $forceDelete = $request->input('data.isForceDelete', false);
        if ($forceDelete) {
            return $user->forceDelete();
        }

        $user->hobbies()->delete();

        return $user->delete();
    }

    public function getAll(GetAllRequest $request): LengthAwarePaginator
    {
        $sortField = $this->getSortField($request->input('sortField', 'id'));

        $query = User::query()
            ->orderBy($sortField, $request->input('sortOrder', 'asc'));

        $filters = $request->input('filter');
        if ($filters) {
            $query = $this->getUserWithFilters($query, $filters);
        }

        if (isset($request->limit) && isset($request->page)) {
            return $query->paginate($request->limit, ['*'], 'page', $request->page);
        }

        return $query->paginate();
    }

    private function getUserWithFilters($query, $filters): object
    {
        $likeConditions = ['email', 'id'];
        $dateConditions = ['created_at'];
        $filters = json_decode($filters, true);
        foreach ($filters as $sortField => $sortOrder) {
            $sortField = $this->getSortField($sortField);
            if (in_array($sortField, $likeConditions)) {
                $query->where($sortField, 'like', '%' . $sortOrder . '%');
                continue;
            }

            if (in_array($sortField, $dateConditions)) {
                $query->whereDate($sortField, '=', $sortOrder);
                continue;
            }

            $conditions[$sortField] = $sortOrder;
        }

        if (isset($conditions)) {
            $query->where($conditions);
        }

        return $query;
    }

    private function getSortField($sortField): string
    {
        return match ($sortField) {
            'createdAt' => 'created_at',
            'updatedAt' => 'updated_at',
            'emailVerifiedAt' => 'email_verified_at',
            'id' => 'id',
            'email' => 'email',
            'name' => 'name',
            default => throw (new UserFilterException)
                ->setDetail(Lang::get('exception.userFilterException', ['sortField' => $sortField])),
        };
    }
}
