<?php

namespace App\Repositories;

use App\Http\Requests\StoreUrlRequest;
use App\Models\Url;
use App\Services\GenerateUniqueHashService;


class UrlRepository extends RepositoryFoundation
{
    public function __construct(Url $model){
        parent::__construct($model);
    }

    public function save(StoreUrlRequest $request): Object{
       return $this->getQuery()->create([
            'url' => $request->validated('url'),
            'hash' => GenerateUniqueHashService::generateUniqueHash(6),
        ]);
    }

    public function findByUrl(StoreUrlRequest $request): ?Object{
       return $this->getQuery()->where('url', $request->validated('url'))->first();
    }

    public function findByHash(string $hash): ?Object{
       return $this->getQuery()->where('hash', $hash)->first();
    }
}