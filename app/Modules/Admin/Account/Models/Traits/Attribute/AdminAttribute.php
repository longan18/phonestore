<?php

namespace App\Modules\Admin\Account\Models\Traits\Attribute;

/**
 * Trait AdminAttribute.
 */
trait AdminAttribute
{
    /**
     * @return mixed
     */
    public function getAvatarAttribute(): mixed
    {
        return optional($this->getMedia(self::TAG_AVATAR)->first())->getUrl() ?? asset('admin_assets/images/avatar.jpeg');
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @param $password
     *
     * @return void
     */
    public function setPasswordAttribute($password): void
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
