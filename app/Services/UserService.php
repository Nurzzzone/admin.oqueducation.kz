<?php

namespace App\Services;

use App\Models\User;
use App\Services\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UserService extends Service
{
  protected $upload_path;

  public function __construct()
  {
    $this->upload_path = 'images'.DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR;
  }

  public function create($data): void
  {
    DB::transaction(function () use ($data) {
      $user = User::create($data['auth']); 
      $user->assignRole('moderator');
      if ($data['profile']['image'] !== null) {
        $data['profile']['image'] = $this->uploadImage($data['profile']['image']);
      }
      $user->profile()->create($data['profile']);
    });
  }

  public function update($data, $user)
  {
    DB::transaction(function () use ($data, $user) {
      $user->update($data['auth']);
      if ($data['profile']['image'] !== null) {
        $data['profile']['image'] = $this->uploadImage($data['profile']['image']);
        
        if ($user->profile->image !== null) {
          $this->deleteImage($user->profile->image);
        }
      }
      $user->profile()->update($data['profile']);
    });
  }

  public function delete($user)
  {
    DB::transaction(function () use ($user) {
      if ($user->delete() && $user->profile->image !== null) {
        $this->deleteImage($user->image);
      }
    });
  }

  /**
   * Upload image
   * 
   * @return void
   */
  private function uploadImage($file)
  {
    if ($file !== null && is_file($file)) {
      $file_extension = $file->getClientOriginalExtension();
      $file_name = 'IMG_'.date('Ymd').'_'.time().'.'.$file_extension;
      $file->move(public_path($this->upload_path), $file_name);
      return $file_name;
    }
  }

  /**
   * Delete image
   * 
   * @return void
   */
  private function deleteImage($file_name)
  {
    if ($file_name !== null) {
      $file = public_path($this->upload_path . $file_name);
      if (File::exists($file)) {
        unlink($file);
        return true;
      }
      return false;
    }
  }
}