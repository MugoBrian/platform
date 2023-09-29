<?php

namespace Ushahidi\Modules\V5\Repository\Set;

use Illuminate\Database\Eloquent\Builder;
use Ushahidi\Modules\V5\Models\Set;
use Ushahidi\Modules\V5\Repository\Set\SetRepository;
use Ushahidi\Core\Exception\NotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Ushahidi\Modules\V5\DTO\CollectionSearchFields;
use Ushahidi\Core\Data\Set as CollectionEntity;
use Illuminate\Support\Facades\Auth;

class EloquentSetRepository implements SetRepository
{
    /**
     * This method will fetch all the Set for the logged user from the database utilising
     * Laravel Eloquent ORM and return them as an array
     * @param int $limit
     * @param int $skip
     * @param string $sortBy
     * @param string $order
     *
     * @return Set[]
     */
    public function fetch(
        int $limit,
        int $skip,
        string $sortBy,
        string $order,
        CollectionSearchFields $search_fields
    ): LengthAwarePaginator {

        return $this->setSearchCondition(
            $search_fields,
            Set::query()->withCount('posts')->take($limit)
                ->skip($skip)
                ->orderBy($sortBy, $order)
        )->paginate($limit ? $limit : config('paging.default_laravel_pageing_limit'));
    }

    private function setSearchCondition(CollectionSearchFields $search_fields, Builder $builder)
    {
        $builder->where('search', '=', $search_fields->search());

        if ($search_fields->q()) {
            $builder->where('name', 'LIKE', "%" . $search_fields->q() . "%");
        }
        // guest
        if (!Auth::user() || !Auth::user()->id) {
            $builder->whereNull('role');
        } elseif ($search_fields->role() && $search_fields->role() != "admin") {
            $builder->where(function ($query) use ($search_fields) {
                $query->whereNull('role')
                    ->orWhere('role', 'LIKE', "%" . $search_fields->role() . "%");
            });
        }

        return $builder;
    }

    /**
     * This method will fetch a single Set from the database utilising
     * Laravel Eloquent ORM. Will throw an exception if provided identifier does
     * not exist in the database.
     * @param int $id
     * @param bool $search
     * @return Set
     * @throws NotFoundException
     */
    public function findById(int $id, bool $search = false): Set
    {
        $set = Set::where('id', '=', $id)->where('search', '=', $search)->first();
        if (!$set instanceof Set) {
            throw new NotFoundException('set not found');
        }
        return $set;
    }

    /**
     * This method will create a Set
     * @param CollectionEntity $data
     * @return int
     * @throws \Exception
     */
    public function create(CollectionEntity $input): int
    {
        DB::beginTransaction();
        try {
            $set = set::create($input->asArray());
            DB::commit();
            return $set->id;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * This method will update the Set
     * @param int $id
     * @param CollectionEntity $set_entity
     */


    public function update(int $id, CollectionEntity $set_entity, bool $search = false): void
    {
        $set = Set::find($id);
        if (!$set instanceof Set) {
            throw new NotFoundException('Set not found');
        }

        DB::beginTransaction();
        try {
            Set::find($id)->fill($set_entity->asArray())->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * This method will create a Survey
     * @param int $id
     * @throws NotFoundException
     */
    public function delete(int $id, bool $search = false): void
    {
        $this->findById($id, $search)->delete();
    }
}
