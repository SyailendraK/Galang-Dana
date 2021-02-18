<?php namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends Model
{
  protected $table = 'auth_groups_users';
  protected $primaryKey = 'user_id';
  protected $useTimestamps = false;
  protected $allowedFields = ['group_id'];

  public function updateRole($id,$role)
  {
    try {
      $this->update($id,['group_id' => $role]);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

}


