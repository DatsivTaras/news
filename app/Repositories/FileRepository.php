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
        $data = [
            'name' => $name ?? basename($path),
            'path' => $path,
        ];

        return $this->create($data);
    }
}
