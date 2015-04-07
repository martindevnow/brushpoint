<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class SendFeedbackRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required',
			'email' => 'required|email',
			'phone' => 'required',
			'retailer_text' => 'required',
			// 'lot_code' => '',
			'issue_text' => 'required',
		];
	}

}
