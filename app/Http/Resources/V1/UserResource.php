<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Json structure
        return [
            'type' => 'user',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                $this->mergeWhen(
                    $request->routeIs('users.*'), // When this condition is true then show the following information
                    [
                        'emailVerifiedAt' => $this->email_verified_at,
                        'createdAt' => $this->created_at,
                        'updatedAt' => $this->updated_at,
                    ]
                )
            ],
            'includes' => TicketResource::collection($this->whenLoaded('tickets')), // Load the tickets relationship when it is included otherwise it will completely omit the tickets relationship and display only the user resource
            'links' => [
                'self' => route('users.show', ['user' => $this->id])
            ]
        ];
    }
}
