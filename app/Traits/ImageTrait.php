<?php
namespace App\Traits;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use Intervention\Image\Facades\Image;
use App\Helpers\StringGenerator;
use Illuminate\Support\Facades\Log;

trait ImageTrait
{
    public $thumb = 150;
    public $small = 300;
    public $medium = 500;
    public $large = 1024;
    public $origin = null;

    public function storeImage($file, $type)
    {
        $ex = $file->getClientOriginalExtension();
        [$width, $height] = getimagesize($file);

        $newSlug = (new StringGenerator())->generateSlug();

        Storage::disk('local')->put($newSlug . '.' . $ex, File::get($file));

        $fileRecord = [
            'slug' => $newSlug,
            'name' => $newSlug . '.' . $ex,
            'mime' => $file->getClientMimeType(),
            'original_name' => $file->getClientOriginalName(),
        ];

        $file = \App\Models\Image::create($fileRecord);

        return $file;
    }

    public function deleteImage($file) {
        $file = Storage::disk('local')->delete($file->name);

        return response('ok', 200);
    }
}
