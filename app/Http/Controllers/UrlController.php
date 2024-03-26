<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use Illuminate\Http\RedirectResponse;
use App\Repositories\UrlRepository;
use Inertia\Inertia;

class UrlController extends Controller
{
    protected $urlRepository;

    public function __construct(UrlRepository $urlRepository){
        $this->urlRepository = $urlRepository;
    }
    public function index(){
        return Inertia::render('Welcome', ['redirect' => session('redirect')]);
    }

    public function store(StoreUrlRequest $request): RedirectResponse{
       $url = $this->urlRepository->findByUrl($request);
       if(!$url){
       $url = $this->urlRepository->save($request);
       }
       return redirect()->back()->with([
        'redirect' => route('redirect', ['hash' => $url->hash]),
    ]);
    }

    public function redirect(string $hash): RedirectResponse{
        if(str_contains($hash, '/')){
            $hash = last(explode('/', $hash));
        }
        $url = $this->urlRepository->findByHash($hash);
        if($url){
            return redirect($url->url);
        }
    }
}
