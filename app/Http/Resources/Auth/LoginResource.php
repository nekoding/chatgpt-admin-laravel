<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{

    public function __construct(
        protected string $token,
        protected $auth
    ) {
    }


    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $expire = $this->auth->factory()->getTTL() * 60;

        return [
            'access_token'  => $this->token,
            'token_type'    => 'bearer',
            'duration'      => $expire,
            'expired_at'    => now()->addSecond($expire)->toIso8601String(),
        ];
    }
}
