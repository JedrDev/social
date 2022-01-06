<?php


namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


trait HasPhoto
{
    /**
     * Update the user's profile photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @return void
     */
    public function updatePhoto(UploadedFile $photo)
    {
        tap($this->columnFile, function ($previous) use ($photo) {
            $this->forceFill([
                $this->columnFile => $photo->storePublicly(
                    $this->filePathSave, ['disk' => $this->photoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->photoDisk())->delete($previous);
            }
        });
    }

    public function savePhoto(UploadedFile $photo)
    {
        return $photo->storePublicly(
            $this->filePathSave, ['disk' => $this->photoDisk()]
        );
    }

    /**
     * Delete the user's profile photo.
     *
     * @return void
     */
    public function deletePhoto()
    {
        if (! $this->filePathSave) {
            return;
        }

        Storage::disk($this->photoDisk())->delete($this->columnFile);

        $this->forceFill([
            $this->columnFile => null,
        ])->save();
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getPhotoUrlAttribute()
    {
        return $this->columnFile
                    ? Storage::disk($this->photoDisk())->url($this->columnFile)
                    : $this->defaultPhotoUrl();
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultPhotoUrl()
    {
        return 'https://ui-avatars.com/api/?name='.urlencode('N A').'&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function photoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('filesystems.default', 'public');
    }
}
