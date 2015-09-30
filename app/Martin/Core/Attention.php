<?php namespace Martin\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ReflectionClass;

class Attention extends Model {

    use SoftDeletes;

	protected $table = "attentions";

    protected $fillable = [
        'global',
        'receiver_id',

        'action',
        'attentionable_id',
        'attentionable_type',
    ];

    protected $hidden = [];


    /*
Address			fa-home
Payer			fa-male or fa-female
Payment			fa-bank
Contact			fa-phone
CustomerRequest	fa-envelope-o
Feedback		fa-comment
    */

    protected $type;

    public function getType()
    {
        if ($this->attentionable == null)
            return false;

        if ($this->type)
            return $this->type;

        return $this->type = (new ReflectionClass($this->attentionable))->getShortName();
    }



    public function see()
    {
        $this->seen = true;
        $this->seen_at = Carbon::now();
        $this->seen_by = \Auth::id();
        return $this;
    }



    public function getUrl()
    {
        $type = $this->getType();

        switch ($type){
            case "Address":
                $address = $this->attentionable;
                $url = $address->getUrlToAddressable();
                break;
            case "Payer":
                $url = "/admins/payers/{$this->attentionable->id}";
                break;
            case "Payment":
                $url = "/admins/payments/{$this->attentionable->id}";
                break;
            case "Contact":
                $url = "/admins/contacts/{$this->attentionable->id}";
                break;
            case "CustomerRequest":
                $url = "/admins/feedback/{$this->attentionable->feedback_id}";
                break;
            case "Feedback":
                $url = "/admins/feedback/{$this->attentionable->id}";
                break;
            case "Image":
                $image = $this->attentionable;
                $url = $image->getUrlToImageable();
                break;
            default:
                $url = "fa-comment ";
                break;
        }

        return $url;
    }

    public function getITag()
    {

        $action = explode("_", $this->action);


        if ($action[0] == "created")
            $status = "New";
        elseif ($action[0] == "updated")
            $status = "Updated";
        else
            $status = "Other";

        $type = $this->getType();

        switch ($type){
            case "Address":
                $icon = "fa-home ";
                break;
            case "Payer":
                $icon = "fa-female ";
                break;
            case "Payment":
                $icon = "fa-money ";
                break;
            case "Contact":
                $icon = "fa-phone ";
                break;
            case "CustomerRequest":
                $icon = "fa-envelope-o ";
                break;
            case "Feedback":
                $icon = "fa-comment ";
                break;
            default:
                $icon = "fa-comment ";
                break;
        }


        $tag = "<i class=\"fa {$icon}fa-fw\"></i> {$status} {$type}";

        return $tag;
    }


    /**
     * Scopes to view only unseen notifications
     *
     * @param $query
     * @return mixed
     */
    public function scopeUnseen($query)
    {
        return $query->where('seen', '=', false);
    }


    public function trash()
    {
        return $this->delete();
    }

    /*
     * Relationships
     */

    /**
     * Polymorphic Relationship to any model
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function attentionable()
    {
        return $this->morphTo();
    }

    public function receiver()
    {
        return $this->belongsTo('Martin\Users\User', 'receiver_id');
    }

    public function viewer()
    {
        return $this->belongsTo('Martin\Users\User', 'seen_by');
    }


}
