<?php namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
  protected $table = 'users';
  protected $primaryKey = 'id';
  protected $useTimestamps = true;
  protected $allowedFields = ['email', 'username', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash', 'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at','address','telephone'];
	protected $auth;


  public function __construct()
	{
		$this->auth = service('authentication');
  }
  
  private function setPassword($pass){
    $config = config('Auth');
    $hashOptions = [
      'cost' => $config->hashCost
    ];
    return password_hash(
      base64_encode(
        hash('sha384', $pass, true)
      ),
      $config->hashAlgorithm,
      $hashOptions
    );
  }

  public function ubahPassword($data)
  {
    if($data){
      $credentials = [
        'email' => user()->email,
        'password' => $data['passLama']
      ];
      if ($this->auth->validate($credentials,false)) {
        $hashBaru = $this->setPassword($data['passBaru']);
        $dataBaru = [
          'password_hash'    => $hashBaru
        ];
        $this->update(user_id(), $dataBaru);
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }

  public function editProfile($data)
  {
    if($data){
      $dataBaru = [
        'username' => $data['username'],
        'address' => $data['alamat'],
        'telephone' => $data['numberTel']
      ];
      $this->update(user_id(), $dataBaru);
      return true;
    }else{
      return false;
    }
  }

  public function updateStatus($id,$status)
  {
    $data = [
      'status' => $status
    ];
    $this->update($id, $data);
    return true;
  }

  public function matikanAkun($id)
  {
    try {
      $this->update($id,['active' => 0,'status' => 'banned']);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getUsersAll()
  {
    return $this->select('users.id AS id,users.email AS email,users.username AS username,auth_groups.description AS role,users.address AS address,users.telephone AS telephone')->where(['active' => 1])->join('auth_groups_users', 'auth_groups_users.user_id = users.id')->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')->findAll();

  }

  public function getUsersByEmail($email)
  {
    return $this->select('users.id AS id,users.email AS email,users.username AS username,auth_groups.description AS role,users.address AS address,users.telephone AS telephone')->where(['active' => 1])->join('auth_groups_users', 'auth_groups_users.user_id = users.id')->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')->like(['email' => $email])->findAll();
  }
}