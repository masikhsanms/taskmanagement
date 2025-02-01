<?php
class Mauth extends CI_Model
{
	private $tb_pengguna = "pengguna";
	const SESSION_KEY = 'userid';

	public function rules()
	{
		return [
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|max_length[255]',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
			]
		];
	}

	public function login($username, $password)
	{
		$this->db->where('username', $username);
		$query = $this->db->get($this->tb_pengguna);
		$user = $query->row();

		// cek apakah user sudah terdaftar?
		if (!$user) {
			return FALSE;
		}

		// cek apakah password-nya benar?
		if ($password != $user->password) {
			return FALSE;
		}

		// bikin session
		$this->session->set_userdata([self::SESSION_KEY => $user->id]);
		// $this->_update_last_login($user->id);

		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$user_id = $this->session->userdata(self::SESSION_KEY);
		$query = $this->db->get_where($this->tb_pengguna, ['id' => $user_id]);
		return $query->row();
	}

	public function logout()
	{
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}
}