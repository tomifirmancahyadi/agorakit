<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;



class Vote extends Model {


	protected $fillable = ['user_id', 'comment_id', 'vote'];

	protected $rules = [
	'user_id' => 'required|exists:users,id',
	'comment_id' => 'required|exists:comments,id',
	];



	protected $table = 'votes';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];


	public function comment()
		{
				return $this->belongsTo('App\comment');
		}



}
