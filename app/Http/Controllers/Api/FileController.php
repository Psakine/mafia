<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\FileTrait;
use Illuminate\Http\Request;

class FileController extends Controller
{
    use FileTrait;

    /**
     * @param Request $request
     * @return string
     */
    public function upload(Request $request): string
    {
        return json_encode(['src' => $this->saveFile($request->file('file'))]);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function delete(Request $request): bool
    {
        return $this->deleteFile($request->get('src'));
    }
}
