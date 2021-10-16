<?php

namespace SpaceCode\GoDesk\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use SpaceCode\GoDesk\Http\Requests\MediaRequest;
use SpaceCode\GoDesk\Http\Resources\MediaResource;
use Exception;

class MediaController extends Controller
{
    /**
     * @param MediaRequest $request
     * @return AnonymousResourceCollection
     * @throws Exception
     */
    public function index(MediaRequest $request)
    {
        if (!config('godesk.media-library.enable-existing-media')) {
            throw new Exception(__('You need to enable the `existing media` feature via config'));
        }
        $mediaClass = config('media-library.media_model');
        $mediaClassIsSearchable = method_exists($mediaClass, 'search');
        $searchText = $request->input('search_text') ?: null;
        $perPage = $request->input('per_page') ?: 18;
        $query = null;
        if ($searchText && $mediaClassIsSearchable) {
            $query = $mediaClass::search($searchText);
        } else {
            $query = $mediaClass::query();
            if ($searchText) {
                $query->where(function ($query) use ($searchText) {
                    $query->where('name', 'LIKE', '%' . $searchText . '%');
                    $query->orWhere('file_name', 'LIKE', '%' . $searchText . '%');
                });
            }
            $query->latest();
        }
        $results = $query->paginate($perPage);
        return MediaResource::collection($results);
    }
}