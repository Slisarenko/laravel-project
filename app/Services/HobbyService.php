<?php

namespace App\Services;

use App\Models\Hobby;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class HobbyService
{
    public function getAllByUser($request): array|Collection
    {
        return Hobby::query()
            ->where('user_id', '=', $request->id)
            ->get();
    }

    public function getAll(): LengthAwarePaginator
    {
        return Hobby::query()
            ->paginate();
    }

    public function edit($request): Model
    {
        $hobby = Hobby::query()->find($request->id);
        $hobby->title = $request->input('data.title');
        $hobby->description = $request->input('data.description');
        $hobby->save();

        return $hobby;
    }

    public function find($request): Model
    {
        return Hobby::query()->find($request->id);
    }

    public function delete($request): bool
    {
        $hobby = Hobby::query()->find($request->id);

        return $hobby->delete();
    }
}
