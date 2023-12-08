<?php

namespace App\Repositories;

use App\Models\File;
use Illuminate\Http\UploadedFile;

class FileRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return File::class;
    }

    public function uploadAndCreate(UploadedFile $file, string $name = '')
    {
        $path = $file->store('public/image/planes');

        return $this->create([
            'name' => $name ?? basename($path),
            'path' => $path,
            'type' => $file->getClientMimeType()
        ]);
    }
}
