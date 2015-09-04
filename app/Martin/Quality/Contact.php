<?php namespace Martin\Quality;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Martin\Core\Traits\RecordsActivity;

class Contact extends Model {

    use RecordsActivity;
    use SoftDeletes;

    protected $recordEvents = [];
    protected $drawAttentionEvents = ['created', 'updated'];

	protected $fillable = [
        'email_template',

        'to_email',
        'from_email',

        'subject',
        'body',

        'user_id',
        'feedback_id',
    ];

    /**
     * Database Table storing the data
     *
     * @var string
     */
    protected $table = 'contacts';


    /**
     * Delete this Contact model
     *
     * @return bool
     * @throws \Exception
     */
    public function trash()
    {
        $this->delete();
        return true;
    }

    /*
     * Relationships
     */

    /**
     * This contact is related to one Feedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feedback()
    {
        return $this->belongsTo('Martin\Quality\Feedback');
    }

    /**
     * This contact is created by one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Martin\Users\User');
    }

    /**
     * This contact has one related customerRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customerRequest()
    {
        return $this->hasOne('Martin\Quality\CustomerRequest');
    }


}
