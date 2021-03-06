<?php namespace Common\Files\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HashesId
{
    public function getHashAttribute(): string
    {
        return trim(base64_encode(str_pad($this->getRawOriginal('id').'|', 10, 'padding')), '=');
    }

    public function scopeWhereHash(Builder $query, $value)
    {
        $id = $this->decodeHash($value);
        return $query->where('id', $id);
    }

    public function decodeHash($hash): int
    {
        return (int) explode('|', base64_decode($hash))[0];
    }
}
