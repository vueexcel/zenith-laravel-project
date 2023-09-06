<?php

namespace App;

use App\Models\Member;
use App\Traits\Models\Impersonator;
use App\Traits\Eloquent\OrderableTrait;
use App\Traits\Eloquent\SearchLikeTrait;
use App\Traits\Models\FillableFields;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, FillableFields, OrderableTrait, SearchLikeTrait, Impersonator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'logo_number', 'avatar', 'is_deleted', 'surname', 'member_no', 'is_hr',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return boolean
     */
    public function isAdmin()
    {
        return (int) $this->is_admin === 2;
    }

    public function isManager()
    {
        return (int) $this->is_admin === 1;
    }

    public function isGeneralUser()
    {
        return (int) $this->is_admin === 0;
    }

    /**
     * @return string
     */
    public function getLogoPath()
    {
        if($this->avatar)
            return asset("/avatars/{$this->avatar}");
        else
            return Utils::logoPath($this->logo_number);
    }

    /**
     * @return mixed
     */
    public function getRecordTitle()
    {
        return $this->name;
    }

    public function groupName()
    {
        //Find Member
        $member = Member::where('member_no', $this->member_no)->first();
        if($member)
        {
            if(strpos($member->group_code, 'H') > -1)
                return 'deeside';
            else
                return 'burnaston';

        } else {
            return 'all';
        }

    }
}
